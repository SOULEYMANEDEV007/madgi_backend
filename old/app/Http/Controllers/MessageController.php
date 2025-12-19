<?php

namespace App\Http\Controllers;

use App\Models\MessageHistory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\WassengerService;
use Flash;

class MessageController extends Controller {
    protected $wassenger;

    public function __construct(WassengerService $wassenger) {
        $this->wassenger = $wassenger;
    }

    public function index(Request $request)
    {
        $users = User::whereStatut(1)->get();
        $messages = MessageHistory::paginate(10);
        $total = MessageHistory::count();
        $delivered = MessageHistory::where('status', 'delivered')->count();
        $inprogress = MessageHistory::where('status', 'sent')->count();
        $error = MessageHistory::where('status', 'failed')->count();
        return view('messages.index', compact('users', 'messages', 'total', 'delivered', 'inprogress', 'error'));
    }

    public function delivered(Request $request)
    {
        $users = User::whereStatut(1)->get();
        $messages = MessageHistory::where('status', 'delivered')->paginate(10);
        $total = MessageHistory::count();
        $delivered = MessageHistory::where('status', 'delivered')->count();
        $inprogress = MessageHistory::where('status', 'sent')->count();
        $error = MessageHistory::where('status', 'failed')->count();
        return view('messages.index', compact('users', 'messages', 'total', 'delivered', 'inprogress', 'error'));
    }

    public function sent(Request $request)
    {
        $users = User::whereStatut(1)->get();
        $messages = MessageHistory::where('status', 'sent')->paginate(10);
        $total = MessageHistory::count();
        $delivered = MessageHistory::where('status', 'delivered')->count();
        $inprogress = MessageHistory::where('status', 'sent')->count();
        $error = MessageHistory::where('status', 'failed')->count();
        return view('messages.index', compact('users', 'messages', 'total', 'delivered', 'inprogress', 'error'));
    }

    public function error(Request $request)
    {
        $users = User::whereStatut(1)->get();
        $messages = MessageHistory::where('status', 'failed')->paginate(10);
        $total = MessageHistory::count();
        $delivered = MessageHistory::where('status', 'delivered')->count();
        $inprogress = MessageHistory::where('status', 'sent')->count();
        $error = MessageHistory::where('status', 'failed')->count();
        return view('messages.index', compact('users', 'messages', 'total', 'delivered', 'inprogress', 'error'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone.*' => 'required|string',
            'message.*' => 'required|string',
        ]);

        $phoneNumbers = array_map('trim', explode(';', $request->phone));

        foreach ($phoneNumbers as $phone) {
            if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
                $files = $request->file('file');
                $destinationPath = public_path('messages/');
                $profileImage = date("YmdHis") . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
                $input['media'] = "/messages/$profileImage";
            }

            MessageHistory::create([
                'phone_number' => $phone,
                'message' => $request->message,
                'media' => $input['media'],
            ]);
        }

        Flash::success('Message in progress successfully.');

        return redirect(getGuardedRoute('messages.index'));
    }

    public function send()
    {
        $messages = MessageHistory::where('status', 'sent')->get();
        $this->wassenger->sendMessages($messages);
    }

    public function sendSingle($id)
    {
        $message = MessageHistory::find($id);
        $this->wassenger->sendMessage($message);

        Flash::success('Message in progress successfully.');

        return redirect(getGuardedRoute('messages.index'));
    }

    public function search(Request $request)
    {
        $input = $request->all();
        $input['paginator'] = $request->paginator ?? 10;

        if (!isset($input['search'])) $input['search'] = null;

        if (!isset($input['date'])) $input['date'] = null;

        $users = User::where('statut', 1)->get();

        $query = MessageHistory::query();

        if ($input['search']) {
            $query->where('phone_number', 'like', '%' . $input['search'] . '%')
                ->orWhere('message', 'like', '%' . $input['search'] . '%');
        }

        if ($input['date']) {
            $query->whereDate('created_at', $input['date']);
        }

        $messages = $query->paginate($input['paginator']);

        $total = MessageHistory::count();
        $delivered = MessageHistory::where('status', 'delivered')->count();
        $inprogress = MessageHistory::where('status', 'sent')->count();
        $error = MessageHistory::where('status', 'failed')->count();

        return view('messages.index', compact('users', 'messages', 'total', 'delivered', 'inprogress', 'error'));
    }
}
