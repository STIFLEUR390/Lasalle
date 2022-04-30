<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\AppSetting;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function __invoke(Request $request)
    {
        if (!empty($request->search_type) && !empty($request->search_value) && $request->search_date) {
            $schedules = Schedule::with(['teacher', 'faculty', 'room', 'course'])->where("date", $request->search_date)->where($request->search_type, $request->search_value)->orderBy('date', 'desc')->orderBy('start_time', 'asc')->get()->toArray();
        } else if (!empty($request->search_type) && !empty($request->search_value)) {
            $schedules = Schedule::with(['teacher', 'faculty', 'room', 'course'])->where($request->search_type, $request->search_value)->orderBy('date', 'desc')->orderBy('start_time', 'asc')->get()->toArray();
        } else if ($request->search_date) {
            $schedules = Schedule::with(['teacher', 'faculty', 'room', 'course'])->where("date", $request->search_date)->orderBy('date', 'desc')->orderBy('start_time', 'asc')->get()->toArray();
        } else {
            $schedules = Schedule::with(['teacher', 'faculty', 'room', 'course'])->orderBy('date', 'desc')->orderBy('start_time', 'asc')->get()->toArray();
        }

        $app_setting = AppSetting::find(1)->toArray();
        $pdf = PDF::loadView('exports.schedule-style', [
            'schedules' => $schedules,
            'app_setting' => $app_setting
        ]);

        $namePdf = __('Schedule').'.pdf';

        return $pdf->download($namePdf);
    }
}
