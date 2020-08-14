<?php

namespace App\Http\Controllers;

use App\Activity;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ProfileController extends Controller
{
    public function show(User $user){

        $activities = $user->activities()->latest()->with('subject')->paginate(30)->groupBy(function ($activity){
           return $activity->created_at->format('Y-m-d'); // this function grouping the activities by their date. it can by done as
                                                   // groupBy('created_at') but since this will bring back the time also, every instance will be unique
                                                   // so reformat the created at by this function to group them only by dates
        });




        return view('profiles.show', compact('user','activities'));
    }
}
