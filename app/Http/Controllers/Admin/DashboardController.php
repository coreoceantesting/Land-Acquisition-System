<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\AcquisitionAssistantController;
use App\Models\AcquisitionAssistant;
use App\Models\Village;

class DashboardController extends Controller
{

    public function index()
    {

        $acquisition_assistants = AcquisitionAssistant::count();
        $pending_count = AcquisitionAssistant::where('acquisition_officer_status', 0)->count();
        $approved_count =AcquisitionAssistant::where('acquisition_officer_status', 1)->count();
        $reject_count =AcquisitionAssistant::where('acquisition_officer_status', 2)->count();
        $village =Village::count();
        return view('admin.dashboard', compact('acquisition_assistants','pending_count', 'approved_count','reject_count','village'));
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
