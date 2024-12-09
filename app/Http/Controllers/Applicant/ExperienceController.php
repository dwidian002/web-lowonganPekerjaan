<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\ApplicantProfile;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExperienceController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'job_Title' => 'required|string',
            'company_name' => 'required|string',
            'lama_bekerja' => 'required|string'
        ]);

        $user = auth()->user();
        $applicantProfile = ApplicantProfile::where('user_id', $user->id)->first();

        if (!$applicantProfile) {
            return redirect()->back()->with('error', 'Applicant profile not found.');
        }


        $experience = Experience::create([
            'applicant_profile_id' => $applicantProfile->id,
            'job_Title' => $request->job_Title,
            'company_name' => $request->company_name,
            'lama_bekerja' => $request->lama_bekerja,
        ]);

        try {
            $experience->save();
            return redirect(route('profile-more-info'))->with('pesan', ['success', 'You have successfully added your experience history']);
        } catch (\Exception $e) {
            return redirect(route('profile-more-info'))->with('pesan', ['danger', 'You have successfully added your experience history']);
        }
    }

    public function update(Request $request, $id)
    {
        Log::info('Update Experience Request', [
            'id' => $id,
            'request_data' => $request->all()
        ]);

        $this->validate($request, [
            'job_Title' => 'required|string',
            'company_name' => 'required|string',
            'lama_bekerja' => 'required|string'
        ]);

        try {
            $experience = Experience::findOrFail($request->experience_id);

            if ($experience->applicant_profile_id !== auth()->user()->applicantProfile->id) {
                return redirect()->back()->with('error', 'Unauthorized action.');
            }

            $experience->update([
                'job_Title' => $request->job_Title,
                'company_name' => $request->company_name,
                'lama_bekerja' => $request->lama_bekerja,
            ]);

            return redirect(route('profile-more-info'))
                ->with('success', 'experience updated successfully.');
        } catch (\Exception $e) {
            Log::error('experience Update Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update experience: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $experience = Experience::findOrFail($id);

            if ($experience->applicant_profile_id !== auth()->user()->applicantProfile->id) {
                return redirect()->back()->with('error', 'Unauthorized action.');
            }

            $experience->delete();
            return redirect(route('profile-more-info'))
                ->with('success', 'experience deleted successfully.');
        } catch (\Exception $e) {
            Log::error('experience Delete Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete experience: ' . $e->getMessage());
        }
    }
}
