<?php

namespace App\Models;


class Lead extends CoreModel
{
    const UNPROCESSED = 'Unprocessed';
    const APPOINTMENT = 'appointment';
    const NOT_REACHED = 'not_reached';
    const DEADLINE = 'deadline';
    const CLOSED = 'closed';
    const NOT_CLOSED = 'not_closed';
    const NO_INTEREST = 'no_interests';


    protected $table = 'leads';

    protected $fillable = [
        'agent_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'gender',
        'investment_amount',
        'reachability',
        'interested_in',
        'notice',
        'lead_status',
        'is_pdf_generated',
    ];

    public function getFullNameAttribute(){
        return $this->first_name.' '.$this->last_name;
    }

    public function agent(){
        return $this->belongsTo(User::class, 'agent_id', 'id');
    }
}
