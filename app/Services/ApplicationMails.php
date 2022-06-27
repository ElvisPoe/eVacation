<?php

namespace App\Services;

use App\Models\Application;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ApplicationMails {

    /*
     * On creating a new application.
     * Sending a notification email to the admin.
     * */
    public function new($application) {
        $data = [
            'userName' => auth()->user()->name,
            'vacation_days' => $application->days,
            'vacation_start' => $application->datefrom->format('d-M-Y'),
            'vacation_end' => $application->dateto->format('d-M-Y'),
            'reason' => $application->reason,
            'approvedUrl' => url("applications/{$application->id}/approved"),
            'rejectedUrl' => url("applications/{$application->id}/rejected"),
        ];
        $admin = User::where('role', 1)->first();
        Mail::send('emails.applications.new', ['data' => $data], function ($m) use ($admin) {
            $m->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
            $m->to($admin->email, $admin->name)->subject('New Application - ' . env('APP_NAME'));
        });
    }

    /*
     * On updating the application status.
     * Sending a notification email to the user.
     * */
    public function statusUpdate($application, $status) {
        $user = $application->user;
        $data = [
            'requested_date' => $application->created_at->format('d-M-Y'),
            'status' => Application::STATUS[$status],
        ];
        Mail::send('emails.applications.status', ['data' => $data], function ($m) use ($user) {
            $m->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
            $m->to($user->email, $user->name)->subject('Application Update - ' . env('APP_NAME'));
        });
    }
}
