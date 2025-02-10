<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\AcquisitionAssistantController;
use App\Models\AcquisitionAssistant;
use App\Models\District;
use App\Models\Taluka;
use App\Models\User;
use App\Models\Village;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        $districtCount = District::count();
        $talukaCount = Taluka::count();
        $villageCount = Village::count();

        $allRecords = AcquisitionAssistant::count();
        $pendingRecords = AcquisitionAssistant::where('acquisition_officer_status', 0)->count();
        $approvedRecords = AcquisitionAssistant::where('acquisition_officer_status', 1)->count();
        $recorrectionRecords = AcquisitionAssistant::where('acquisition_officer_status', 2)->count();

        $data = AcquisitionAssistant::query()
                                            ->with('taluka')
                                            ->get();

        $talukasData = $data->groupBy('taluka_id')->values();
        $districtData = $data->groupBy('district_id')->values();


        return view('admin.dashboard')->with([
                            'districtCount' => $districtCount,
                            'talukaCount' => $talukaCount,
                            'villageCount' => $villageCount,
                            'allRecords' => $allRecords,
                            'pendingRecords' => $pendingRecords,
                            'approvedRecords' => $approvedRecords,
                            'recorrectionRecords' => $recorrectionRecords,
                            'talukasData' => $talukasData,
                            'districtData' => $districtData,
                        ]);
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
