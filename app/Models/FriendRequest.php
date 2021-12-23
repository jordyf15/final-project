<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{
    use HasFactory;
    protected $table = 'friend_requests';

    public function sender(){
        return $this->belongsTo(User::class,'sender_id','user_id');
    }

    public function receiver(){
        return $this->belongsTo(User::class, 'receiver_id','user_id');
    }
}
