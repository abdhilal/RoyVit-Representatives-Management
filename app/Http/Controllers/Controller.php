<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller
{
    protected $DashboardService;
    public function __construct(DashboardService $DashboardService)
    {
        $this->DashboardService = $DashboardService;

    }
    use AuthorizesRequests;

    public function dashboard()
    {
        return "Sacx";
        return view('layouts.app');
    }
}
