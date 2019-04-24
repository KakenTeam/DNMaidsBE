<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractSchedule extends Model
{
    protected $fillable = [
        'start_time',
        'end_time',
        'day_of_week',
        'contract_id',
    ];

    public function schedule()
    {
        return $this->belongsTo(Contract::class, 'contract_id', 'id');
    }
}
