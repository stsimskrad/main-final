<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationRegion extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'code';
    protected $keyType = 'string';

    public function provinces()
    {
        return $this->hasMany('App\Models\LocationProvince', 'region_code');
    } 

    public function endorsement()
    {
        return $this->hasOne('App\Models\Endorsement', 'scholar_id');
    } 
}
