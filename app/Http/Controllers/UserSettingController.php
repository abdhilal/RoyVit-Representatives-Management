<?php

namespace App\Http\Controllers;

use App\Models\UserSetting;
use Illuminate\Http\Request;
use App\Services\UserSettingService;
use App\Http\Requests\UserSettingUpdateRequest;

class UserSettingController extends Controller
{
    protected $userSettingService;

    public function __construct(UserSettingService $userSettingService)
    {
        $this->userSettingService = $userSettingService;
    }
    
    public function index()
    {
        $userSetting = UserSetting::firstOrCreate(['id'=> auth()->user()->id]);
        return view('pages.dashboard.user-settings.index', compact('userSetting'));
    }

    public function update(UserSettingUpdateRequest $request){

        $userSetting =UserSetting::firstOrCreate(['id'=> $request->user()->id]);
        $this->userSettingService->update($userSetting, $request->toArray());

        return redirect()->back()->with('success', __('Settings updated successfully'));
    }

    public function setMode(UserSettingUpdateRequest $request){

        $userSetting = UserSetting::firstOrCreate(['id'=> $request->user()->id]);
        $this->userSettingService->setMode($userSetting,$request->mode);
        return redirect()->back()->with('success', __('Mode updated successfully'));


    }    
    
    public function setLocale(UserSettingUpdateRequest $request)
    {
        $userSetting = UserSetting::firstOrCreate(['id'=> $request->user()->id]);
        $this->userSettingService->setLocale($userSetting,$request->locale);
        return redirect()->back()->with('success', __('Locale updated successfully'));
    }
    /**
     * Set default settings for the user.
     */
    public function setDefault(){

        $userSetting = UserSetting::firstOrCreate(['id'=> auth()->user()->id]);
        $this->userSettingService->setDefault($userSetting);
        return redirect()->back()->with('success', __('Default settings set successfully'));
    }
}
