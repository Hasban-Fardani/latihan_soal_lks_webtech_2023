<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ;
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
 * Request
 * Headers:
 * Authorization: “Bearer <accessToken>”
 * 
 * Body (JSON):
 * {
 *   "name": "Stacks of Web Tech Members",
 *   "slug": "member-stacks",
 *   "allowed_domains": [ "webtech.id" ],
 *   "description": "To collect all of favorite stacks",
 *   "limit_one_response": true
 * }
 * Validation
 * :
 * name: 
 * required
 * slug:
 * required
 * unique
 * alphanumeric with special characters only dash “-” and dot “.” and without space
 * allowed_domains:
 * array 
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
    }

    /**
     * Display the specified resource.
     */
    public function show(Form $form)
    {
        //
    }
}
