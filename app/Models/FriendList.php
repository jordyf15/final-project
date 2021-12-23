<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FriendList extends Model
{
    use HasFactory;
    protected $table = 'friend_lists';
    protected $primaryKey = 'friend_list_id';

    public function user(){
        return $this->belongsTo(User::class,'user_id','user_id');
    }
    public function friendDetails(){
        return $this->hasMany(FriendDetail::class,'friend_list_id','friend_list_id');
    }
}
