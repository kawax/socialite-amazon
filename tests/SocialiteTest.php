<?php

namespace Tests;

use Mockery as m;
use PHPUnit\Framework\TestCase;

use Illuminate\Http\Request;
use Laravel\Socialite\SocialiteManager;

use Revolution\Socialite\Amazon\AmazonProvider;

class SocialiteTest extends TestCase
{
    /**
     * @var SocialiteManager
     */
    protected $socialite;

    public function setUp()
    {
        parent::setUp();

        $app = ['request' => Request::create('foo')];

        $this->socialite = new SocialiteManager($app);

        $this->socialite->extend('amazon', function ($app) {
            return $this->socialite->buildProvider(AmazonProvider::class, [
                'client_id'     => 'test',
                'client_secret' => 'test',
                'redirect'      => 'https://localhost',
            ]);
        });
    }

    public function tearDown()
    {
        m::close();
    }

    public function testInstance()
    {
        $provider = $this->socialite->driver('amazon');

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
