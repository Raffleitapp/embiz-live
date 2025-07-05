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
        'name',
        'email',
        'password',
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
}
