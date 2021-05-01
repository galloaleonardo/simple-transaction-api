<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll(): array
    {
        return $this->userRepository->getAll();
    }

    public function getOne(int $id): array
    {
        return $this->userRepository->getOne($id);
    }

    public function save(array $data): array
    {
        $data['password'] = Hash::make($data['password']);

        return $this->userRepository->save($data);
    }

    public function update(array $data, int $id): array
    {
        $data['password'] = Hash::make($data['password']);

        return $this->userRepository->update($data, $id);
    }

    public function destroy(int $id): bool
    {
        return $this->userRepository->destroy($id);
    }
}
