<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class QuestionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $must_have_choices = ['multiple choice', 'checkboxes', 'dropdown'];

        // validate request
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'choice_type' => 'required|in:short answer,paragraph,date,multiple choice,dropdown,checkboxes',
            'choices' => Rule::requiredIf(fn () => in_array($request->choice_type, $must_have_choices)),
            'is_required' => 'required|boolean',
        ]);

        // validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid field',
                'errors' => $validator->errors(),
            ])->setStatusCode(422);
        }

        // get form 
        $form = Form::whereSlug($request->route('form'))->first();
        if(!$form) {
            return response()->json([
                'message' => 'Form not found'
            ])->setStatusCode(404);
        }

        $data = $validator->validated();
        $data['form_id'] = $form->id;

        if (in_array($data['choice_type'], $must_have_choices)) {
            $data['choices'] = implode(',', $data['choices']);
        }

        $question = Question::create($data);

        return response()->json([
            'message' => 'Add question success',
            'question' => $question 
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $form = Form::whereSlug($request->route('form'))->first();

        if (!$form) {
            return response()->json([
                'message' => 'Form not found'
            ])->setStatusCode(404);
        }
        
        $question = Question::where('id',$request->route('question'))->first();
        
        if (!$question) {
            return response()->json([
                'message' => 'Question not found'
            ])->setStatusCode(404);
        }
        
        // try to access other user form
        if (auth()->user()->id != $form->creator_id) {
            return response()->json([
                'message' => 'Forbidden access'
            ])->setStatusCode(403);
        }

        $question->delete();

        return response()->json([
            'message' => 'Remove question success'
        ]);
    }
}
