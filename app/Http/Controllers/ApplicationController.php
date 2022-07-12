<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Period;
use App\Models\Application;
use App\Http\Requests\UpdateApplicationRequest;
use App\Services\ApplicationMails;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $applications = Application::when($request->status, function ($query, $status){
            $query->where('status', $status);
        })->paginate(10);

        return view('admin.applications.index', [
            'filter' => $request->status,
            'applications' => $applications
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('user.applications.create');
    }

    /**
     * Accept a new application.
     *
     * @param  \App\Models\Application  $application
     */
    public function setStatus(Application $application, $status, ApplicationMails $applicationMails)
    {
        if(array_key_exists($status, Application::STATUS)){
            $application->status = $status;
            $application->save();

            if($status === 'approved'){
                $period = Period::find($application->user->periods->where('year', date('Y'))->first()->id);
                $period->days = $period->days - $application->days;
                $period->save();
            }

            // Send Email
            if(env('MAIL_ENABLE')){
                $applicationMails->statusUpdate($application, $status);
            }
        }

        return redirect()->route('dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request, ApplicationMails $applicationMails)
    {
        $attributes = $request->validate([
            'datefrom' => 'required|date',
            'dateto' => 'required|date|after_or_equal:datefrom',
            'reason' => 'min:5'
        ]);
        $attributes['user_id'] = auth()->user()->id;

        $dateFrom = Carbon::create($attributes['datefrom']);
        $dateTo = Carbon::create($attributes['dateto']);
        $vacationDays = $dateFrom->diffInDaysFiltered(function(Carbon $date) {
            return !$date->isWeekend();
        }, $dateTo);
        $attributes['days'] = $vacationDays + 1;

        $application = Application::create($attributes);

        // Send Email
        if(env('MAIL_ENABLE')){
            $applicationMails->new($application);
        }

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Application  $application
     */
    public function show(Application $application)
    {
        return view('applications.show', [
            'application' => $application
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Application  $application
     */
    public function edit(Application $application)
    {
        return view('applications.edit', [
            'application' => $application
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateApplicationRequest  $request
     * @param  \App\Models\Application  $application
     */
    public function update(UpdateApplicationRequest $request, Application $application)
    {
        $application->update($request->all());

        return view('applications.edit', [
            'application' => $application
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Application  $application
     */
    public function destroy(Application $application)
    {
        $application->delete();

        return back();
    }
}
