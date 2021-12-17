<?php

namespace Imagache\Http\Requests;

use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Http\FormRequest;

class ShowImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Storage::exists('images/'.$this->image) ? true : abort(404);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'w' => 'bail|nullable|string|numeric|gt:0',
            'h' => 'bail|nullable|string|numeric|gt:0',
        ];
    }
}