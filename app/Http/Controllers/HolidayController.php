<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHolidayRequest;
use App\Http\Requests\UpdateHolidayRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\HolidayRepository;
use Illuminate\Http\Request;
use Flash;

class HolidayController extends AppBaseController
{
    /** @var HolidayRepository $holidayRepository*/
    private $holidayRepository;

    public function __construct(HolidayRepository $holidayRepo)
    {
        $this->holidayRepository = $holidayRepo;
    }

    /**
     * Display a listing of the Holiday.
     */
    public function index(Request $request)
    {
        $holidays = $this->holidayRepository->latest()->paginate(10);

        return view('holidays.index')
            ->with('holidays', $holidays);
    }

    /**
     * Show the form for creating a new Holiday.
     */
    public function create()
    {
        return view('holidays.create');
    }

    /**
     * Store a newly created Holiday in storage.
     */
    public function store(CreateHolidayRequest $request)
    {
        $input = $request->all();

        $holiday = $this->holidayRepository->create($input);

        Flash::success('Holiday saved successfully.');

        return redirect(getGuardedRoute('holidays.index'));
    }

    /**
     * Display the specified Holiday.
     */
    public function show($id)
    {
        $holiday = $this->holidayRepository->find($id);

        if (empty($holiday)) {
            Flash::error('Holiday not found');

            return redirect(getGuardedRoute('holidays.index'));
        }

        return view('holidays.show')->with('holiday', $holiday);
    }

    /**
     * Show the form for editing the specified Holiday.
     */
    public function edit($id)
    {
        $holiday = $this->holidayRepository->find($id);

        if (empty($holiday)) {
            Flash::error('Holiday not found');

            return redirect(getGuardedRoute('holidays.index'));
        }

        return view('holidays.edit')->with('holiday', $holiday);
    }

    /**
     * Update the specified Holiday in storage.
     */
    public function update($id, UpdateHolidayRequest $request)
    {
        $holiday = $this->holidayRepository->find($id);

        if (empty($holiday)) {
            Flash::error('Holiday not found');

            return redirect(getGuardedRoute('holidays.index'));
        }

        $holiday = $this->holidayRepository->update($request->all(), $id);

        Flash::success('Holiday updated successfully.');

        return redirect(getGuardedRoute('holidays.index'));
    }

    /**
     * Remove the specified Holiday from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $holiday = $this->holidayRepository->find($id);

        if (empty($holiday)) {
            Flash::error('Holiday not found');

            return redirect(getGuardedRoute('holidays.index'));
        }

        $this->holidayRepository->delete($id);

        Flash::success('Holiday deleted successfully.');

        return redirect(getGuardedRoute('holidays.index'));
    }
}
