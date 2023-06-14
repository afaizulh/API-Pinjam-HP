<?php

namespace App\Http\Controllers;

use App\Http\Resources\GetAllStatusResource;
use App\Models\handphones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HandphonesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['store', 'update']);
    }

    public function index()
    {
        $phone = handphones::all();

        return GetAllStatusResource::collection($phone);
    }

    function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone_name' => 'required',
        ]);

        if($request->file){
            $validated = $request->validate([
                'file' => 'mimes:jpg,jpeg,png|max:100000',
            ]);

            $fileName = $this->generateRandomString();
            $extension = $request->file->extension();

            Storage::putFileAs('image', $request->file, $fileName.'.'.$extension);

            $request['owner'] = Auth::user()->id;
            $request['image'] = $fileName.'.'.$extension;
            $phone = handphones::create($request->all());
        }

        $request['owner'] = Auth::user()->id;
        $phone = handphones::create($request->all());

        return response()->json($phone);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $request['borrower'] = Auth::user()->id;
        $phone = handphones::findOrFail($id);

        $phone->update($request->all());

        return response()->json($phone);
    }

    public function unborrow(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        if (handphones::findOrFail($id)->status = 'AVAILABLE') {
            $request['borrower'] = null;
            $phone = handphones::findOrFail($id);
            $phone->update($request->all());

            return response()->json($phone);
        }
    }
}
