<?php

namespace App\Http\Controllers\API;

use App\Models\Schedule;
// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ScheduleResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;
use Carbon\Carbon;

class ScheduleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::with(['teacher', 'faculty', 'room', 'course'])
            ->where('date', Carbon::now()->format('Y-m-d'))
            ->orderBy('date', 'desc')->orderBy('start_time', 'asc')->get();

        return $this->sendResponse(ScheduleResource::collection($schedules), __('Schedule fetched.'));
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
        $schedule = Schedule::with(['teacher', 'faculty', 'room', 'course'])
            ->whereHas('teacher', function (Builder $query) use ($id) {
                $query->where('id', $id)->orWhere('matricule', $id)
                    ->orWhere('footprint1', $id)->orWhere('footprint2', $id)
                    ->orWhere('footprint3', $id);
            })
            ->where('date', Carbon::now()->format('Y-m-d'))
            ->orderBy('date', 'desc')->orderBy('start_time', 'asc')->first();

        if (is_null($schedule)) {
            return $this->sendError(__('Schedule does not exist.'));
        }

        return $this->sendResponse(new ScheduleResource($schedule), __('Schedule fetched.'));
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
            'status' => 'required|in:waiting,in_progress,finish,absent',
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());
        }

        $schedule = Schedule::with(['teacher', 'faculty', 'room', 'course'])
            ->whereHas('teacher', function (Builder $query) use ($id) {
                $query->where('id', $id)->orWhere('matricule', $id)
                    ->orWhere('footprint1', $id)->orWhere('footprint2', $id)
                    ->orWhere('footprint3', $id);
            })
            ->orderBy('date', 'desc')->orderBy('start_time', 'asc')->first();
        $schedule->status = $request->status;
        $schedule->save();

        return $this->sendResponse(new ScheduleResource($schedule), 'Schedule updated.');
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
