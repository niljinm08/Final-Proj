<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityStoreRequest;
use App\Http\Requests\ActivityUpdateRequest;
use App\Models\Activity;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $upcomingActivities = Activity::whereDate('event_date', '>=', now()->toDateString())
            ->orderBy('event_date')
            ->get();

        $pastActivities = Activity::whereDate('event_date', '<', now()->toDateString())
            ->orderByDesc('event_date')
            ->get();

        return view('admin.activities.index', [
            'upcomingActivities' => $upcomingActivities,
            'pastActivities' => $pastActivities,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.activities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActivityStoreRequest $request): RedirectResponse
    {
        Activity::create([
            ...$request->validated(),
            'created_by' => $request->user()->id,
        ]);

        return redirect()->route('admin.activities.index')->with('status', 'Activity created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity): View
    {
        return view('admin.activities.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ActivityUpdateRequest $request, Activity $activity): RedirectResponse
    {
        $activity->update($request->validated());

        return redirect()->route('admin.activities.index')->with('status', 'Activity updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity): RedirectResponse
    {
        $activity->delete();

        return back()->with('status', 'Activity deleted successfully.');
    }
}
