<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\AssignUserRoleRequest;
use App\Http\Requests\Admin\ChangeUserPasswordRequest;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Department;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Models\District;
use App\Models\Taluka;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereNot('id', Auth::user()->id)->latest()->get();
        $roles = Role::orderBy('id', 'DESC')->whereNot('name', 'like', '%super%')->get();
        $districts = District::when(auth()->user()->roles[0]->name != 'Super Admin', fn($q) => $q->where('id', auth()->user()->district_id))->get();

        return view('admin.users')->with(['users' => $users, 'roles' => $roles, 'districts' => $districts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $districts = District::when(auth()->user()->roles[0]->name != 'Super Admin', fn($q) => $q->where('id', auth()->user()->district_id))->get();
        $talukas = Taluka::all();
        return view('admin.create_user', compact('districts', 'talukas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            DB::beginTransaction();

            $input = $request->validated();
            $input['password'] = Hash::make($input['password']);
            $user = User::create(Arr::only($input, Auth::user()->getFillable()));
            DB::table('model_has_roles')->insert(['role_id' => $input['role'], 'model_type' => 'App\Models\User', 'model_id' => $user->id]);

            DB::commit();

            return response()->json(['success' => 'User created successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'creating', 'User');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::whereNot('name', 'like', '%super%')->get();
        $user->loadMissing(['roles']);
        $districts = District::when(auth()->user()->roles[0]->name != 'Super Admin', fn($q) => $q->where('id', auth()->user()->district_id))->get();
        $userOfficerHtml = '';

        if ($user->officer_id) {
            $user->loadMissing(['officer.roles']);
            $userOfficers = User::withWhereHas('roles', fn($q) => $q->where('id', $user->officer->roles[0]->id))->get();
            $userOfficerHtml = '<span>
                <option value="">--Select User Officer --</option>';
            foreach ($userOfficers as $userOfficer):
                $is_select = $userOfficer->id == $user->officer_id ? "selected" : "";
                $userOfficerHtml .= '<option value="' . $userOfficer->id . '" ' . $is_select . '>' . $userOfficer->name . '</option>';
            endforeach;
            $userOfficerHtml .= '</span>';
        }

        $roleHtml = '<span>
            <option value="">--Select Role --</option>';
        foreach ($roles as $role):
            $is_select = $role->id == $user->roles[0]->id ? "selected" : "";
            $roleHtml .= '<option value="' . $role->id . '" ' . $is_select . '>' . $role->name . '</option>';
        endforeach;
        $roleHtml .= '</span>';

        $districtHtml = '<span>
            <option value="">--Select District --</option>';
        foreach ($districts as $district):
            $is_select = $district->id == $user->district_id ? "selected" : "";
            $districtHtml .= '<option value="' . $district->id . '" ' . $is_select . '>' . $district->district_name . '</option>';
        endforeach;
        $districtHtml .= '</span>';



        $response = [
            'result' => 1,
            'user' => $user,
            'roleHtml' => $roleHtml,
            'userOfficerHtml' => $userOfficerHtml,
            'districtHtml' => $districtHtml,
        ];

        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            DB::beginTransaction();

            $input = $request->validated();
            $user->update(Arr::only($input, Auth::user()->getFillable()));
            $user->roles()->detach();
            DB::table('model_has_roles')->insert(['role_id' => $input['role'], 'model_type' => 'App\Models\User', 'model_id' => $user->id]);

            DB::commit();

            return response()->json(['success' => 'User updated successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'updating', 'User');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function toggle(Request $request, User $user)
    {
        $current_status = DB::table('users')->where('id', $user->id)->value('active_status');
        try {
            DB::beginTransaction();
            if ($current_status == '1') {
                User::where('id', $user->id)->update(['active_status' => '0']);
            } else {
                User::where('id', $user->id)->update(['active_status' => '1']);
            }
            DB::commit();
            return response()->json(['success' => 'User status updated successfully']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'changing', 'User\'s status');
        }
    }

    public function retire(Request $request, User $user)
    {
        try {
            DB::beginTransaction();
            $user->delete();
            DB::commit();
            return response()->json(['success' => 'Employee retired successfully']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'changing', 'Employee\'s retirement status');
        }
    }

    public function changePassword(ChangeUserPasswordRequest $request, User $user)
    {
        $input = $request->validated();
        try {
            DB::beginTransaction();
            $user->update(['password' => Hash::make($input['new_password'])]);
            DB::commit();
            return response()->json(['success' => 'Password updated successfully']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'changing', 'User\'s password');
        }
    }


    public function getRole(User $user)
    {
        $user->load('roles');
        if ($user) {
            $roles = Role::orderBy('id', 'DESC')->get();
            $roleHtml = '<span>
                <option value="">--Select Role--</option>';
            foreach ($roles as $role):
                $is_select = $role->id == $user->roles[0]->id ? "selected" : "";
                $roleHtml .= '<option value="' . $role->id . '" ' . $is_select . '>' . $role->name . '</option>';
            endforeach;
            $roleHtml .= '</span>';

            $response = [
                'result' => 1,
                'user' => $user,
                'roleHtml' => $roleHtml,
            ];
        } else {
            $response = ['result' => 0];
        }
        return $response;
    }


    public function assignRole(User $user, AssignUserRoleRequest $request)
    {
        try {
            DB::beginTransaction();
            $user->roles()->detach();
            DB::table('model_has_roles')->insert(['role_id' => $request->edit_role, 'model_type' => 'App\Models\User', 'model_id' => $user->id]);
            DB::commit();
            return response()->json(['success' => 'Role updated successfully']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'changing', 'User\'s role');
        }
    }

    public function getOfficers($roleId)
    {
        $officers = User::withWhereHas('roles', fn($query) => $query->where('role_id', $roleId))->get(['id', 'name']);

        return response()->json($officers);
    }

    public function getDistricts($officerId)
    {
        $districts = District::whereHas('users', function ($q) use ($officerId) {
            $q->where('id', $officerId);
        })->select('id', 'district_name')->first();
        // $districts = User::with('district')->where('officer_id', $officerId)->first();

        return response()->json(['districts' => $districts]);
    }
}
