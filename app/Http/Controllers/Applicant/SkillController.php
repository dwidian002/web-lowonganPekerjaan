<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\ApplicantProfile;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SkillController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        try {
            $user = auth()->user();
            $applicantProfile = ApplicantProfile::where('user_id', $user->id)->first();

            if (!$applicantProfile) {
                return redirect()->back()->with('pesan', ['danger', 'Applicant profile not found.']);
            }

            Skill::create([
                'applicant_profile_id' => $applicantProfile->id,
                'name' => $request->name,
            ]);

            return redirect(route('profile-more-info'))->with('pesan', ['success', 'You have successfully added your Skill']);
        } catch (\Exception $e) {
            Log::error('Skill Store Error: ' . $e->getMessage());
            return redirect(route('profile-more-info'))->with('pesan', ['danger', 'Failed to add Skill: ' . $e->getMessage()]);
        }
    }


    public function update(Request $request, $id)
    {
        Log::info('Update Skill Request', [
            'id' => $id,
            'request_data' => $request->all()
        ]);

        $this->validate($request, [
            'skill_id' => 'required|exists:skills,id',
            'name' => 'required|string',
        ]);

        try {
            $skill = Skill::findOrFail($request->skill_id);

            if ($skill->applicant_profile_id !== auth()->user()->applicantProfile->id) {
                return redirect()->back()->with('error', 'Unauthorized action.');
            }

            $skill->update([
                'name' => $request->name,
            ]);

            return redirect(route('profile-more-info'))
                ->with('success', 'Skill updated successfully.');
        } catch (\Exception $e) {
            Log::error('Skill Update Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update Skill: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $skill = Skill::findOrFail($id);

            if ($skill->applicant_profile_id !== auth()->user()->applicantProfile->id) {
                return redirect()->back()->with('error', 'Unauthorized action.');
            }

            $skill->delete();
            return redirect(route('profile-more-info'))
                ->with('success', 'Skill deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Skill Delete Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete Skill: ' . $e->getMessage());
        }
    }
}
