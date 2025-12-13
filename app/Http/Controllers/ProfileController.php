<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserInformation;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\ProfilePasswordUpdateRequest;
use App\Services\PrfileService;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(PrfileService $profileService)
    {
        $this->profileService = $profileService;
    }
    public function index()
    {
        $user = auth()->user();
        $userInformations = $this->profileService->getUserInformations();
        return view('pages.dashboard.profile.index', compact('user', 'userInformations'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        $userInformations = $this->profileService->getUserInformations();
        $this->profileService->update( $request->all());

        return redirect()->route('profile.index')->with('success', __('Profile updated successfully'));
    }

    public function updatePassword(ProfilePasswordUpdateRequest $request)
    {
        $user = auth()->user();
        $this->profileService->updatePassword($user, $request->all());

        return redirect()->route('profile.index')->with('success', __('Password updated successfully'));
    }
}
