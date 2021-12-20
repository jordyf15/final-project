<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameLibraryDetail extends Model
{
    use HasFactory;
    protected $table = 'game_library_details';

    public function game(){
        return $this->hasOne(Game::class);
    }
    public function gameLibrary(){
        return $this->belongsTo(GameLibrary::class);
    }
}
