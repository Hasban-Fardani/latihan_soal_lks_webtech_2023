<?php

namespace App\Http\Controllers\Api;

use App\Models\Form;
use App\Http\Controllers\Controller;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // get form
        $form = Form::whereSlug($request->route('form'))->first();

        // if form not found
        if (!$form) {
            return response()->json([
                'message' => 'Form not found'
            ])->setStatusCode(404);
        }

        // try to access other user form
        if (auth()->user()->id != $form->creator_id) {
            return response()->json([
                'message' => 'Forbidden access'
            ])->setStatusCode(403);
        }

        // success get responses
        $responses = Response::with(['user', 'answers', 'answers.question'])->get();
        return response()->json([
            'message' => 'Get responses success',
            'responses' => $responses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // get user
        $user = auth('sanctum')->user();
        
        if(!$user) {
            return response()->json([
                'message' => 'Unauthenticated',
            ])->setStatusCode(401);
        }
        
        // get form
        $form = Form::whereSlug($request->route('form'))->first();

        // get user domain
        list($userName, $domain) = explode('@', $user->email);

        // if domain not allowed
        if (!in_array($domain, $form->allowed_domains->pluck('domain')->toArray())) {
            return response()->json([
                'message' => 'Forbidden access',
            ])->setStatusCode(403);
        }

        $validator = Validator::make($request->all(), [
           'answers' => 'required|array',
           'answers.*.question_id' => 'required|exists:questions,id',
           'answers.*.value' => 'required_if:question.is_required,1',
        ]);

        // dd($validator->validated()['answers']);
        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid field',
                'errors' => $validator->errors()
            ])->setStatusCode(422);
        }
        
        // if user submit twice
        $checkResponse = Response::where('user_id', $user->id)
            ->where('form_id', $form->id)
            ->get();

        if ($checkResponse){
            return response()->json([
                'message' => "You can not submit twice",
            ])->setStatusCode(401);
        }

        // create response
        $response = Response::create([
            'form_id' => $form->id,
            'user_id' => $user->id,
            'date' => now(),
        ]);

        // store answers
        foreach ($validator->validated()['answers'] as $answer) {
            $response->answers()->create($answer);
        }

        return response()->json([
            'message' => 'Submit response success',
        ]);
    }
}
