<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Archive;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArchiveController extends Controller
{
    public function fileDownload(Request $request)
    {
        $id = explode('file',$request->msg_id);
        $messasge = Chat::with('vendor', 'customer')->find($id);
        $messasge[0]->vendor_file_status = '1';
        $messasge[0]->save();

        $archive = new Archive();
        $archive->vendor_id = Auth::id();
        if ($messasge[0]->vendor_sender_id == null) {
            $archive->sender_name = $messasge[0]->customer->name;
        } else {
            $archive->sender_name = $messasge[0]->vendor->name;
        }
        $archive->file = $messasge[0]->attachment;
        $archive->type = 'image';
        $archive->file_name = $request->file_name;
        $archive->save();
        return response()->json([
            'success' => 'Status updated successfully',
        ]);
    }

    public function index()
    {
        $attachment = Archive::where('vendor_id', Auth::id())->get();
        return view('vendor.archive.index', compact('attachment'));
    }

    public function fileDelete(Request $request)
    {
        $attachment = Archive::destroy($request->file_id);
        return response()->json([
            'success' => 'file deleted successfully',
        ]);
    }

    
}
