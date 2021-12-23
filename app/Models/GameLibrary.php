<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameLibrary extends Model
{
    use HasFactory;
    protected $table = 'game_libraries';
    protected $primaryKey = 'library_id';

    public function user(){
        return $this->belongsTo(User::class,'user_id','user_id');
    }
    public function gameLibraryDetails(){
        return $this->hasMany(GameLibraryDetail::class,'library_id','library_id');
    }
}
