<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function gameLibrary(){
        return $this->hasOne(GameLibrary::class,'user_id','user_id');
    }
    public function transactionHeaders(){
        return $this->hasMany(TransactionHeader::class, 'user_id','user_id');
    }
    public function friendList(){
        return $this->hasOne(FriendList::class,'user_id','user_id');
    }
    public function friendDetail(){
        return $this->hasOne(FriendDetail::class,'friend_id','user_id');
    }
    public function friendRequests(){
        return $this->hasMany(FriendRequest::class);
    }
}
