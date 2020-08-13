<?php

namespace App\Providers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;

class MailProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function sendEMail($template, $to_name, $to_email, $data)
    {
        Mail::send('mailTemplate.' . $template, $data, function ($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Password recovery');
            $message->from(config('mail.from.address'), config('mail.from.name'));
        });

        if (Mail::failures()) {
            return false;
        }
        return true;
    }
}
