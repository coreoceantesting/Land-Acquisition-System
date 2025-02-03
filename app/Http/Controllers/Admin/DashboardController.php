<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\AcquisitionAssistantController;
use App\Models\AcquisitionAssistant;
use App\Models\User;
use App\Models\Village;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        $user = Auth::user(); // Get the logged-in user
        $userIds = User::where('officer_id', $user->id)->pluck('id')->toArray();

        if ($user->hasRole('Super Admin')) {
            // Super Admin: Get all data without filtering
            $acquisition_assistants = AcquisitionAssistant::count();
            $pending_count = AcquisitionAssistant::where('acquisition_officer_status', 0)->count();
            $approved_count = AcquisitionAssistant::where('acquisition_officer_status', 1)->count();
            $reject_count = AcquisitionAssistant::where('acquisition_officer_status', 2)->count();
        } elseif ($user->hasRole('Land Acquisition Officer')) {
            // Land Acquisition Officer: Filter by assigned user IDs
            $acquisition_assistants = AcquisitionAssistant::whereIn('user_id', $userIds)->count();
            $pending_count = AcquisitionAssistant::where('acquisition_officer_status', 0)->whereIn('user_id', $userIds)->count();
            $approved_count = AcquisitionAssistant::where('acquisition_officer_status', 1)->whereIn('user_id', $userIds)->count();
            $reject_count = AcquisitionAssistant::where('acquisition_officer_status', 2)->whereIn('user_id', $userIds)->count();
        }elseif ($user->hasRole('Sub-Divisional Officer')) {
            // Land Acquisition Officer: Filter by assigned user IDs
            $acquisition_assistants = AcquisitionAssistant::whereIn('user_id', $userIds)->count();
            $pending_count = AcquisitionAssistant::where('divisional_officer_status', 0)->whereIn('user_id', $userIds)->count();
            $approved_count = AcquisitionAssistant::where('divisional_officer_status', 1)->whereIn('user_id', $userIds)->count();
            $reject_count = AcquisitionAssistant::where('divisional_officer_status', 2)->whereIn('user_id', $userIds)->count();
          }  else {
            // Other Users: Filter by taluka_id
            $acquisition_assistants = AcquisitionAssistant::where('taluka_id', $user->taluka_id)->count();
            $pending_count = AcquisitionAssistant::where('acquisition_officer_status', 0)
                ->where('taluka_id', $user->taluka_id)
                ->count();
            $approved_count = AcquisitionAssistant::where('acquisition_officer_status', 1)
                ->where('taluka_id', $user->taluka_id)
                ->count();
            $reject_count = AcquisitionAssistant::where('acquisition_officer_status', 2)
                ->where('taluka_id', $user->taluka_id)
                ->count();
        }

        $village = Village::count();

        return view('admin.dashboard', compact('acquisition_assistants', 'pending_count', 'approved_count', 'reject_count', 'village'));
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
