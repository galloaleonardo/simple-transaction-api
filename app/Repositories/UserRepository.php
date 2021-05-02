<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getAll(): array
    {
        return $this->model->all()->toArray();
    }

    public function getOne(int $id): array
    {
        return $this->model->findOrFail($id)->toArray();
    }

    public function save(array $data): array
    {
        if ($user = $this->model->create($data)) {
            return $user->toArray();
        }

        return [];
    }

    public function update(array $data, int $id): array
    {
        $user = $this->model->findOrFail($id);

        if ($user->update($data)) {
            return $this->model->findOrFail($id)->toArray();
        }

        return [];
    }

    public function destroy(int $id): bool
    {
        $user = $this->model->findOrFail($id);

        return $user->delete();
    }
}
