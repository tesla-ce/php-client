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

use PHPUnit\Framework\TestCase;
use tesla_ce\client\Client;
use tesla_ce\client\exceptions\ResponseError;

class ActivityTest extends TestCase
{
    /**
     * @covers \tesla_ce\client\Client::__construct
     * @covers \tesla_ce\client\Connector::__construct
     * @covers \tesla_ce\client\Connector::getConfiguration
     * @covers \tesla_ce\client\Connector::getInternalConfiguration
     * @covers \tesla_ce\client\Connector::makeRequest
     */
    public function testClient()
    {
        $role_id = 'ROLE_ID';
        $secret_id = 'SECRET_ID';
        $base_url = 'http://localhost';
        $verify_ssl = false;
        $cache = null;
        $client = null;

        try {
            $client = new Client($role_id, $secret_id, $base_url, $verify_ssl, $cache);
        } catch(ResponseError $err) {}

        $this->assertEmpty($client);

        return $client;
    }

    /**
     * @depends testClient
     * @covers \tesla_ce\client\Client::__construct
     */
    public function testPush(Client $client=null)
    {
        $this->assertEmpty($client);
    }

}
