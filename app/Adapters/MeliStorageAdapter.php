<?php

namespace App\Adapters;

use Dsc\MercadoLivre\Storage\StorageInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class MeliStorageAdapter implements StorageInterface
{
    public int $userID;

    /**
     * MeliStorageAdapter constructor.
     * @param int $userID
     */
    public function __construct(int $userID)
    {
        $this->userID = $userID;
    }

    public function set($name, $value): bool
    {
        return Cache::add($this->getStorageKey($name), $value);
    }

    public function has($name): bool
    {
        return Cache::has($this->getStorageKey($name));
    }

    public function get($name)
    {
        return Cache::get($this->getStorageKey($name));
    }

    public function remove($name): bool
    {
        return Cache::forget($this->getStorageKey($name));
    }

    private function getStorageKey($name): string
    {
        return $name . '_' . $this->userID;
    }
}
