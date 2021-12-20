<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHeader extends Model
{
    use HasFactory;
    protected $table = 'transaction_headers';
    protected $primaryKey = 'transaction_header_id';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function transactionDetails(){
        return $this->hasMany(TransactionDetail::class);
    }
}
