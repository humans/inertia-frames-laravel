<?php

declare(strict_types=1);

namespace Humans\InertiaFrames;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class InertiaFramesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Inertia::macro('shard', function (string $component, array $props = []) {
            return new Frame($component, $props);
        });

        Request::macro('wantsShard', function () {
            /** @var \Illuminate\Http\Request $this */
            return $this->hasHeader('X-Inertia-Shard');
        });
    }
}
