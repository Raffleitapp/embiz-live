<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class NetworkController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display the network page.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get user's connections
        $connections = $user->getAllConnections();
        
        // Get pending connection requests
        $pendingRequests = Connection::where('addressee_id', $user->id)
                                    ->where('status', 'pending')
                                    ->with(['requester', 'requester.profile'])
                                    ->get();
        
        // Get recommended connections
        $recommendations = $this->getRecommendations($user);
        
        return view('network', compact('connections', 'pendingRequests', 'recommendations'));
    }

    /**
     * Send a connection request.
     */
    public function sendRequest(Request $request, User $user)
    {
        $request->validate([
            'message' => 'nullable|string|max:500',
        ]);

        $authUser = Auth::user();

        // Check if connection already exists
        $existingConnection = Connection::where(function ($query) use ($authUser, $user) {
            $query->where('requester_id', $authUser->id)
                  ->where('addressee_id', $user->id);
        })->orWhere(function ($query) use ($authUser, $user) {
            $query->where('requester_id', $user->id)
                  ->where('addressee_id', $authUser->id);
        })->first();

        if ($existingConnection) {
            return response()->json([
                'message' => 'Connection already exists or request already sent.'
            ], 400);
        }

        // Create new connection request
        $connection = Connection::create([
            'requester_id' => $authUser->id,
            'addressee_id' => $user->id,
            'message' => $request->message,
        ]);

        return response()->json([
            'message' => 'Connection request sent successfully!',
            'connection' => $connection->load(['requester', 'addressee'])
        ]);
    }

    /**
     * Accept a connection request.
     */
    public function acceptRequest(Connection $connection)
    {
        $this->authorize('respond', $connection);

        $connection->accept();

        return response()->json([
            'message' => 'Connection request accepted!',
            'connection' => $connection->load(['requester', 'addressee'])
        ]);
    }

    /**
     * Decline a connection request.
     */
    public function declineRequest(Connection $connection)
    {
        $this->authorize('respond', $connection);

        $connection->decline();

        return response()->json([
            'message' => 'Connection request declined.',
            'connection' => $connection
        ]);
    }

    /**
     * Block a connection.
     */
    public function blockConnection(Connection $connection)
    {
        $this->authorize('respond', $connection);

        $connection->block();

        return response()->json([
            'message' => 'Connection blocked.',
            'connection' => $connection
        ]);
    }

    /**
     * Remove a connection.
     */
    public function removeConnection(Connection $connection)
    {
        $user = Auth::user();
        
        // Check if user is part of this connection
        if ($connection->requester_id !== $user->id && $connection->addressee_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $connection->delete();

        return response()->json([
            'message' => 'Connection removed successfully.'
        ]);
    }

    /**
     * Get user's connections.
     */
    public function getConnections()
    {
        $user = Auth::user();
        
        $connections = $user->connections()
                           ->with('profile')
                           ->paginate(20);

        return response()->json($connections);
    }

    /**
     * Get pending connection requests.
     */
    public function getPendingRequests()
    {
        $user = Auth::user();
        
        $requests = Connection::where('addressee_id', $user->id)
                              ->where('status', 'pending')
                              ->with(['requester', 'requester.profile'])
                              ->orderBy('created_at', 'desc')
                              ->get();

        return response()->json($requests);
    }

    /**
     * Get sent connection requests.
     */
    public function getSentRequests()
    {
        $user = Auth::user();
        
        $requests = Connection::where('requester_id', $user->id)
                              ->where('status', 'pending')
                              ->with(['addressee', 'addressee.profile'])
                              ->orderBy('created_at', 'desc')
                              ->get();

        return response()->json($requests);
    }

    /**
     * Search for people to connect with.
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        $profileType = $request->get('type');
        $location = $request->get('location');
        $user = Auth::user();

        $profiles = Profile::with('user')
                          ->active()
                          ->where('user_id', '!=', $user->id)
                          ->when($query, function ($queryBuilder) use ($query) {
                              $queryBuilder->where(function ($q) use ($query) {
                                  $q->where('first_name', 'like', "%{$query}%")
                                    ->orWhere('last_name', 'like', "%{$query}%")
                                    ->orWhere('company', 'like', "%{$query}%")
                                    ->orWhere('title', 'like', "%{$query}%");
                              });
                          })
                          ->when($profileType, function ($queryBuilder) use ($profileType) {
                              $queryBuilder->where('profile_type', $profileType);
                          })
                          ->when($location, function ($queryBuilder) use ($location) {
                              $queryBuilder->where('location', 'like', "%{$location}%");
                          })
                          ->orderBy('profile_views', 'desc')
                          ->paginate(12);

        return response()->json($profiles);
    }

    /**
     * Get recommended connections for the user.
     */
    private function getRecommendations(User $user)
    {
        $user->load('profile');
        
        // Get users already connected or with pending requests
        $connectedUserIds = Connection::where(function ($query) use ($user) {
            $query->where('requester_id', $user->id)
                  ->orWhere('addressee_id', $user->id);
        })->pluck('requester_id')->merge(
            Connection::where(function ($query) use ($user) {
                $query->where('requester_id', $user->id)
                      ->orWhere('addressee_id', $user->id);
            })->pluck('addressee_id')
        )->unique()->toArray();

        // Exclude current user
        $connectedUserIds[] = $user->id;

        return Profile::with('user')
                     ->active()
                     ->whereNotIn('user_id', $connectedUserIds)
                     ->when($user->profile && $user->profile->interests, function ($query) use ($user) {
                         $interests = $user->profile->interests;
                         $query->where(function ($q) use ($interests) {
                             foreach ($interests as $interest) {
                                 $q->orWhereJsonContains('interests', $interest);
                             }
                         });
                     })
                     ->when($user->profile && $user->profile->location, function ($query) use ($user) {
                         $query->where('location', 'like', "%{$user->profile->location}%");
                     })
                     ->inRandomOrder()
                     ->limit(6)
                     ->get();
    }
}
