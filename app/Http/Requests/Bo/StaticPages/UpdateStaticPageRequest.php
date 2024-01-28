<?php

namespace App\Http\Requests\Bo\StaticPages;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateStaticPageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
     */
    public function authorize(): bool
    {
        return Gate::check('update', $this->route('static_page'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'seo_title'       => 'required|min:45|max:70',
            'seo_description' => 'required|min:50|max:160',
            'title'           => 'required|min:3|max:255',
        ];
    }
}