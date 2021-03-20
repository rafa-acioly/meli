<?php

namespace App\Adapters;

use Dsc\MercadoLivre\Storage\StorageInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class MeliStorageAdapter implements StorageInterface
{
    public function set($name, $value): bool
    {
        return Redis::set($this->getStorageKey($name), $value);
    }

    public function has($name): bool
    {
        return Redis::get($this->getStorageKey($name));
    }

    public function get($name)
    {
        return Redis::get($this->getStorageKey($name));
    }

    public function remove($name): bool
    {
        return Redis::delete($this->getStorageKey($name));
    }

    private function getStorageKey($name): string
    {
        return $name . '_' . Auth::id();
    }
}
