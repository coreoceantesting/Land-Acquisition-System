<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\AcquisitionAssistantController;


class DashboardController extends Controller
{

    public function index()
    {
        // $pendingCount = AcquisitionAssistantController::where('acquisition_officer_status	', 0)->count();
        // $approvedCount = AcquisitionAssistantController::where('acquisition_officer_status	', 1)->count();
        // $rejectedCount = AcquisitionAssistantController::where('acquisition_officer_status	', 2)->count();
        return view('admin.dashboard');
    }

    public function changeThemeMode()
    {
        $mode = request()->cookie('theme-mode');

        if($mode == 'dark')
            Cookie::queue('theme-mode', 'light', 43800);
        else
            Cookie::queue('theme-mode', 'dark', 43800);

        return true;
    }
}
