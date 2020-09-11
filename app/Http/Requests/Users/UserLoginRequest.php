<?php

declare(strict_types=1);

namespace App\Http\Requests\Users;

use App\Http\Requests\Request as AppRequest;

class UserLoginRequest extends AppRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required',
            'password' => 'required',
        ];
    }
}
