<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'username',
        'email',
        'password',
        'avatar',
        'bio',
    ];

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

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_like')->withTimestamps();
    }

    public function friendsOfMine(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id')
            ->withPivot('accepted')
            ->withTimestamps();
    }

    public function friendOf(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friendships', 'friend_id', 'user_id')
            ->withPivot('accepted')
            ->withTimestamps();
    }

    public function friends()
    {
        $friendsOfMine = $this->friendsOfMine()->wherePivot('accepted', true)->get();
        $friendOf = $this->friendOf()->wherePivot('accepted', true)->get();

        return $friendsOfMine->merge($friendOf);
    }

    public function sentFriendRequests()
    {
        return $this->friendsOfMine()->wherePivot('accepted', false);
    }

    public function receivedFriendRequests()
    {
        return $this->friendOf()->wherePivot('accepted', false);
    }

    public function hasSentFriendRequest(User $user): bool
    {
        return $this->sentFriendRequests()->where('friend_id', $user->id)->exists();
    }

    public function hasReceivedFriendRequest(User $user): bool
    {
        return $this->receivedFriendRequests()->where('user_id', $user->id)->exists();
    }

    public function isFriendsWith(User $user): bool
    {
        return $this->friendsOfMine()->wherePivot('accepted', true)->where('friend_id', $user->id)->exists()
            || $this->friendOf()->wherePivot('accepted', true)->where('user_id', $user->id)->exists();
    }
}
