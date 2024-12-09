<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\ApplicantProfile;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EducationController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'degree' => 'required|string',
            'institution_name' => 'required|string',
            'starting_year' => 'required|integer|max:' . date('Y'),
            'finishing_year' => 'required|integer|max:' . (date('Y') + 10) . '|gte:starting_year',
        ]);

        try {
            $user = auth()->user();
            $applicantProfile = ApplicantProfile::where('user_id', $user->id)->first();

            if (!$applicantProfile) {
                return redirect()->back()->with('pesan', ['danger', 'Applicant profile not found.']);
            }

            Education::create([
                'applicant_profile_id' => $applicantProfile->id,
                'degree' => $request->degree,
                'institution_name' => $request->institution_name,
                'starting_year' => $request->starting_year,
                'finishing_year' => $request->finishing_year,
            ]);

            return redirect(route('profile-more-info'))->with('pesan', ['success', 'You have successfully added your educational history']);
        } catch (\Exception $e) {
            Log::error('Education Store Error: ' . $e->getMessage());
            return redirect(route('profile-more-info'))->with('pesan', ['danger', 'Failed to add educational history: ' . $e->getMessage()]);
        }
    }


    public function update(Request $request, $id)
    {
        Log::info('Update Education Request', [
            'id' => $id,
            'request_data' => $request->all()
        ]);

        $this->validate($request, [
            'education_id' => 'required|exists:education,id',
            'degree' => 'required|string',
            'institution_name' => 'required|string',
            'starting_year' => 'required|integer|max:' . date('Y'),
            'finishing_year' => 'required|integer|max:' . (date('Y') + 10),
        ]);

        try {
            $education = Education::findOrFail($request->education_id);

            if ($education->applicant_profile_id !== auth()->user()->applicantProfile->id) {
                return redirect()->back()->with('error', 'Unauthorized action.');
            }

            $education->update([
                'degree' => $request->degree,
                'institution_name' => $request->institution_name,
                'starting_year' => $request->starting_year,
                'finishing_year' => $request->finishing_year,
            ]);

            return redirect(route('profile-more-info'))
                ->with('success', 'Education updated successfully.');
        } catch (\Exception $e) {
            Log::error('Education Update Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update education: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $education = Education::findOrFail($id);

            if ($education->applicant_profile_id !== auth()->user()->applicantProfile->id) {
                return redirect()->back()->with('error', 'Unauthorized action.');
            }

            $education->delete();
            return redirect(route('profile-more-info'))
                ->with('success', 'Education deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Education Delete Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete education: ' . $e->getMessage());
        }
    }
}
