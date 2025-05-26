<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\department;
use App\Models\designation;
use Illuminate\Support\Facades\DB;
class DesignationController extends Controller
{
    public function getDesignation(Request $request)
    {
        $designation = DB::table('designations')
            ->where('department_id', $request->department_id)
            ->get();

        if (count($designation) > 0) {
            return response()->json($designation);
        }
    }
}
