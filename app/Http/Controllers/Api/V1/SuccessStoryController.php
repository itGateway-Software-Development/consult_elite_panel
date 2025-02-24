<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\SuccessStoryResource;
use App\Models\SuccessStory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuccessStoryController extends Controller
{
    public function index() {
        $stories = SuccessStoryResource::collection(SuccessStory::orderBy('created_at', 'desc')->get());

        return response()->json(['success_stories' => $stories]);
    }
}
