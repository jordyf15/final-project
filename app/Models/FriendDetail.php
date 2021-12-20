<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FriendDetail extends Model
{
    use HasFactory;
    protected $table = 'friend_details';

    public function friendList(){
        return $this->belongsTo(FriendList::class);
    }
    public function user(){
        return $this->hasOne(User::class);
    }
}
