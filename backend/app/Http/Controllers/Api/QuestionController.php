<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Form $form)
    {
        // validate request
        $validator = Validator::make([
            'name' => 'required',
            'choice_type' => 'required|in:short_answer,paragraph,date,multiple_choice,dropdown,checkboxes',
            'choices' => 'required_if:choice_type,multiple_choice,dropdown,checkboxes',
            'is_required' => 'required|in:true,false|default:false',
        ]);

        // validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid field',
                'errors' => $validator->errors(),
            ]);
        }

        // try to access other user form
        if (auth()->user()->id != $form->creator_id) {
            return response()->json([
                'message' => 'Forbidden access'
            ]);
        }

        return response()->json([
            'message' => ''
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }
}
