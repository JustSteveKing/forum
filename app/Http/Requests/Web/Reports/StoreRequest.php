<?php

declare(strict_types=1);

namespace App\Http\Requests\Web\Reports;

use App\Enums\Moderation\Reason;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'reason' => [
                'required',
                Rule::enum(
                    type: Reason::class,
                ),
            ],
            'content' => [
                'required',
                'string',
            ],
            'reportable_id' => [
                'required',
                'string',
            ],
            'reportable_type' => [
                'required',
                'string',
            ],
            'anonymous' => [
                'nullable',
                'boolean',
            ],
        ];
    }
}
