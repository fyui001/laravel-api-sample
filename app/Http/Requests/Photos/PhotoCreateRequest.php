<?php

declare(strict_types=1);

namespace App\Http\Requests\Photos;

use App\Http\Requests\Request as AppRequest;

class PhotoCreateRequest extends AppRequest
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

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:20',
            'content' => 'required|string|max:300',
            'image' => 'required|mimes:png,jpeg,gif|max:50000',
        ];
    }
}
