<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLeaveAPIRequest;
use App\Http\Requests\API\UpdateLeaveAPIRequest;
use App\Models\Leave;
use App\Repositories\LeaveRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\API\LeaveResource;
use App\Http\Resources\API\LeavesResource;
use App\Models\Admin;
use App\Models\Media;
use App\Models\Signatory;
use App\Models\User;

/**
 * Class LeaveAPIController
 */
class LeaveAPIController extends AppBaseController
{
    private LeaveRepository $leaveRepository;

    public function __construct(LeaveRepository $leaveRepo)
    {
        $this->leaveRepository = $leaveRepo;
    }

    /**
     * Display a listing of the Leaves.
     * GET|HEAD /leaves
     */
    public function index(Request $request): JsonResponse
    {
        $leaves = $this->leaveRepository->where('user_id', auth()->user()->id)->latest()->paginate(10);

        return $this->sendResponse(new LeavesResource($leaves), 'Leaves retrieved successfully');
    }

    /**
     * Store a newly created Leave in storage.
     * POST /leaves
     */
    public function store(CreateLeaveAPIRequest $request): JsonResponse
    {
        $user = User::find(auth()->user()->id);

        if($user->statut == 1) {
            $input = $request->all();

            $input['user_id'] = auth()->user()->id;
            $user = Admin::where('department_id', $input['department_id'])->first();
            $input['signatory_id'] = !empty($user) ? $user->id : 2;

            $leave = $this->leaveRepository->create($input);

            if(isset($_FILES['picture']['name']) && $_FILES['picture']['name'] != '') {
                $files = $request->file('picture');
                $destinationPath = public_path('conges/');
                $profileImage = date("YmdHis") . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
                Media::updateOrCreate([
                    'src' => "/conges/$profileImage",
                    'source' => 'leave',
                    'source_id' => $leave->id
                ]);
            }

            return $this->sendResponse(new LeaveResource($leave), 'Leave saved successfully');
        }
        else return $this->sendError('Votre compte est bloqué ! Veuillez contactez votre administrateur');

    }

    /**
     * Display the specified Leave.
     * GET|HEAD /leaves/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Leave $leave */
        $leave = $this->leaveRepository->find($id);

        if (empty($leave)) {
            return $this->sendError('Leave not found');
        }

        return $this->sendResponse($leave->toArray(), 'Leave retrieved successfully');
    }

    /**
     * Update the specified Leave in storage.
     * PUT/PATCH /leaves/{id}
     */
    public function update($id, UpdateLeaveAPIRequest $request): JsonResponse
    {
        $user = User::find(auth()->user()->id);

        if($user->statut == 1) {
            $input = $request->all();

            /** @var Leave $leave */
            $leave = $this->leaveRepository->find($id);

            if (empty($leave)) {
                return $this->sendError('Leave not found');
            }

            $input['user_id'] = auth()->user()->id;

            $leave = $this->leaveRepository->update($input, $id);

            if(isset($_FILES['picture']['name']) && $_FILES['picture']['name'] != '') {
                $files = $request->file('picture');
                $destinationPath = public_path('conges/');
                $profileImage = date("YmdHis") . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
                Media::updateOrCreate([
                    'src' => "/conges/$profileImage",
                    'source' => 'leave',
                    'source_id' => $leave->id
                ]);
            }

            return $this->sendResponse($leave->toArray(), 'Leave updated successfully');
        }
        else return $this->sendError('Votre compte est bloqué ! Veuillez contactez votre administrateur');

    }

    /**
     * Remove the specified Leave from storage.
     * DELETE /leaves/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Leave $leave */
        $leave = $this->leaveRepository->find($id);

        if (empty($leave)) {
            return $this->sendError('Leave not found');
        }

        $leave->delete();

        return $this->sendSuccess('Leave deleted successfully');
    }
}
