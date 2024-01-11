<?php

namespace App\Http\Requests\Bo\Ranks;

use App\Models\Rank;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreRankRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
     */
    public function authorize(): bool
    {
        return Gate::check('update', Rank::class);
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'ranks' => collect($this->ranks)->map(function ($rank) {
                return intval($rank['id']);
            })->toArray(),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'ranks'   => 'sometimes|array',
            'ranks.*' => 'required|numeric|exists:games,id|distinct',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'ranks'   => trans('rank of the game'),
            'ranks.*' => trans('id of the game'),
        ];
    }
}
