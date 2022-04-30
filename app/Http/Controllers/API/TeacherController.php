<?php

namespace App\Http\Controllers\API;

use App\Models\Teacher;
// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TeacherResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;
use Illuminate\Validation\Rule;

class TeacherController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tearchers = Teacher::orderBy('last_name')->orderBy('first_name')->get();

        return $this->sendResponse(TeacherResource::collection($tearchers), __('Teachers fetched.'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tearcher = Teacher::where('id', $id)->orWhere('matricule', $id)->orWhere('footprint1', $id)
            ->orWhere('footprint2', $id)->orWhere('footprint3', $id)->first();
        if (is_null($tearcher)) {
            return $this->sendError(__('Teacher does not exist.'));
        }
        return $this->sendResponse(new TeacherResource($tearcher), __('Teacher fetched.'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'footprint1' => ['nullable', Rule::unique('teachers', 'footprint1')->ignore($id)],
            'footprint2' => ['nullable', Rule::unique('teachers', 'footprint2')->ignore($id)],
            'footprint3' => ['nullable', Rule::unique('teachers', 'footprint3')->ignore($id)],
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());
        }

        if (count($request->all()) < 1) {
            return $this->sendError('error', ['error'=>__('No data was sent')]);
        }

        $tearcher = Teacher::findOrFail($id);
        if ($request->footprint1) {
            $tearcher->footprint1 = $request->footprint1;
        }
        if ($request->footprint2) {
            $tearcher->footprint2 = $request->footprint2;
        }
        if ($request->footprint3) {
            $tearcher->footprint3 = $request->footprint3;
        }
        $tearcher->save();

        return $this->sendResponse(new TeacherResource($tearcher), 'Teacher updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
