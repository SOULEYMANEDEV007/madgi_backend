<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSiteRequest;
use App\Http\Requests\UpdateSiteRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Site;
use App\Repositories\SiteRepository;
use Illuminate\Http\Request;
use Flash;

class SiteController extends AppBaseController
{
    /** @var SiteRepository $siteRepository*/
    private $siteRepository;

    public function __construct(SiteRepository $siteRepo)
    {
        $this->siteRepository = $siteRepo;
    }

    /**
     * Display a listing of the Site.
     */
    public function index(Request $request)
    {
        $sites = $this->siteRepository->latest()->paginate(10);

        return view('sites.index')
            ->with('sites', $sites);
    }

    /**
     * Show the form for creating a new Site.
     */
    public function create()
    {
        return view('sites.create');
    }

    /**
     * Store a newly created Site in storage.
     */
    public function store(CreateSiteRequest $request)
    {
        $input = $request->all();

        $site = $this->siteRepository->create($input);

        Flash::success('Site saved successfully.');

        return redirect(getGuardedRoute('sites.index'));
    }

    /**
     * Display the specified Site.
     */
    public function show($id)
    {
        $site = $this->siteRepository->find($id);

        if (empty($site)) {
            Flash::error('Site not found');

            return redirect(getGuardedRoute('sites.index'));
        }

        return view('sites.show')->with('site', $site);
    }

    /**
     * Show the form for editing the specified Site.
     */
    public function edit($id)
    {
        $site = $this->siteRepository->find($id);

        if (empty($site)) {
            Flash::error('Site not found');

            return redirect(getGuardedRoute('sites.index'));
        }

        return view('sites.edit')->with('site', $site);
    }

    /**
     * Update the specified Site in storage.
     */
    public function update($id, UpdateSiteRequest $request)
    {
        $site = $this->siteRepository->find($id);

        if (empty($site)) {
            Flash::error('Site not found');

            return redirect(getGuardedRoute('sites.index'));
        }

        $site = $this->siteRepository->update($request->all(), $id);

        Flash::success('Site updated successfully.');

        return redirect(getGuardedRoute('sites.index'));
    }

    /**
     * Remove the specified Site from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $site = $this->siteRepository->find($id);

        if (empty($site)) {
            Flash::error('Site not found');

            return redirect(getGuardedRoute('sites.index'));
        }

        $this->siteRepository->delete($id);

        Flash::success('Site deleted successfully.');

        return redirect(getGuardedRoute('sites.index'));
    }

    public function search(Request $request)
    {
        $sites = Site::where('name', 'like', '%'.$request->search.'%')
                ->latest()
                ->paginate($request->paginator)
                ->appends($request->all());

        return view('sites.index')
            ->with('sites', $sites);
    }
}
