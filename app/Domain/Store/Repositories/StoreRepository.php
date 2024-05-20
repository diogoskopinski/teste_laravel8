<?php

namespace App\Domain\Store\Repositories;

use App\Domain\Store\Models\Store;

class StoreRepository
{
    public function getAll()
    {
        return Store::all();
    }

    public function getById($id)
    {
        return Store::find($id);
    }

    public function create(array $data)
    {
        return Store::create($data);
    }

    public function update($id, array $data)
    {
        $store = Store::find($id);
        $store->update($data);
        return $store;
    }

    public function delete($id)
    {
        return Store::destroy($id);
    }
}
