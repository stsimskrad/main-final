<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScholarProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'mobile',
        'firstname', 
        'lastname', 
        'middlename',
        'suffix',
        'gender',
        'mobile',
        'birthday',
        'information'
    ];

    public function scholar()
    {
        return $this->belongsTo('App\Models\Scholar', 'scholar_id', 'id');
    }

    public function getGenderAttribute($value)
    {
        switch ($value)
		{
			case 1: $sex='Male';break;
			case 2: $sex='Female';break;
			default:$sex=NULL;break;
		}
        return $sex;
    }
}
