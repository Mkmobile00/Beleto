<?php

namespace App\Http\Requests;

use App\Enum\CurrencyTypeEnum;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SubscriptionUpdateRequest extends FormRequest
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
            'title'=>'required|unique:subscriptions,title,'.$this->subscription->id,
            'price'=>'required|numeric|min:0.01',
            'is_suggested'=>'nullable|in:0,1',
            'plan_id'=>'required|exists:plans,id',
            'period_id'=>'required|exists:periods,id',
            'status'=>'required|in:active,inactive',
            'currency_type'=>'required|exists:currencies,id'
        ];
    }
}
