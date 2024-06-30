<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Store a new user in the database
     *
     * @param array $dataStore
     * @return User
     */
    public function store(array $dataStore): User
    {
        $dataStore['password'] = Hash::make($dataStore['password']);

        return $this->userRepository->create($dataStore);
    }

    /**
     * Get the user by id
     *
     * @param int $id
     * @return array
     */
    public function show(int $id): array
    {
        try {
            $user = $this->userRepository->find($id);
            return [
                'status' => 200,
                'data' => ['user' => $user]
            ];
        } catch (ModelNotFoundException $e) {
            return [
                'status' => 404,
                'data' => ['message' => 'Usuário não encontrado.']
            ];
        } catch (Exception $e) {
            return [
                'status' => 500,
                'data' => ['message' => 'Erro ao buscar o usuário.', 'error' => $e->getMessage()]
            ];
        }
    }

    /**
     * Update the user by id
     *
     * @param int $id
     * @param array $dataUpdate
     * @return array
     */
    public function update(int $id, array $dataUpdate): array
    {
        try {
            if (isset($dataUpdate['password'])) {
                $dataUpdate['password'] = Hash::make($dataUpdate['password']);
            }

            $user = $this->userRepository->update($id, $dataUpdate);
            return [
                'status' => 200,
                'data' => ['message' => 'Usuário atualizado com sucesso!', 'user' => $user]
            ];
        } catch (ModelNotFoundException $e) {
            return [
                'status' => 404,
                'data' => ['message' => 'Usuário não encontrado.']
            ];
        } catch (Exception $e) {
            return [
                'status' => 500,
                'data' => ['message' => 'Erro ao atualizar o usuário.', 'error' => $e->getMessage()]
            ];
        }
    }

    /**
     * Delete the user by id
     *
     * @param int $id
     * @return array
     */
    public function destroy(int $id): array
    {
        try {
            $this->userRepository->delete($id);
            return [
                'status' => 200,
                'data' => ['message' => 'Usuário excluído com sucesso!']
            ];
        } catch (ModelNotFoundException $e) {
            return [
                'status' => 404,
                'data' => ['message' => 'Usuário não encontrado.']
            ];
        } catch (Exception $e) {
            return [
                'status' => 500,
                'data' => ['message' => 'Erro ao excluir o usuário.', 'error' => $e->getMessage()]
            ];
        }
    }

    public function getAllUsersExceptCurrent($currentUserId)
    {
        return $this->userRepository->getAllExceptCurrentUser($currentUserId);
    }

    public function getUserById($id)
    {
        return $this->userRepository->findById($id);
    }
}
