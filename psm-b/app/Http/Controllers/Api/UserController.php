<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use app\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Role;

class UserController extends Controller
{

    public function getUserCounts()
    {
        $pesertaCount = User::whereHas('roles', function ($query) {
            $query->where('role_id', 1);
        })->count();

        $penganjurCount = User::whereHas('roles', function ($query) {
            $query->where('role_id', 2);
        })->count();

        $pentadbirCount = User::whereHas('roles', function ($query) {
            $query->where('role_id', 3);
        })->count();

        return response()->json([
            'peserta' => $pesertaCount,
            'penganjur' => $penganjurCount,
            'pentadbir' => $pentadbirCount,
        ]);
    }
    public function index()
    {
        return UserResource::collection(
            User::with(['roles:id,role', 'unit:id,unit'])->select('id', 'name', 'email', 'ic_no', 'position', 'department', 'unit_id', 'phone_no')->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ic_no' => 'required|string|max:12|unique:users',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'phone_no' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'unit_id' => [
                Rule::requiredIf(function () use ($request) {
                    return in_array(2, $request->input('roles', []));
                }),
                'nullable',
                'exists:units,id'
            ],
        ]);

        $user = User::create([
            'name' => $request->name,
            'ic_no' => $request->ic_no,
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
            'position' => $request->position,
            'department' => $request->department,
            'phone_no' => $request->phone_no,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'unit_id' => $request->unit_id,
        ]);

        // Attach role (assuming many-to-many)
        $user->roles()->attach($request->role);
        $user->roles()->sync($request->roles); // Sync roles

        return response()->json(['message' => 'User created successfully.']);
    }
    public function show($id)
    {
        $user = User::with('roles')->findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
            'ic_no' => 'required|string|max:12|unique:users,ic_no,' . $id, //validate unique except for ic_no
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'phone_no' => 'required|string|max:15',
            'unit_id' => [
                Rule::requiredIf(function () use ($request) {
                    return in_array(2, $request->input('roles', []));
                }),
                'nullable',
                'exists:units,id'
            ],

        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'ic_no' => $request->ic_no,
            'position' => $request->position,
            'department' => $request->department,
            'phone_no' => $request->phone_no,
            //'password' => Hash::make($request->password),
            'unit_id' => $request->unit_id,


        ]);

        $user->roles()->sync($request->roles); // Sync roles
        return response()->json(['message' => 'User updated successfully']);

    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Optional: Prevent deleting important users
        // if ($user->role === 'Admin') {
        //     return response()->json(['message' => 'Cannot delete admin'], 403);
        // }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

}
