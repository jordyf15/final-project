<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    protected $table = 'transaction_details';

    public function transactionHeader(){
        return $this->belongsTo(TransactionHeader::class,'transaction_header_id','transaction_header_id');
    }

    public function game(){
        return $this->hasOne(Game::class,'game_id','game_id');
    }
}
