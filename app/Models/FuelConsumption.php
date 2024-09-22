<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelConsumption extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'distance',
        'money',
        'refueling_amount',
    ];

    public function account() 
    {
        return $this->belongsTo(Account::class);
    }
}

$fuel = FuelConsumption::first();

$account = $fuel->account;

$account = Account::where('id', $fuel->account_id)->first();
