<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    public function destroy(Attachment $attachment)
    {
        $attachment->delete();
        return back();
    }
}
