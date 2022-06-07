<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
	protected $fillable = [
        'payor_acc',
        'payee_acc',
        'amount',
		'description'
    ];
}
