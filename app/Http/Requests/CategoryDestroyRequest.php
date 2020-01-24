<?php

namespace App\Http\Requests;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class CategoryDestroyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !($this->route('category') == config('cms.default_category_id'));
    }

    // public function unauthorizedResponse(Exception $e)
    // {
    //     if($e instanceof AuthorizationException) {
    //         return redirect()->back()->with("message", "You cannot delete the default category");
    //     }
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
