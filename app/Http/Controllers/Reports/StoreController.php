<?php

declare(strict_types=1);

namespace App\Http\Controllers\Reports;

use App\Enums\Moderation\Outcome;
use App\Enums\Moderation\Reason;
use App\Enums\Moderation\Status;
use App\Http\Controllers\Discussions\IndexController;
use App\Http\Requests\Web\Reports\StoreRequest;
use App\Models\Report;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;

final readonly class StoreController
{
    public function __construct(
        private Authenticatable $auth,
    ) {}

    public function __invoke(StoreRequest $request): RedirectResponse
    {
        $report = Report::query()->create([
            'reason' => Reason::tryFrom(
                value: $request->string('reason')->toString(),
            ),
            'outcome' => Outcome::INVESTIGATION,
            'content' => $request->string('content')->toString(),
            'reportable_id' => $request->string('reportable_id')->toString(),
            'reportable_type' => $request->string('reportable_type')->toString(),
            'anonymous' => $request->boolean('anonymous'),
            'user_id' => $this->auth->getAuthIdentifier(),
        ]);

        $report->reportable()->update([
            'status' => Status::REPORTED,
        ]);

        return new RedirectResponse(
            url: \action(IndexController::class),
        );
    }
}
