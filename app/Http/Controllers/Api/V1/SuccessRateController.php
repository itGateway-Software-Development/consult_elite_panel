<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessRateResource;
use App\Models\SuccessRate;
use Illuminate\Http\Request;

class SuccessRateController extends Controller
{
    public function index(){
        $rates = SuccessRateResource::collection(SuccessRate::take(4)->orderBy('order_number', 'asc')->get());

        return response()->json(['success_rates' => $rates]);
    }
}
