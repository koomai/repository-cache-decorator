<?php

namespace App\Repositories\Cache;

use App\Contracts\CustomerRepositoryInterface;
use App\Customer;
use App\Repositories\CustomerRepository;
use Illuminate\Cache\Repository as Cache;
use Illuminate\Support\Collection;

class CacheCustomerRepository implements CustomerRepositoryInterface
{
    /*
     * @var CustomerRepository
     */
    private $customerRepository;
    /**
     * @var Cache
     */
    private $cache;

    public function __construct(CustomerRepository $customerRepository, Cache $cache)
    {
        $this->customerRepository = $customerRepository;
        $this->cache = $cache;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->cache->remember('customers.all', 60, function() {
            return $this->customerRepository->all();
        });
    }

    /**
     * @param int $id
     *
     * @return Customer
     */
    public function find(int $id): Customer
    {
        return $this->cache->remember("customers.id.{$id}", 60, function() use ($id) {
            return $this->customerRepository->find($id);
        });
    }

    /**
     * @param string $email
     *
     * @return Customer
     */
    public function findByEmail(string $email): Customer
    {
        return $this->cache->remember("customers.email.{$email}", 60, function() use ($email) {
            return $this->customerRepository->findByEmail($email);
        });
    }

    /**
     * @param array $data
     *
     * @return Customer
     */
    public function create(array $data): Customer
    {
        $customer = $this->customerRepository->create($data);
        $this->invalidateCache();

        return $customer;
    }

    /**
     * @param int $id
     * @param array $data
     *
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $this->customerRepository->update($id, $data);
        $this->invalidateCache($id);

        return true;
    }

    /**
     * @param int $id
     *
     * @return int
     */
    public function delete(int $id): int
    {
        $count = $this->customerRepository->delete($id);
        $this->invalidateCache($id);

        return $count;
    }

    /**
     * Removes relevant cached data
     *
     * @param int $id
     */
    private function invalidateCache(int $id = null): void
    {
        $this->cache->forget('customers.all');
        if($id) {
            $this->cache->forget("customers.id.{$id}");
        }
    }
}
