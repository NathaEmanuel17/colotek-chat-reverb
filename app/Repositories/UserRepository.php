<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Container\Container as App;

class UserRepository extends BaseRepository
{
    public function __construct(App $app)
    {
        parent::__construct($app, new User());
    }

    public function getAllExceptCurrentUser($currentUserId)
    {
        return $this->model->where('id', '!=', $currentUserId)->get();
    }

    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

}
