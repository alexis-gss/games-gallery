<?php

namespace App\Http\Requests\Bo\Games;

use Illuminate\Support\Facades\Gate;

class UpdateGameRequest extends StoreGameRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
     */
    public function authorize(): bool
    {
        return Gate::check('update', $this->route('game'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'slug' => [
                'required',
                'string',
                'unique:games,slug,' . request()->game->getKey(),
                'max:255'
            ],
        ];
        return \array_merge(parent::rules(), $rules);
    }
}
