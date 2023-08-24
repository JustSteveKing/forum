<?php

declare(strict_types=1);

namespace App\Http\Controllers\Reports;

use App\Enums\Moderation\Reason;
use App\Http\Controllers\Concerns\HasInertiaResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Inertia\Response;

final class CreateController
{
    use HasInertiaResponse;

    public function __invoke(Request $request, string $ulid, string $type): Response
    {
        /**
         * @var Model|class-string $model
         */
        $model = Relation::getMorphedModel(
            alias: $type,
        );

        $instance = $model::query()->findOrFail(
            id: $ulid,
        );

        return $this->response->render(
            component: 'Reports/Create',
            props: [
                'instance' => $instance,
                'model' => $type,
                'identifier' => $ulid,
                'reasons' => Reason::cases(),
            ]
        );
    }
}
