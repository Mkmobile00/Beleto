<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Enum\PushNotification\NotificationUserType;
use App\Enum\PushNotification\PushNotificationStatus;

class PushNotificationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>'required|string',
            'image'=>'nullable|string',
            'summary'=>'nullable|string',
            'description'=>"nullable|string",
            'status'=>["required",Rule::in(PushNotificationStatus::PUSHED,PushNotificationStatus::UNPUSHED,PushNotificationStatus::DRAFT)],
            'for'=>["required",Rule::in(NotificationUserType::ALL,NotificationUserType::SELECTED)],
            'url'=>"nullable|url",
            'selected_id'=>'nullable|exists:customers,id'
        ];
    }
}
