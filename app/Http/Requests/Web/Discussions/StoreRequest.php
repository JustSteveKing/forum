<?php

declare(strict_types=1);

namespace App\Http\Requests\Web\Discussions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'min:2',
                'max:255',
            ],
            'topic' => [
                'required',
                Rule::exists(
                    table: 'topics',
                    column: 'id',
                )
            ]
        ];
    }
}
