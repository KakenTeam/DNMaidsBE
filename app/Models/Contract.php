<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'customer_id',
        'helper_id',
        'contract_creator_id',
        'address',
        'start_date',
        'end_date',
        'status',
        'fee',
        'service_type'
    ];

    public function schedule(){
        return $this->hasMany(ContractSchedule::class,  'contract_id' ,'id');
    }

    public function customer(){
        return $this->belongsTo(User::class,  'customer_id' ,'id');
    }

    public function helper(){
        return $this->belongsTo(User::class,  'helper_id' ,'id');
    }

    public function creator(){
        return $this->belongsTo(User::class,  'contract_creator_id' ,'id');
    }

}
