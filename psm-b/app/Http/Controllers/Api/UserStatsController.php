<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class UserStatsController extends Controller
{
    public function getUserRoleCounts()
    {
        // Get count of users per role
        $counts = Role::whereIn('name', ['Peserta', 'Penganjur', 'Pentadbir'])
            ->withCount('users')
            ->get()
            ->pluck('users_count', 'name');

        // Ensure all roles return even if zero
        $response = [
            'Peserta' => $counts->get('Peserta', 0),
            'Penganjur' => $counts->get('Penganjur', 0),
            'Pentadbir' => $counts->get('Pentadbir', 0),
        ];

        return response()->json($response);
    }
}
