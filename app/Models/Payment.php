<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'membership_plan_id',
        'amount',
        'payment_method_id',
        'status_id',
        'transaction_ref',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
