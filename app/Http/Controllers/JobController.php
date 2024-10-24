<?php

namespace App\Http\Controllers;

use App\Models\FieldOfWork;
use App\Models\JobCategory;
use App\Models\Location;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $categories = JobCategory::all();
        $locations = Location::all();
        $fields = FieldOfWork::all();
        return view('job.all', compact('categories', 'locations', 'fields'));
    }
}
