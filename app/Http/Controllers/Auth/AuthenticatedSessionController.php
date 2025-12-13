<?php

namespace App\Http\Controllers\Auth;

use App\Models\UserSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserSettingService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    protected $userSettingService;
    public function __construct(UserSettingService $userSettingService)
    {
        $this->userSettingService = $userSettingService;
    }
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();


        $session = $request->session();
        $session->regenerate();
        $user=Auth::user();

        $userSettings = UserSetting::firstOrCreate(['id' => $user->id]);

        $this->userSettingService->setSessions($userSettings);


        return redirect()->route('home');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        session()->flush();

        return redirect()->route('login');
    }
}
