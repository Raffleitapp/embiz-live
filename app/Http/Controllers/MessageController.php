<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MessageController extends Controller
{
    /**
     * Display the messages page.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            // For admins, show all messages but group broadcast messages by thread_id
            $messages = collect();
            
            // Get all messages ordered by created_at
            $allMessages = Message::with(['sender', 'recipient', 'interests'])
                                 ->orderBy('created_at', 'desc')
                                 ->get();
            
            // Group messages by thread_id for broadcast messages, keep others as-is
            $groupedMessages = $allMessages->groupBy('thread_id');
            
            foreach ($groupedMessages as $threadId => $threadMessages) {
                $firstMessage = $threadMessages->first();
                
                // If it's a broadcast message (same sender, same content, multiple recipients)
                if ($threadMessages->count() > 1 && 
                    $threadMessages->pluck('sender_id')->unique()->count() === 1 &&
                    in_array($firstMessage->message_type, ['investment', 'announcement'])) {
                    
                    // Create a representative message for the broadcast
                    $broadcastMessage = $firstMessage->replicate();
                    $broadcastMessage->id = $firstMessage->id;
                    $broadcastMessage->created_at = $firstMessage->created_at;
                    $broadcastMessage->updated_at = $firstMessage->updated_at;
                    $broadcastMessage->recipient_count = $threadMessages->count();
                    $broadcastMessage->all_recipients = $threadMessages->pluck('recipient.name')->toArray();
                    $broadcastMessage->is_broadcast = true;
                    
                    $messages->push($broadcastMessage);
                } else {
                    // Add individual messages
                    $messages = $messages->merge($threadMessages);
                }
            }
            
            // Sort by created_at and paginate manually
            $messages = $messages->sortByDesc('created_at');
            $perPage = 20;
            $currentPage = request('page', 1);
            $currentPageItems = $messages->slice(($currentPage - 1) * $perPage, $perPage)->values();
            
            $messages = new \Illuminate\Pagination\LengthAwarePaginator(
                $currentPageItems,
                $messages->count(),
                $perPage,
                $currentPage,
                [
                    'path' => request()->url(),
                    'pageName' => 'page',
                ]
            );
            
        } else {
            // For regular users, show messages they sent or received
            $messages = Message::where('sender_id', $user->id)
                              ->orWhere('recipient_id', $user->id)
                              ->with(['sender', 'recipient', 'interests'])
                              ->orderBy('created_at', 'desc')
                              ->paginate(20);
        }
        
        // Get unread messages count
        $unreadCount = Message::where('recipient_id', $user->id)
                             ->unread()
                             ->count();
        
        return view('messages.index', compact('messages', 'unreadCount'));
    }

    /**
     * Send a new message.
     */
    public function send(Request $request, User $recipient)
    {
        $request->validate([
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
            'thread_id' => 'nullable|string',
            'is_important' => 'boolean',
            'attachments' => 'nullable|array',
        ]);

        $sender = Auth::user();
        
        // Generate thread ID if not provided
        $threadId = $request->thread_id ?? Str::uuid();

        $message = Message::create([
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'subject' => $request->subject,
            'message' => $request->message,
            'thread_id' => $threadId,
            'is_important' => $request->is_important ?? false,
            'attachments' => $request->attachments ?? [],
        ]);

        return response()->json([
            'message' => 'Message sent successfully!',
            'data' => $message->load(['sender', 'recipient'])
        ]);
    }

    /**
     * Get messages for a specific thread.
     */
    public function getThread($threadId)
    {
        $user = Auth::user();
        
        $messages = Message::where('thread_id', $threadId)
                          ->where(function ($query) use ($user) {
                              $query->where('sender_id', $user->id)
                                    ->orWhere('recipient_id', $user->id);
                          })
                          ->with(['sender', 'recipient'])
                          ->orderBy('created_at', 'asc')
                          ->get();

        // Mark messages as read
        Message::where('thread_id', $threadId)
              ->where('recipient_id', $user->id)
              ->unread()
              ->update(['read_at' => now()]);

        return response()->json($messages);
    }

    /**
     * Get user's messages.
     */
    public function getMessages(Request $request)
    {
        $user = Auth::user();
        $type = $request->get('type', 'all'); // all, sent, received, unread, important, archived

        $query = Message::where('sender_id', $user->id)
                       ->orWhere('recipient_id', $user->id);

        switch ($type) {
            case 'sent':
                $query = Message::where('sender_id', $user->id);
                break;
            case 'received':
                $query = Message::where('recipient_id', $user->id);
                break;
            case 'unread':
                $query = Message::where('recipient_id', $user->id)->unread();
                break;
            case 'important':
                $query = Message::where('recipient_id', $user->id)->important();
                break;
            case 'archived':
                $query = Message::where('recipient_id', $user->id)->archived();
                break;
        }

        $messages = $query->with(['sender', 'recipient'])
                         ->orderBy('created_at', 'desc')
                         ->paginate(20);

        return response()->json($messages);
    }

    /**
     * Mark a message as read.
     */
    public function markAsRead(Message $message)
    {
        $user = Auth::user();
        
        if ($message->recipient_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $message->markAsRead();

        return response()->json([
            'message' => 'Message marked as read',
            'data' => $message->fresh()
        ]);
    }

    /**
     * Mark a message as important.
     */
    public function markAsImportant(Message $message)
    {
        $user = Auth::user();
        
        if ($message->recipient_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $message->markAsImportant();

        return response()->json([
            'message' => 'Message marked as important',
            'data' => $message->fresh()
        ]);
    }

    /**
     * Archive a message.
     */
    public function archive(Message $message)
    {
        $user = Auth::user();
        
        if ($message->recipient_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $message->archive();

        return response()->json([
            'message' => 'Message archived',
            'data' => $message->fresh()
        ]);
    }

    /**
     * Unarchive a message.
     */
    public function unarchive(Message $message)
    {
        $user = Auth::user();
        
        if ($message->recipient_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $message->unarchive();

        return response()->json([
            'message' => 'Message unarchived',
            'data' => $message->fresh()
        ]);
    }

    /**
     * Delete a message.
     */
    public function delete(Message $message)
    {
        $user = Auth::user();
        
        if ($message->sender_id !== $user->id && $message->recipient_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $message->delete();

        return response()->json(['message' => 'Message deleted successfully']);
    }

    /**
     * Get unread messages count.
     */
    public function getUnreadCount()
    {
        $user = Auth::user();
        
        $count = Message::where('recipient_id', $user->id)
                       ->unread()
                       ->count();

        return response()->json(['unread_count' => $count]);
    }

    /**
     * Search messages.
     */
    public function search(Request $request)
    {
        $user = Auth::user();
        $query = $request->get('q');
        
        $messages = Message::where(function ($q) use ($user) {
                              $q->where('sender_id', $user->id)
                                ->orWhere('recipient_id', $user->id);
                          })
                          ->where(function ($q) use ($query) {
                              $q->where('subject', 'like', "%{$query}%")
                                ->orWhere('message', 'like', "%{$query}%");
                          })
                          ->with(['sender', 'recipient'])
                          ->orderBy('created_at', 'desc')
                          ->paginate(20);

        return response()->json($messages);
    }

    /**
     * Respond to an investment message.
     */
    public function respondToInvestment(Request $request, Message $message)
    {
        $request->validate([
            'response_type' => 'required|in:interested,not_interested',
            'interest_level' => 'nullable|in:high,medium,low',
            'comments' => 'nullable|string|max:1000',
            'investment_amount' => 'nullable|numeric|min:0',
        ]);

        $user = Auth::user();

        // Check if user has already responded
        if ($user->hasRespondedToMessage($message->id)) {
            return response()->json(['error' => 'You have already responded to this message.'], 400);
        }

        // Create the response
        $response = $user->messageInterests()->create([
            'message_id' => $message->id,
            'response_type' => $request->response_type,
            'interest_level' => $request->interest_level,
            'comments' => $request->comments,
            'investment_amount' => $request->investment_amount,
            'responded_at' => now(),
        ]);

        // Log the activity
        $user->logActivity(
            'Responded to investment message',
            'User responded to investment message: ' . $message->subject,
            'investment_response'
        );

        return response()->json([
            'message' => 'Response submitted successfully!',
            'data' => $response
        ]);
    }

    /**
     * Update investment response.
     */
    public function updateInvestmentResponse(Request $request, Message $message)
    {
        $request->validate([
            'response_type' => 'required|in:interested,not_interested',
            'interest_level' => 'nullable|in:high,medium,low',
            'comments' => 'nullable|string|max:1000',
            'investment_amount' => 'nullable|numeric|min:0',
        ]);

        $user = Auth::user();
        $response = $user->getMessageResponse($message->id);

        if (!$response) {
            return response()->json(['error' => 'No response found to update.'], 404);
        }

        $response->update([
            'response_type' => $request->response_type,
            'interest_level' => $request->interest_level,
            'comments' => $request->comments,
            'investment_amount' => $request->investment_amount,
            'responded_at' => now(),
        ]);

        return response()->json([
            'message' => 'Response updated successfully!',
            'data' => $response
        ]);
    }

    /**
     * Get investment message responses (Admin only).
     */
    public function getInvestmentResponses(Message $message)
    {
        $user = Auth::user();
        
        if (!$user->isAdmin()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $responses = $message->interests()
                           ->with(['user', 'user.profile'])
                           ->orderBy('responded_at', 'desc')
                           ->get();

        $stats = $message->getResponseStats();

        return response()->json([
            'responses' => $responses,
            'stats' => $stats
        ]);
    }

    /**
     * Create broadcast investment message (Admin only).
     */
    public function createInvestmentBroadcast(Request $request)
    {
        $user = Auth::user();
        
        if (!$user->isAdmin()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:10000',
            'target_audience' => 'required|in:all,founding_members,investors',
            'investment_amount' => 'nullable|numeric|min:0',
            'investment_currency' => 'nullable|string|max:3',
        ]);

        // Get target users
        $targetUsers = $this->getTargetUsers($request->target_audience);

        $messages = [];
        $threadId = Str::uuid();

        foreach ($targetUsers as $targetUser) {
            $message = Message::create([
                'sender_id' => $user->id,
                'recipient_id' => $targetUser->id,
                'subject' => $request->subject,
                'message' => $request->message,
                'message_type' => 'investment',
                'investment_amount' => $request->investment_amount,
                'investment_currency' => $request->investment_currency ?? 'USD',
                'thread_id' => $threadId,
                'is_important' => true,
            ]);

            $messages[] = $message;
        }

        // Log the activity
        $user->logActivity(
            'Created investment broadcast',
            'Created investment broadcast: ' . $request->subject . ' to ' . count($targetUsers) . ' users',
            'investment_broadcast'
        );

        return response()->json([
            'message' => 'Investment broadcast sent successfully!',
            'sent_to' => count($targetUsers),
            'data' => $messages
        ]);
    }

    /**
     * Get target users based on audience type.
     */
    private function getTargetUsers($audience)
    {
        $query = User::query();

        switch ($audience) {
            case 'founding_members':
                $query->whereHas('profile', function ($q) {
                    $q->where('is_founding_member', true);
                });
                break;
            case 'investors':
                $query->whereHas('profile', function ($q) {
                    $q->where('profile_type', 'investor');
                });
                break;
            case 'all':
            default:
                // No additional filtering for 'all'
                break;
        }

        return $query->get();
    }

    /**
     * View investment message responses (Admin only).
     */
    public function viewInvestmentResponses(Message $message)
    {
        $user = Auth::user();
        
        if (!$user->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $responses = $message->interests()
                           ->with(['user', 'user.profile'])
                           ->orderBy('responded_at', 'desc')
                           ->get();

        $stats = $message->getResponseStats();

        return view('messages.investment-responses', compact('message', 'responses', 'stats'));
    }

    /**
     * View broadcast investment message responses (Admin only).
     */
    public function viewBroadcastInvestmentResponses($threadId)
    {
        $user = Auth::user();
        
        if (!$user->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        // Get all messages in the thread
        $threadMessages = Message::where('thread_id', $threadId)
                                ->with(['sender', 'recipient'])
                                ->orderBy('created_at', 'desc')
                                ->get();

        if ($threadMessages->isEmpty()) {
            abort(404, 'Broadcast message not found');
        }

        $broadcastMessage = $threadMessages->first();
        $recipientCount = $threadMessages->count();

        // Get all responses from all messages in the thread
        $responses = collect();
        $totalResponses = 0;
        $interestedCount = 0;
        $notInterestedCount = 0;
        $foundingMemberInterested = 0;
        $foundingMemberTotal = 0;
        $totalInvestmentAmount = 0;
        $investmentResponseCount = 0;

        foreach ($threadMessages as $message) {
            $messageResponses = $message->interests()
                                      ->with(['user', 'user.profile'])
                                      ->get();
            
            $responses = $responses->merge($messageResponses);
            
            // Calculate stats
            $totalResponses += $messageResponses->count();
            $interestedCount += $messageResponses->where('response_type', 'interested')->count();
            $notInterestedCount += $messageResponses->where('response_type', 'not_interested')->count();
            
            foreach ($messageResponses as $response) {
                if ($response->user->isFoundingMember()) {
                    $foundingMemberTotal++;
                    if ($response->response_type === 'interested') {
                        $foundingMemberInterested++;
                    }
                }
                
                if ($response->investment_amount) {
                    $totalInvestmentAmount += $response->investment_amount;
                    $investmentResponseCount++;
                }
            }
        }

        // Sort responses by responded_at
        $responses = $responses->sortByDesc('responded_at');

        // Calculate statistics
        $stats = [
            'total_responses' => $totalResponses,
            'interested_count' => $interestedCount,
            'not_interested_count' => $notInterestedCount,
            'founding_member_interested' => $foundingMemberInterested,
            'founding_member_total' => $foundingMemberTotal,
            'interest_rate' => $totalResponses > 0 ? ($interestedCount / $totalResponses) * 100 : 0,
            'founding_member_interest_rate' => $foundingMemberTotal > 0 ? ($foundingMemberInterested / $foundingMemberTotal) * 100 : 0,
        ];

        $averageInvestmentAmount = $investmentResponseCount > 0 ? $totalInvestmentAmount / $investmentResponseCount : 0;

        return view('messages.broadcast-investment-responses', compact(
            'broadcastMessage', 
            'responses', 
            'stats', 
            'recipientCount',
            'totalInvestmentAmount',
            'averageInvestmentAmount',
            'investmentResponseCount'
        ));
    }

    /**
     * Get investment messages statistics for admin dashboard.
     */
    public function getInvestmentStats()
    {
        $user = Auth::user();
        
        if (!$user->isAdmin()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Get all investment messages
        $investmentMessages = Message::where('message_type', 'investment')
                                   ->with(['interests', 'sender'])
                                   ->orderBy('created_at', 'desc')
                                   ->get();

        // Group by thread for broadcast messages
        $broadcastStats = [];
        $threadGroups = $investmentMessages->groupBy('thread_id');
        
        foreach ($threadGroups as $threadId => $threadMessages) {
            if ($threadMessages->count() > 1) {
                $firstMessage = $threadMessages->first();
                $stats = $this->calculateThreadStats($threadMessages);
                
                $broadcastStats[] = [
                    'thread_id' => $threadId,
                    'subject' => $firstMessage->subject,
                    'sender' => $firstMessage->sender->name,
                    'created_at' => $firstMessage->created_at,
                    'recipient_count' => $threadMessages->count(),
                    'response_count' => $stats['total_responses'],
                    'interested_count' => $stats['interested_count'],
                    'response_rate' => ($stats['total_responses'] / $threadMessages->count()) * 100,
                    'interest_rate' => $stats['interest_rate'],
                    'total_investment_amount' => $stats['total_investment_amount'],
                ];
            }
        }

        return response()->json([
            'broadcast_stats' => $broadcastStats,
            'total_broadcasts' => count($broadcastStats),
            'total_recipients' => $investmentMessages->count(),
            'total_responses' => $investmentMessages->sum(function($msg) { return $msg->interests->count(); }),
        ]);
    }

    /**
     * Calculate statistics for a thread of messages.
     */
    private function calculateThreadStats($threadMessages)
    {
        $totalResponses = 0;
        $interestedCount = 0;
        $notInterestedCount = 0;
        $totalInvestmentAmount = 0;

        foreach ($threadMessages as $message) {
            $responses = $message->interests;
            $totalResponses += $responses->count();
            $interestedCount += $responses->where('response_type', 'interested')->count();
            $notInterestedCount += $responses->where('response_type', 'not_interested')->count();
            $totalInvestmentAmount += $responses->sum('investment_amount');
        }

        return [
            'total_responses' => $totalResponses,
            'interested_count' => $interestedCount,
            'not_interested_count' => $notInterestedCount,
            'interest_rate' => $totalResponses > 0 ? ($interestedCount / $totalResponses) * 100 : 0,
            'total_investment_amount' => $totalInvestmentAmount,
        ];
    }
}
