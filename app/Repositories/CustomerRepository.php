<?php

namespace App\Repositories;

use App\Contracts\CustomerRepositoryInterface;
use App\Customer;
use Illuminate\Support\Collection;

class CustomerRepository implements CustomerRepositoryInterface
{
    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Customer::all();
    }

    /**
     * @param int $id
     *
     * @return Customer
     */
    public function find(int $id): Customer
    {
        return Customer::find($id);
    }

    /**
     * @param string $email
     *
     * @return Customer
     */
    public function findByEmail(string $email): Customer
    {
        return Customer::where('email', $email)->first();
    }

    /**
     * @param array $data
     *
     * @return Customer
     */
    public function create(array $data): Customer
    {
        return Customer::create($data);
    }

    /**
     * @param int $id
     * @param array $data
     *
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return Customer::where('id', $id)->update($data);
    }

    /**
     * @param int $id
     *
     * @return int
     */
    public function delete(int $id): int
    {
        return Customer::destroy($id);
    }
}
