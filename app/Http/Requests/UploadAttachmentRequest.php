<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadAttachmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'attachments' => 'required|array|max:5',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx,txt|max:5120' // 5MB
        ];
    }

    public function messages(): array
    {
        return [
            'attachments.*.file' => 'Поддерживаются только: jpg, png, pdf, doc, docx, txt',
            'attachments.*.max' => 'Размер файла не должен превышать 5MB',
            'attachments.max' => 'Максимум 5 файлов за раз'
        ];
    }
}
