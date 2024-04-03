<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AllowedDomain;
use App\Models\Form;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forms = Form::with('allowed_domains')->get();    
        return response()->json([
            'message' => 'Get all forms success',
            'forms' => $forms,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:forms,slug|alpha_dash|regex:/^[a-zA-Z0-9\-\.]+$/',
            'allowed_domains' => 'array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid field',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $request->except('allowed_domains');
        $data['creator_id'] = $request->user()->id;
        $form = Form::create($data);

        foreach ($request->input('allowed_domains') as $domain) {
            AllowedDomain::create([
                'form_id' => $form->id,
                'domain' => $domain,
            ]);
        }

        return response()->json([
            'message' => 'Create form success',
            'form' => $form,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $form = Form::whereSlug($request->slug)->with(['questions', 'allowed_domains'])->first();

        if (!$form) {
            return response()->json([
                'message' => 'Form not found',
            ])->setStatusCode(404);
        }

        $user = auth('sanctum')->user();
        
        if(!$user) {
            return response()->json([
                'message' => 'Unauthenticated',
            ])->setStatusCode(401);
        }
        
        // get user domain
        list($userName, $domain) = explode('@', $user->email);

        if (!in_array($domain, $form->allowed_domains->pluck('domain')->toArray())) {
            return response()->json([
                'message' => 'Forbidden access',
            ])->setStatusCode(403);
        }

        return response()->json([
            'message' => 'Get form success',
            'form' => $form,
        ]);
    }
}
