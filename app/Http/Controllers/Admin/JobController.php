<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobPosting = JobPosting::with([
            'companyProfile',
            'location',
            'fieldOfWork',
            'jobCategory'
        ])
            ->latest()
            ->paginate(10);

        return view('admin.job-posting.all', compact('jobPosting'));
    }


    public function detail($id)
    {
        $jobPosting = JobPosting::with([
            'companyProfile',
            'location',
            'fieldOfWork',
            'jobCategory'
        ])->findOrFail($id);

        return view('admin.job-posting.detail', compact('jobPosting'));
    }

    public function delete($id)
    {
        try {
            $jobPosting = JobPosting::findOrFail($id);
            $jobPosting->delete();

            return redirect()->route('all-job')
                ->with('success', 'Job successfully deleted');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal successfully deleted: ' . $e->getMessage());
        }
    }
}
