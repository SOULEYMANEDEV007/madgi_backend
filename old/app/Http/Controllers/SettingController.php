<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Setting;
use App\Repositories\SettingRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;

class SettingController extends AppBaseController
{
    /** @var SettingRepository $settingRepository*/
    private $settingRepository;

    public function __construct(SettingRepository $settingRepo)
    {
        $this->settingRepository = $settingRepo;
    }

    /**
     * Display a listing of the Setting.
     */
    public function index(Request $request)
    {
        $settings = $this->settingRepository->latest()->paginate(10);

        return view('settings.index')
            ->with('settings', $settings);
    }

    /**
     * Show the form for creating a new Setting.
     */
    public function create()
    {
        return view('settings.create');
    }

    /**
     * Store a newly created Setting in storage.
     */
    public function store(CreateSettingRequest $request)
    {
        $input = $request->all();

        $input['name'] = 'Nombre de congé annuel ' . $input['year'];
        $input['slug'] = str_replace(' ', '_', strtolower($input['name']));

        $setting = Setting::updateOrCreate(['year' => $input['year']], $input);

        Flash::success('Setting saved successfully.');

        return redirect(getGuardedRoute('settings.index'));
    }

    /**
     * Display the specified Setting.
     */
    public function show($id)
    {
        $setting = $this->settingRepository->find($id);

        if (empty($setting)) {
            Flash::error('Setting not found');

            return redirect(getGuardedRoute('settings.index'));
        }

        return view('settings.show')->with('setting', $setting);
    }

    /**
     * Show the form for editing the specified Setting.
     */
    public function edit($id)
    {
        $setting = $this->settingRepository->find($id);

        if (empty($setting)) {
            Flash::error('Setting not found');

            return redirect(getGuardedRoute('settings.index'));
        }

        return view('settings.edit')->with('setting', $setting);
    }

    /**
     * Update the specified Setting in storage.
     */
    public function update($id, UpdateSettingRequest $request)
    {
        $setting = $this->settingRepository->find($id);

        if (empty($setting)) {
            Flash::error('Setting not found');

            return redirect(getGuardedRoute('settings.index'));
        }

        $input = $request->all();

        if(!empty($input['year'])) {
            $input['name'] = 'Nombre de congé annuel ' . $input['year'];
            $input['slug'] = str_replace(' ', '_', strtolower($input['name']));
        }

        $setting = $this->settingRepository->update($input, $id);

        Flash::success('Setting updated successfully.');

        return redirect(getGuardedRoute('settings.index'));
    }

    /**
     * Remove the specified Setting from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $setting = $this->settingRepository->find($id);

        if (empty($setting)) {
            Flash::error('Setting not found');

            return redirect(getGuardedRoute('settings.index'));
        }

        $this->settingRepository->delete($id);

        Flash::success('Setting deleted successfully.');

        return redirect(getGuardedRoute('settings.index'));
    }
}
