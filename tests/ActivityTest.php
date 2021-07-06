<?php
use PHPUnit\Framework\TestCase;
use tesla_ce\client\Client;
use tesla_ce\client\exceptions\ResponseError;

class ActivityTest extends TestCase
{
    /**
     * @covers \tesla_ce\client\Client::__construct
     */
    public function testClient()
    {
        $role_id = 'ROLE_ID';
        $secret_id = 'SECRET_ID';
        $base_url = 'http://localhost';
        $verify_ssl = false;
        $cache = null;
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
