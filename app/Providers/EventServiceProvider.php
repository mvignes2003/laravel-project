<?php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\Register;
use App\Listeners\SendWelcomeEmail; // If you have a listener

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Register::class => [
            SendWelcomeEmail::class, // Example listener (optional)
        ],
    ];
}
