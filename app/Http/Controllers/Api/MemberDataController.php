<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Member;

class MemberDataController extends Controller
{
    public function show($id)
    {
        $member = Member::with(['user', 'vehicles'])->findOrFail($id);

        return response()->json([
            'member' => [
                'id' => $member->id,
                'name' => $member->name,
            ],
            'vehicles' => $member->vehicles->map(fn ($v) => [
                'id' => $v->id,
                'vehicle_type' => ucfirst($v->vehicle_type),
                'number_plat' => $v->number_plat,
            ]),
        ]);
    }
}
