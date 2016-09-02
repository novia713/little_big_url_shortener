<?php
// Tests/ProgrammerControllerTest.php

class ControllerTest extends \PHPUnit_Framework_TestCase
{
    /* CONFIG */
    private $domain = 'http://leash.dev/';
    private $existing_slug = '608f3c23e';
    private $existing_url = 'http://movistar.es';
    /* END CONFIG */

    //test redirection from short link to proper URL
    public function testGET_A()
    {
        $client = new GuzzleHttp\Client();

        $request = $client->get($this->domain.$this->existing_slug, null, null);

        $this->assertEquals(200, $request->getStatusCode());
    }

    //test short link stats
    public function testGET_B()
    {
        $client = new GuzzleHttp\Client();

        $request = $client->get($this->domain.'view/'.$this->existing_slug, null, null);

        $this->assertEquals(200, $request->getStatusCode());

        $data = json_decode($request->getBody(true), true);
        $this->assertEquals('ok', $data['status']);
    }

    //test short link creation
    public function testPOST_A()
    {
        $client = new GuzzleHttp\Client();

        $request = $client->post($this->domain.'create/'.$this->existing_url, null, null);

        $this->assertEquals(200, $request->getStatusCode());

        $data = json_decode($request->getBody(true), true);
        $this->assertEquals('ok', $data['status']);
    }
}
