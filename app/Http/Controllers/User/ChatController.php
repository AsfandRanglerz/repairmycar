<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatFavorite;
use App\Models\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $chatview = null;
        $type = null;
        $vendors = ChatFavorite::with('vendor', 'customerchat')->where([['customer_id', Auth::id()], ['customer_status', 0]])->orWhere([['customer_chat', Auth::id()], ['vendor_status', 0]])->orderBy('vendor_online', 'DESC')->get();
        return view('user.chat.index', compact('vendors', 'chatview', 'type'));
    }

    //add in fevorit and go to chat page
    public function chat($id)
    {
        $date = strtotime(Carbon::now());
        if (ChatFavorite::where('customer_id', auth()->user()->id)->where('vendor_id', $id)->doesntExist()) {
            $data = new ChatFavorite();
            $data->customer_id = Auth::id();
            $data->vendor_id = $id;
            $data->vendor_online = $date;
            $data->save();
        }
        $chatted = ChatFavorite::where([['customer_id', Auth::id()], ['vendor_id', $id]])->first();
        $chatted->customer_status = 0;
        $chatted->vendor_online = $date;
        $chatted->save();

        $vendors = ChatFavorite::with('vendor', 'customerchat')->where([['customer_id', Auth::id()], ['customer_status', 0]])->orWhere([['customer_chat', Auth::id()], ['vendor_status', 0]])->orderBy('vendor_online', 'DESC')->get();
        $chatview = $id;
        $type = 'vendor';
        return view('user.chat.index', compact('vendors', 'chatview', 'type'));
    }

    // User to User add in fevorit and go to chat page
    public function customerChat($id)
    {
        $date = strtotime(Carbon::now());
        if (ChatFavorite::where([['customer_id', auth()->user()->id], ['customer_chat', $id]])->orWhere([['customer_chat', auth()->user()->id], ['customer_id', $id]])->doesntExist()) {
            $data = new ChatFavorite();
            $data->customer_id = Auth::id();
            $data->customer_chat = $id;
            $data->vendor_online = $date;
            $data->save();
        }
        $chatted = ChatFavorite::where([['customer_id', Auth::id()], ['customer_chat', $id]])->orWhere([['customer_chat', Auth::id()], ['customer_id', $id]])->first();
        $chatted->customer_status = 0;
        $chatted->vendor_online = $date;
        $chatted->save();

        $vendors = ChatFavorite::with('vendor', 'customerchat')->where([['customer_id', Auth::id()], ['customer_status', 0]])->orWhere([['customer_chat', Auth::id()], ['vendor_status', 0]])->orderBy('vendor_online', 'DESC')->get();
        $chatview = $id;
        $type = 'customer';

        return view('user.chat.index', compact('vendors', 'chatview', 'type'));
    }

    public function favorite(Request $request)
    {
        // return response()->json($request);

        $id = $request->id;
        $auth_id = Auth::id();
        $message = Chat::where([['vendor_sender_id', $request->id], ['customer_receiver_id', $auth_id], ['customer_deleted', '=', 0]])
            ->orWhere([['vendor_receiver_id', $request->id], ['customer_sender_id', $auth_id], ['customer_deleted', '=', 0]])->orderBy('created_at')->get();

        $unread = Chat::where([['vendor_sender_id', $request->id], ['customer_receiver_id', $auth_id]])->get();
        foreach ($unread as $data) {
            $data->seen = 1;
            $data->save();
        }
        $chated_user = Vendor::find($id);
        $data = view('user.chat.chat')->with(['message' => $message, 'chated_user' => $chated_user, 'type' => 'vendor'])->render();
        $vendors = ChatFavorite::with('vendor')->where([['customer_id', Auth::id()], ['customer_status', 0]])->orWhere([['customer_chat', Auth::id()], ['vendor_status', 0]])->orderBy('vendor_online', 'DESC')->get();
        $vendors = view('user.chat.chatteduser')->with(['vendors' => $vendors])->render();

        $total_unread = Chat::where([['customer_receiver_id', auth()->user()->id], ['seen', 0]])->count('seen');

        return response()->json([
            'success' => 'Status updated successfully',
            'message' => $data,
            'unread' => $total_unread,
            'vendors' => $vendors,
            'id' => $id,
            'type' => 'vendor',

        ]);

    }

    public function favoriteUser(Request $request)
    {
        // return response()->json($request);

        $id = $request->id;
        $auth_id = Auth::id();

        $customer = ChatFavorite::where([['customer_id', Auth::id()], ['customer_chat', $id]])->orWhere([['customer_chat', Auth::id()], ['customer_id', $id]])->first();
        if ($customer->customer_id == Auth::id()) {
            $message = Chat::where([['customer_sender_id', $request->id], ['customer_receiver_id', $auth_id], ['customer_deleted', '=', 0]])
                ->orWhere([['customer_receiver_id', $request->id], ['customer_sender_id', $auth_id], ['customer_deleted', '=', 0]])->orderBy('created_at')->get();
        } else {
            $message = Chat::where([['customer_sender_id', $request->id], ['customer_receiver_id', $auth_id], ['vendor_deleted', '=', 0]])
                ->orWhere([['customer_receiver_id', $request->id], ['customer_sender_id', $auth_id], ['vendor_deleted', '=', 0]])->orderBy('created_at')->get();
        }

        $unread = Chat::where([['customer_sender_id', $request->id], ['customer_receiver_id', $auth_id]])->get();
        foreach ($unread as $data) {
            $data->seen = 1;
            $data->save();
        }
        $chated_user = User::find($id);
        $data = view('user.chat.chat')->with(['message' => $message, 'chated_user' => $chated_user, 'type' => 'customer'])->render();
        $vendors = ChatFavorite::with('vendor')->where([['customer_id', Auth::id()], ['customer_status', 0]])->orWhere([['customer_chat', Auth::id()], ['vendor_status', 0]])->orderBy('vendor_online', 'DESC')->get();
        $vendors = view('user.chat.chatteduser')->with(['vendors' => $vendors])->render();

        $total_unread = Chat::where([['customer_receiver_id', auth()->user()->id], ['seen', 0]])->count('seen');

        return response()->json([
            'success' => 'Status updated successfully',
            'message' => $data,
            'unread' => $total_unread,
            'vendors' => $vendors,
            'id' => $id,
            'type' => 'customer',

        ]);

    }

    public function store(Request $request)
    {
        // return response()->json($request);
        $auth_id = Auth::id();
        $id = $request->receiver_id;
        if ($request->type == 'vendor') {

            $auth_id = Auth::id();
            $chat = new Chat();
            $chat->type = "customer";
            $chat->customer_sender_id = $auth_id;
            $chat->vendor_receiver_id = $id;

            if ($request->file('attachment')) {
                $doucments = hexdec(uniqid()) . '.' . strtolower($request->file('attachment')->getClientOriginalExtension());
                $request->file('attachment')->move('public/chat/', $doucments);
                $file = 'public/chat/' . $doucments;
                $chat->attachment = $file;
                $chat->filetext = $request->body;
                $chat->msgtype = 'file';
            } else {
                $chat->body = $request->body;
                $chat->msgtype = 'text';
            }
            $chat->save();

            $date = strtotime(Carbon::now());
            $chatted = ChatFavorite::where([['customer_id', $auth_id], ['vendor_id', $id]])->first();
            $chatted->customer_online = $date;
            $chatted->vendor_online = $date;
            $chatted->customer_status = 0;
            $chatted->vendor_status = 0;
            $chatted->save();

            $message = Chat::where([['vendor_sender_id', $id], ['customer_receiver_id', $auth_id], ['customer_deleted', '=', 0]])
                ->orWhere([['vendor_receiver_id', $id], ['customer_sender_id', $auth_id], ['customer_deleted', '=', 0]])->orderBy('created_at')->get();

            $unread = Chat::where([['vendor_sender_id', $id], ['customer_receiver_id', $auth_id]])->get();
            foreach ($unread as $data) {
                $data->seen = 1;
                $data->save();
            }

            $chated_user = Vendor::find($id);
            $data = view('user.chat.chat')->with(['message' => $message, 'chated_user' => $chated_user, 'type' => 'vendor'])->render();
        } else {
            $auth_id = Auth::id();
            $chat = new Chat();
            $chat->type = "customer";
            $chat->customer_sender_id = $auth_id;
            $chat->customer_receiver_id = $id;

            if ($request->file('attachment')) {
                $doucments = hexdec(uniqid()) . '.' . strtolower($request->file('attachment')->getClientOriginalExtension());
                $request->file('attachment')->move('public/chat/', $doucments);
                $file = 'public/chat/' . $doucments;
                $chat->attachment = $file;
                $chat->filetext = $request->body;
                $chat->msgtype = 'file';
            } else {
                $chat->body = $request->body;
                $chat->msgtype = 'text';
            }
            $chat->save();

            $date = strtotime(Carbon::now());
            $chatted = ChatFavorite::where([['customer_id', $auth_id], ['customer_chat', $id]])->orWhere([['customer_id', $id], ['customer_chat', $auth_id]])->first();
            $chatted->customer_online = $date;
            $chatted->vendor_online = $date;
            $chatted->customer_status = 0;
            $chatted->vendor_status = 0;
            $chatted->save();

            if ($chatted->customer_id == Auth::id()) {
                $message = Chat::where([['customer_sender_id', $id], ['customer_receiver_id', $auth_id], ['customer_deleted', '=', 0]])
                    ->orWhere([['customer_receiver_id', $id], ['customer_sender_id', $auth_id], ['customer_deleted', '=', 0]])->orderBy('created_at')->get();
            } else {
                $message = Chat::where([['customer_sender_id', $id], ['customer_receiver_id', $auth_id], ['vendor_deleted', '=', 0]])
                    ->orWhere([['customer_receiver_id', $id], ['customer_sender_id', $auth_id], ['vendor_deleted', '=', 0]])->orderBy('created_at')->get();
            }

            $unread = Chat::where([['customer_sender_id', $id], ['customer_receiver_id', $auth_id]])->get();
            foreach ($unread as $data) {
                $data->seen = 1;
                $data->save();
            }

            $chated_user = User::find($id);
            $data = view('user.chat.chat')->with(['message' => $message, 'chated_user' => $chated_user, 'type' => 'cusotmer'])->render();
        }
        return response()->json([
            'success' => 'Status updated successfully',
            'message' => $data,
            'id' => $request->id,

        ]);

    }

    public function delete(Request $request)
    {

        $auth_id = Auth::id();
        $id = $request->id;
        $msg_id = $request->msg_id;
        if ($request->userType == 'vendor') {

            $message = Chat::find($msg_id);
            if ($message->vendor_deleted == 1) {
                $message->delete();
            } else {
                $message->customer_deleted = 1;
                $message->save();
            }
        } else {
            $customer = ChatFavorite::where([['customer_id', Auth::id()], ['customer_chat', $id]])->orWhere([['customer_chat', Auth::id()], ['customer_id', $id]])->first();
            if ($customer->customer_id == Auth::id()) {

                $message = Chat::find($msg_id);
                if ($message->vendor_deleted == 1) {
                    $message->delete();
                } else {
                    $message->customer_deleted = 1;
                    $message->save();
                }
            } else {
                $message = Chat::find($msg_id);
                if ($message->customer_deleted == 1) {
                    $message->delete();
                } else {
                    $message->vendor_deleted = 1;
                    $message->save();
                }
            }
        }
        return response()->json([
            'success' => 'Status updated successfully',

        ]);
    }

    public function alldelete(Request $request)
    {
        $id = $request->id;
        $auth_id = Auth::id();
        if ($request->userType == 'vendor') {

            $message = Chat::where([['vendor_sender_id', $request->id], ['customer_receiver_id', $auth_id], ['customer_deleted', '=', 0]])
                ->orWhere([['vendor_receiver_id', $request->id], ['customer_sender_id', $auth_id], ['customer_deleted', '=', 0]])->get();

            foreach ($message as $data) {
                if ($data->vendor_deleted == 1) {
                    $data->delete();
                } else {
                    $data->customer_deleted = 1;
                    $data->save();
                }
            }

            $message = [];
            $chated_user = Vendor::find($id);
            $data = view('user.chat.chat')->with(['message' => $message, 'chated_user' => $chated_user, 'id' => $id, 'type' => 'vendor'])->render();

        } else {
            $customer = ChatFavorite::where([['customer_id', Auth::id()], ['customer_chat', $id]])->orWhere([['customer_chat', Auth::id()], ['customer_id', $id]])->first();
            if ($customer->customer_id == Auth::id()) {

                $message = Chat::where([['customer_sender_id', $request->id], ['customer_receiver_id', $auth_id], ['customer_deleted', '=', 0]])
                    ->orWhere([['customer_receiver_id', $request->id], ['customer_sender_id', $auth_id], ['customer_deleted', '=', 0]])->get();
                foreach ($message as $data) {
                    if ($data->vendor_deleted == 1) {
                        $data->delete();
                    } else {
                        $data->customer_deleted = 1;
                        $data->save();
                    }
                }

            } else {
                $message = Chat::where([['customer_sender_id', $request->id], ['customer_receiver_id', $auth_id], ['vendor_deleted', '=', 0]])
                    ->orWhere([['customer_receiver_id', $request->id], ['customer_sender_id', $auth_id], ['vendor_deleted', '=', 0]])->get();
                foreach ($message as $data) {
                    if ($data->customer_deleted == 1) {
                        $data->delete();
                    } else {
                        $data->vendor_deleted = 1;
                        $data->save();
                    }
                }
            }

            $message = [];
            $chated_user = User::find($id);
            $data = view('user.chat.chat')->with(['message' => $message, 'chated_user' => $chated_user, 'id' => $id, 'type' => 'customer'])->render();

        }

        return response()->json([
            'success' => 'Status updated successfully',
            'message' => $data,
        ]);
    }

    public function chattedDelete(Request $request)
    {
        // return response()->json($request);
        $auth_id = Auth::id();
        if ($request->userType == 'vendor') {
            $vendor = ChatFavorite::where([['customer_id', $auth_id], ['vendor_id', $request->id]])->first();
            if ($vendor->vendor_status == 1) {
                $vendor->delete();
            } else {
                $vendor->customer_status = 1;
                $vendor->save();
            }

        } else {
            $customer = ChatFavorite::where([['customer_id', Auth::id()], ['customer_chat', $request->id]])->orWhere([['customer_chat', Auth::id()], ['customer_id', $request->id]])->first();
            if ($customer->customer_id == Auth::id()) {

                if ($customer->vendor_status == 1) {
                    $customer->delete();
                } else {
                    $customer->customer_status = 1;
                    $customer->save();
                }
            } else {
                if ($customer->customer_status == 1) {
                    $customer->delete();
                } else {
                    $customer->vendor_status = 1;
                    $customer->save();
                }
            }

        }
        $vendors = ChatFavorite::with('vendor')->where([['customer_id', Auth::id()], ['customer_status', 0]])->orWhere([['customer_chat', Auth::id()], ['vendor_status', 0]])->orderBy('vendor_online', 'DESC')->get();
        $data = view('user.chat.chatteduser')->with(['vendors' => $vendors])->render();

        return response()->json([
            'success' => 'Status updated successfully',
            'message' => $data,

        ]);
    }
    public function status(Request $request)
    {
        // return response()->json($request);
        $auth_id = Auth::id();
        $id = $request->id;

        $user = User::where('id', $auth_id)->first();
        $user->online_status = Carbon::now();
        $user->save();

        if ($request->userType == 'vendor') {

            $message = Chat::where([['vendor_sender_id', $id], ['customer_receiver_id', $auth_id], ['customer_deleted', '=', 0], ['seen', 0]])->orderBy('created_at')->get();
            foreach ($message as $data) {
                $data->seen = 1;
                $data->save();
            }
            $msg_unread = Chat::where([['customer_receiver_id', auth()->user()->id], ['seen', 0]])->count('seen');

            $chated_user = Vendor::find($id);
            $data = view('user.chat.new')->with(['message' => $message, 'chated_user' => $chated_user])->render();
        } else {

            $message = Chat::where([['customer_sender_id', $id], ['customer_receiver_id', $auth_id], ['customer_deleted', '=', 0], ['seen', 0]])->orderBy('created_at')->get();
            foreach ($message as $data) {
                $data->seen = 1;
                $data->save();
            }
            $msg_unread = Chat::where([['customer_receiver_id', auth()->user()->id], ['seen', 0]])->count('seen');

            $chated_user = User::find($id);
            $data = view('user.chat.new')->with(['message' => $message, 'chated_user' => $chated_user])->render();
        }

        return response()->json([
            'success' => 'Status updated successfully',
            'msg' => $msg_unread,
            'message' => $data,
            'data' => $message,
        ]);

    }

    public function chatted(Request $request)
    {
        $vendors = ChatFavorite::with('vendor')->where([['customer_id', Auth::id()], ['customer_status', 0]])->orWhere([['customer_chat', Auth::id()], ['vendor_status', 0]])->orderBy('vendor_online', 'DESC')->get();
        $vendors = view('user.chat.chatteduser')->with(['vendors' => $vendors])->render();

        return response()->json([
            'success' => 'Status updated successfully',
            'vendors' => $vendors,
        ]);
    }

}
