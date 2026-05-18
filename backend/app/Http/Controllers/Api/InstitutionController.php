<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InstitutionController extends Controller
{
    public function profile(Request $request): JsonResponse
    {
        $profile = $request->user()->institutionProfile;
        if (!$profile) {
            return response()->json(['message' => 'Institution profile not found.'], 404);
        }
        return response()->json(['profile' => $profile]);
    }

    public function updateProfile(Request $request): JsonResponse
    {
        $profile = $request->user()->institutionProfile;
        if (!$profile) {
            return response()->json(['message' => 'Institution profile not found.'], 404);
        }

        $validated = $request->validate([
            'institution_name'          => 'nullable|string|max:255',
            'institution_name_local'    => 'nullable|string|max:255',
            'institution_type'          => 'nullable|string|max:100',
            'country'                   => 'nullable|string|max:100',
            'city'                      => 'nullable|string|max:100',
            'address'                   => 'nullable|string',
            'website'                   => 'nullable|url',
            'description'               => 'nullable|string',
            'intake_months'             => 'nullable|array',
            'accepted_qualifications'   => 'nullable|array',
            'required_language_scores'  => 'nullable|array',
            'tuition_fee_min'           => 'nullable|numeric|min:0',
            'tuition_fee_max'           => 'nullable|numeric|min:0',
            'currency'                  => 'nullable|string|max:10',
        ]);

        $profile->update($validated);

        return response()->json(['profile' => $profile]);
    }

    public function myLeads(Request $request): JsonResponse
    {
        $leads = Lead::where('assigned_institution_id', $request->user()->id)
            ->with('student:id,name,email')
            ->orderByDesc('created_at')
            ->paginate(20);

        return response()->json($leads);
    }
}
