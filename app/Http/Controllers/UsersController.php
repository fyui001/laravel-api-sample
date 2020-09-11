<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Users\UserLoginRequest;
use App\Services\Interfaces\UserServiceInterface;

class UsersController
{

    protected $userService;

    public function __construct(UserServiceInterface $userService) {

        $this->userService = $userService;

    }

    public function show(): array {

        $user = $this->userService->getUser();

        if (!$user) {
            return [
                'status' => false,
                'msg' => 'unauthorized',
            ];
        }

        return [
            'status' => true,
            'data' => $user,
        ];

    }

    public function login(UserLoginRequest $request): array {

        $response = $this->userService->login($request);

        if (!$response) {
            return [
                'status' => false,
                'msg' => 'error'
            ];
        }

        return [
            'status' => true,
            'data' => $response,
        ];

    }

    public function logout(): array {

        if (!$this->userService->logout()) {
            return [
                'status' => false,
            ];
        }

        return [
            'status' => true,
        ];

    }
}
