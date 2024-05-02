<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{    
    // Admin Methods
    public function subscriptionListData() {
        return view('admin.subscription.index');
    }


    // Recruiter Methods
    public function subscriptionList() {
        return view('recruiter.subscription.index');
    }
}
