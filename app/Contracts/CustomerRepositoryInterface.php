<?php

namespace App\Contracts;

use App\Customer;
use Illuminate\Support\Collection;

interface CustomerRepositoryInterface
{
    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param int $id
     *
     * @return Customer
     */
    public function find(int $id): Customer;

    /**
     * @param string $email
     *
     * @return Customer
     */
    public function findByEmail(string $email): Customer;

    /**
     * @param array $data
     *
     * @return Customer
     */
    public function create(array $data): Customer;

    /**
     * @param int $id
     * @param array $data
     *
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * @param int $id
     *
     * @return int
     */
    public function delete(int $id): int;
}
