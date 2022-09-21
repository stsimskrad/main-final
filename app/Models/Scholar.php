<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholar extends Model
{
    use HasFactory;

    protected $fillable = [
        'spas_id',
        'lrn', 
        'program_id',
        'status_id',
        'awarded_year',
        'is_undergrad',
    ];

    public function endorsement()
    {
        return $this->hasOne('App\Models\Endorsement', 'scholar_id');
    } 

    public function profile()
    {
        return $this->hasOne('App\Models\ScholarProfile', 'scholar_id');
    }

    public function address()
    {
        return $this->hasOne('App\Models\ScholarAddress', 'scholar_id');
    }  

    public function education()
    {
        return $this->hasOne('App\Models\ScholarEducation', 'scholar_id');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\ListDropdown', 'status_id', 'id');
    }

    public function program()
    {
        return $this->belongsTo('App\Models\ListProgram', 'program_id', 'id');
    }   
    
    public function getUpdatedAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }
}
