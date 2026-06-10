<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadAttachmentRequest;
use App\Models\Event;
use App\Models\Attachment;
use App\Services\AttachmentService;
use Illuminate\Support\Facades\Auth;

class AttachmentController extends Controller
{
    protected AttachmentService $attachmentService;

    public function __construct(AttachmentService $attachmentService)
    {
        $this->attachmentService = $attachmentService;
        $this->authorizeResource(Attachment::class, 'attachment');
    }

    public function store(UploadAttachmentRequest $request, Event $event)
    {
        $this->authorize('update', $event);

        $attachments = $this->attachmentService->uploadAttachments(
            $event,
            $request->file('attachments'),
            Auth::id()
        );

        return redirect()->back()->with('success', 'Загружено ' . count($attachments) . ' файлов');
    }

    public function destroy(Attachment $attachment)
    {
        $this->authorize('delete', $attachment);

        $this->attachmentService->deleteAttachment($attachment);

        return redirect()->back()->with('success', 'Файл удален');
    }

    public function download(Attachment $attachment)
    {
        $this->authorize('view', $attachment);

        return Storage::disk('public')->download($attachment->file_path, $attachment->file_name);
    }
}
