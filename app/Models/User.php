<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role_id',
        'last_login_at',
    ];

    /**
     * Get the profile associated with the user.
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Get the opportunities created by the user.
     */
    public function opportunities()
    {
        return $this->hasMany(Opportunity::class);
    }

    /**
     * Get the affiliate programme for the user.
     */
    public function affiliateProgramme()
    {
        return $this->hasOne(AffiliateProgramme::class);
    }

    /**
     * Get the connections requested by the user.
     */
    public function connectionRequests()
    {
        return $this->hasMany(Connection::class, 'requester_id');
    }

    /**
     * Get the connections received by the user.
     */
    public function connectionReceived()
    {
        return $this->hasMany(Connection::class, 'addressee_id');
    }

    /**
     * Get the messages sent by the user.
     */
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * Get the messages received by the user.
     */
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }

    /**
     * Get all connections for the user (accepted only).
     */
    public function connections()
    {
        return $this->belongsToMany(User::class, 'connections', 'requester_id', 'addressee_id')
            ->wherePivot('status', 'accepted')
            ->withPivot(['accepted_at', 'status']);
    }

    /**
     * Get connections where user is the addressee.
     */
    public function receivedConnections()
    {
        return $this->belongsToMany(User::class, 'connections', 'addressee_id', 'requester_id')
            ->wherePivot('status', 'accepted')
            ->withPivot(['accepted_at', 'status']);
    }

    /**
     * Get all accepted connections (both sent and received).
     */
    public function getAllConnections()
    {
        $sentConnections = $this->connections()->get();
        $receivedConnections = $this->receivedConnections()->get();
        
        return $sentConnections->merge($receivedConnections);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the role associated with the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the activity logs for the user.
     */
    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    /**
     * Get the support tickets created by the user.
     */
    public function supportTickets()
    {
        return $this->hasMany(SupportTicket::class);
    }

    /**
     * Get the support tickets assigned to the user.
     */
    public function assignedTickets()
    {
        return $this->hasMany(SupportTicket::class, 'assigned_to');
    }

    /**
     * Check if user has a specific role.
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->role && $this->role->name === $role;
        }
        
        return $this->role && $this->role->id === $role->id;
    }

    /**
     * Check if user has a specific permission.
     */
    public function hasPermission($permission)
    {
        if (!$this->role) {
            return false;
        }

        return $this->role->hasPermission($permission);
    }

    /**
     * Check if user is admin.
     */
    public function isAdmin()
    {
        return $this->hasRole('admin') || $this->hasRole('super_admin');
    }

    /**
     * Check if user is founding member.
     */
    public function isFoundingMember()
    {
        return $this->profile && $this->profile->is_founding_member;
    }

    /**
     * Log user activity.
     */
    public function logActivity($action, $description, $type = 'general', $metadata = null)
    {
        return $this->activityLogs()->create([
            'action' => $action,
            'description' => $description,
            'type' => $type,
            'metadata' => $metadata,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    /**
     * Update last login timestamp.
     */
    public function updateLastLogin()
    {
        $this->update(['last_login_at' => now()]);
        $this->logActivity('Logged in', 'User logged in successfully', 'login');
    }

    /**
     * Get the user's full name.
     */
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get the user's full name.
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get the user's initials.
     */
    public function getInitialsAttribute()
    {
        return substr($this->first_name, 0, 1) . substr($this->last_name, 0, 1);
    }
}
