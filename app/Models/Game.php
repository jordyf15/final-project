<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $table = 'games';
    protected $primaryKey = 'game_id';

    public function transactionDetails(){
        return $this->belongsToMany(TransactionDetail::class);
    }

    public function gameLibraryDetails(){
        return $this->belongsToMany(GameLibraryDetail::class);
    }

    public function cartDetails(){
        return $this->belongsToMany(CartDetail::class);
    }
    
}
