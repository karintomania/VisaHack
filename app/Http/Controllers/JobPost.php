<?php

namespace App\Http\Controllers;

use App\Models\JobPost as JobPostModel;
use Illuminate\Http\Request;

class JobPost extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(int $id)
    {

        // return 404 page if not found
        $job = JobPostModel::active()->findOrFail($id);

        return view('job_posts/job_post', ['job' => $job]);
    }
}
