<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface UserServiceInterface
{
    public function getUser(): array;
    public function login(Request $request): array;
    public function logout(): bool;
}
