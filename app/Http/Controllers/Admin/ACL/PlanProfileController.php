<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;

class PlanProfileController extends Controller
{
    private $profile, $plan;

    public function __construct(Profile $profile, Plan $plan)
    {
        $this->profile = $profile;
        $this->plan = $plan;

        $this->middleware(['can:Plans']);
    }

    public function plans(Request $request, $idProfile)
    {
        if (!$profile = $this->profile->find($idProfile))
            return redirect()->back();

        $filters = $request->except('_token');

        $plans = $profile->plansAtaccheds($request->filter);

        return view('admin.pages.profiles.plans.plans', [
            'profile' => $profile,
            'plans' => $plans,
            'filters' => $filters
        ]);
    }

    public function profiles(Request $request, $idPlan)
    {
        if (!$plan = $this->plan->find($idPlan))
            return redirect()->back();

        $filters = $request->except('_token');

        $profiles = $plan->profilesAtaccheds($request->filter);

        return view('admin.pages.plans.profiles.profiles', [
            'profiles' => $profiles,
            'plan' => $plan,
            'filters' => $filters
        ]);
    }

    public function plansAvailable(Request $request, $idProfile)
    {
        if (!$profile = $this->profile->find($idProfile))
            return redirect()->back();

        $filters = $request->except('_token');

        $plans = $profile->plansAvailable($request->filter);

        return view('admin.pages.profiles.plans.available', [
            'profile' => $profile,
            'plans' => $plans,
            'filters' => $filters
        ]);
    }

    public function plansAttach(Request $request, $idProfile)
    {
        if ((!$profile = $this->profile->find($idProfile)) || (!$request->plans))
            return redirect()->back();

        $profile->plans()->attach($request->plans);

        return redirect()->route('admin.profiles.plans', $profile->id);
    }

    public function plansDetach($idProfile, $idPlan)
    {
        $profile = $this->profile->with('plans')->find($idProfile);
        $plan = $profile->plans->find($idPlan);


        if (!$profile || !$plan)
            return redirect()->back();

        $profile->plans()->detach($plan);

        return redirect()->back();
    }
}
