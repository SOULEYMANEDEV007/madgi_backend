<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Activity;
use App\Repositories\ActivityRepository;
use Illuminate\Http\Request;
use Flash;

class ActivityController extends AppBaseController
{
    /** @var ActivityRepository $activityRepository*/
    private $activityRepository;

    public function __construct(ActivityRepository $activityRepo)
    {
        $this->activityRepository = $activityRepo;
    }

    /**
     * Display a listing of the Activity.
     */
    public function index(Request $request)
    {
        $activities = $this->activityRepository->latest()->paginate(10);

        return view('activities.index')
            ->with('activities', $activities);
    }

    /**
     * Show the form for creating a new Activity.
     */
    public function create()
    {
        return view('activities.create');
    }

    /**
     * Store a newly created Activity in storage.
     */
    public function store(CreateServiceRequest $request)
    {
        $input = $request->all();

        $activity = $this->activityRepository->create($input);

        Flash::success('Activity saved successfully.');

        return redirect(getGuardedRoute('activities.index'));
    }

    /**
     * Display the specified Activity.
     */
    public function show($id)
    {
        $activity = $this->activityRepository->find($id);

        if (empty($activity)) {
            Flash::error('Activity not found');

            return redirect(getGuardedRoute('activities.index'));
        }

        return view('activities.show')->with('service', $activity);
    }

    /**
     * Show the form for editing the specified Activity.
     */
    public function edit($id)
    {
        $activity = $this->activityRepository->find($id);

        if (empty($activity)) {
            Flash::error('Activity not found');

            return redirect(getGuardedRoute('activities.index'));
        }

        return view('activities.edit')->with('service', $activity);
    }

    /**
     * Update the specified Activity in storage.
     */
    public function update($id, UpdateServiceRequest $request)
    {
        $activity = $this->activityRepository->find($id);

        if (empty($activity)) {
            Flash::error('Activity not found');

            return redirect(getGuardedRoute('activities.index'));
        }

        $activity = $this->activityRepository->update($request->all(), $id);

        Flash::success('Activity updated successfully.');

        return redirect(getGuardedRoute('activities.index'));
    }

    /**
     * Remove the specified Activity from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $activity = $this->activityRepository->find($id);

        if (empty($activity)) {
            Flash::error('Activity not found');

            return redirect(getGuardedRoute('activities.index'));
        }

        $this->activityRepository->delete($id);

        Flash::success('Activity deleted successfully.');

        return redirect(getGuardedRoute('activities.index'));
    }

    public function search(Request $request)
    {
        $activities = Activity::where('name', 'like', '%'.$request->search.'%')
                ->latest()
                ->paginate($request->paginator)
                ->appends($request->all());

        return view('activities.index')
            ->with('activities', $activities);
    }
}
