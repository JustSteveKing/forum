<?php

declare(strict_types=1);

namespace App\Http\Requests\Web\Posts;

use Illuminate\Foundation\Http\FormRequest;

final class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => [
                'required',
                'string',
            ]
        ];
    }
}
