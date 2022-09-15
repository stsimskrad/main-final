<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListPrivilege extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'type', 'regular_amount','summer_amount' ,'is_reimburseable' ,'is_fixed' ,'is_active'
    ];

    public function getNameAttribute($value)
    {
        return ucwords($value);
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
