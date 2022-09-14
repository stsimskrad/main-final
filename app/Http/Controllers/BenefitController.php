<?php

namespace App\Http\Controllers;

use App\Models\ListBenefit;
use Illuminate\Http\Request;

class BenefitController extends Controller
{
    public function api(){
        $data = ListBenefit::all();
        return $data;
    }
}
