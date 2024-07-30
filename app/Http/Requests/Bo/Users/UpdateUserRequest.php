<?php

namespace App\Http\Requests\Bo\Users;

use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends StoreUserRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
     */
    public function authorize(): bool
    {
        return Gate::check('update', $this->route('user'));
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        /** @var \App\Models\User $userModel */
        $userModel = request()->route()->parameter('user');
        /** @var \App\Models\User $authUserModel */
        $authUserModel = auth('backend')->user();
        $this->merge([
            'published' => $authUserModel->getKey() !== $userModel->getKey() ?
                $this->boolean('published') :
                true
        ]);
        $this->mergePicture('picture');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        /** @var \App\Models\User $userModel */
        $userModel = request()->route()->parameter('user');
        $rules     = [
            'email'    => [
                'required',
                'string',
                'unique:users,email,' . $userModel->getKey(),
                'email:rfc,strict,dns,spoof,filter',
                'max:255'
            ],
            'password' => [
                'sometimes', 'nullable', 'required_with:password_confirmation', 'confirmed', 'max:255',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
        ];
        return \array_merge(parent::rules(), $rules);
    }
}
