<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Lead;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReplyContactUsEmail;

class LeadController extends Controller
{
    public function store(Request $request) {
        $data = $request->all();

        $validated_data = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|max:60000'
        ]);

        if($validated_data->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validated_data->errors()
            ]);
        }

        $new_lead = New Lead();
        $new_lead->fill($data);
        $new_lead->save();

        Mail::to($new_lead->email)->send(new ReplyContactUsEmail());

        return response()->json([
            'success' => true
        ]);
    }
}