<?php

use App\modules\appointment\provider\AppointmentServiceProvider;
use App\Modules\Patient\Providers\PatientServiceProvider;

return [
    App\Modules\Auth\Providers\AuthServiceProvider::class,
    App\Modules\Dashboard\Providers\DashboardServiceProvider::class,
    App\Modules\Website\Providers\WebsiteServiceProvider::class,
    App\Providers\AppServiceProvider::class,
    App\modules\treatment\providers\TreatmentServiceProvider::class,
    App\modules\user\providers\UserServiceProvider::class,
    AppointmentServiceProvider::class,
    PatientServiceProvider::class
];
