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
        
        // Get recent conversations
        $conversations = Message::where('sender_id', $user->id)
                               ->orWhere('recipient_id', $user->id)
                               ->with(['sender', 'recipient'])
                               ->orderBy('created_at', 'desc')
                               ->take(10)
                               ->get()
                               ->groupBy('thread_id');
        
        // Get unread messages count
        $unreadCount = Message::where('recipient_id', $user->id)
                             ->unread()
                             ->count();
        
        return view('messages', compact('conversations', 'unreadCount'));
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
}
