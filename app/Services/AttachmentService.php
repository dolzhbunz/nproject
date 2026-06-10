<?php

namespace App\Services;

use App\Models\Attachment;
use App\Models\Event;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AttachmentService
{
    public function uploadAttachments(Event $event, array $files, int $userId): array
    {
        $attachments = [];

        foreach ($files as $file) {
            $attachment = $this->uploadSingle($event, $file, $userId);
            $attachments[] = $attachment;
        }

        return $attachments;
    }

    public function uploadSingle(Event $event, UploadedFile $file, int $userId): Attachment
    {
        $originalName = $file->getClientOriginalName();
        $fileName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME))
            . '_' . time()
            . '.' . $file->getClientOriginalExtension();

        $path = $file->storeAs("events/{$event->id}/attachments", $fileName, 'public');

        return Attachment::create([
            'event_id' => $event->id,
            'user_id' => $userId,
            'file_name' => $originalName,
            'file_path' => $path,
            'file_type' => $file->getFileType(),
            'size' => $file->getSize(),
        ]);
    }

    public function deleteAttachment(Attachment $attachment): bool
    {
        Storage::disk('public')->delete($attachment->file_path);
        return $attachment->delete();
    }

    public function deleteAllEventAttachments(Event $event): void
    {
        foreach ($event->attachments as $attachment) {
            Storage::disk('public')->delete($attachment->file_path);
            $attachment->delete();
        }
    }
}
