<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class TodoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string) $this->id,
            'name' => $this->name,
            'title' => $this->title,
            'status' => $this->status,
            'completed_date' => $this->completed_date ? Carbon::parse($this->completed_date)->toIso8601String() : null,
            'initiated_date' => $this->initiated_date ? Carbon::parse($this->initiated_date)->toIso8601String() : null,
        ];
    }
}
