<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Application;
use App\Http\Requests\UpdateApplicationRequest;
use App\Services\ApplicationMails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        })->get();

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
            $application->status = Application::STATUS[$status];
            $application->save();

            // Send Email
            $applicationMails->statusUpdate($application, $status);
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

        // @TODO Needs a refactor so it will not count Weekend Days.

        $datediff = strtotime($attributes['dateto']) - strtotime($attributes['datefrom']);
        $attributes['days'] = $datediff / (60 * 60 * 24) + 1;

        $application = Application::create($attributes);

        // Send Email
        $applicationMails->new($application);

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
