<?php

namespace Tests;

use Mockery as m;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Revolution\Socialite\Amazon\AmazonProvider;

class SocialiteTest extends TestCase
{
    public function tearDown(): void
    {
        m::close();
    }

    public function testInstance()
    {
        $provider = Socialite::driver('amazon');

        $this->assertInstanceOf(AmazonProvider::class, $provider);
    }

    public function testRedirect()
    {
        $request = Request::create('foo');
        $request->setLaravelSession($session = m::mock('Illuminate\Contracts\Session\Session'));
        $session->shouldReceive('put')->once();

        $provider = new AmazonProvider($request, 'client_id', 'client_secret', 'redirect');
        $response = $provider->redirect();

        $this->assertStringStartsWith('https://www.amazon.com/ap/oa', $response->getTargetUrl());
    }
}
