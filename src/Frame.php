<?php

declare(strict_types=1);

namespace Humans\InertiaFrames;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

class Frame implements Responsable
{
    public function __construct(private string $path, private array $properties = [])
    {
    }

    public function toResponse($request)
    {
        if ($request->hasHeader('X-Inertia-Frame')) {
            return response()->json([
                'path'       => $this->path,
                'properties' => $this->resolveProperties($request),
            ]);
        }

        return inertia($this->path, $this->properties)->toResponse($request);
    }

    private function resolveProperties(Request $request): array
    {
        return inertia($this->path, $this->properties)->resolvePropertyInstances(
            $this->properties,
            $request,
        );
    }
}
