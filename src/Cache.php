<?php
/*
 * Copyright (c) 2020 Roger Muñoz Bernaus
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace tesla_ce\client;

use tesla_ce\client\exceptions\CacheObjectNotValid;

class Cache
{
    private $cacheInstance = null;

    public function __construct($cache)
    {
        // check if get and set methods are available
        if (!method_exists($cache, 'set')) {
            throw new CacheObjectNotValid('Set method is not available');
        }

        if (!method_exists($cache, 'get')) {
            throw new CacheObjectNotValid('Get method is not available');
        }
        $this->cacheInstance = $cache;
    }

    public function get($key)
    {
        return $this->cacheInstance->get($key);
    }

    public function set($key, $value)
    {
        return $this->cacheInstance->set($key, $value);
    }
}
