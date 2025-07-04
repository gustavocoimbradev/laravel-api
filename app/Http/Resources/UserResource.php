<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    protected function helperCensorEmail(string $email)
    {
        [$user, $domain] = explode('@', $email);
        $censoredUser = substr($user, 0, 1) . str_repeat('*', max(strlen($user) - 2, 1)) . substr($user, -1);
        return $censoredUser . '@' . $domain;
    }
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->helperCensorEmail($this->email),
        ];
    }
}
