<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\handphones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\FeedbackResource;

class FeedbackController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth:sanctum')->only('store');
        $this->middleware('isAdmin')->only('store');
    }

    public function index()
    {
        $feedback = Feedback::all();

        return FeedbackResource::collection($feedback);
    }

    public function store(Request $request)
    {
        $request->validate([
            'feedback' => 'required',
            'handphone_id' =>'required|exists:handphones,id'
        ]);

        $request['user_id'] = Auth::user()->id;
        
        $status = Feedback::create($request->all());
        
        return response()->json($status);
    }
}
