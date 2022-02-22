<?php

namespace App\Services;

use App\Models\Application;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ApplicationMails {

    public function new($application) {
        $data = [
            'userName' => auth()->user()->name,
            'vacation_start' => $application->datefrom->format('d-M-Y'),
            'vacation_end' => $application->dateto->format('d-M-Y'),
            'reason' => $application->reason,
            'approvedUrl' => url("applications/{$application->id}/approved"),
            'rejectedUrl' => url("applications/{$application->id}/rejected"),
        ];
        $admin = User::find(1);
        Mail::send('emails.applications.new', ['data' => $data], function ($m) use ($admin) {
            $m->from('noreply@evacation.test', 'eVacation App');
            $m->to($admin->email, $admin->name)->subject('New Application - Evacation');
        });
    }

    public function statusUpdate($application, $status) {
        $user = $application->user;
        $data = [
            'requested_date' => $application->created_at->format('d-M-Y'),
            'status' => Application::STATUS[$status],
        ];
        Mail::send('emails.applications.status', ['data' => $data], function ($m) use ($user) {
            $m->from('noreply@evacation.test', 'eVacation App');
            $m->to($user->email, $user->name)->subject('Application - Evacation');
        });
    }
}
