<?php

namespace App\modules\website\controllers;

use App\Http\Controllers\Controller;
use App\modules\website\services\WebsiteService;

class WebsiteController extends Controller
{
    protected WebsiteService $websiteService;
    public function __construct(WebsiteService $websiteService)
    {
        $this->websiteService = $websiteService;
    }
    public function showAppointmentForm()
    {
        return view('website::screens.apointment.appointment');
    }
}
