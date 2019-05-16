<?php

namespace Tests\Unit;

use App\Http\Repositories\SubscriptionRepository;
use App\Mail\ConfirmSubscription;
use App\Subscription;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscriptionTest extends TestCase
{
    private $subscription;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subscription = new SubscriptionRepository(new Subscription());
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testCreateSubscription()
    {
        $subscription = $this->subscription->createSubscription(['email' => 'test@example.com']);

        $this->assertNotNull($subscription);
        $this->assertNull($subscription->confirmed);
        $this->assertEquals('test@example.com', $subscription->email);
    }

    public function testConfirmSubscription()
    {
        Subscription::create(['email' => 'test@example.com']);

        $subscription =$this->subscription->confirm('test@example.com');

        $this->assertEquals(true, $subscription->confirmed);
    }

    public function testDeleteSubscription()
    {
        $subscription = Subscription::create(['email' => 'test@example.com']);

        $this->subscription->deleteSubscription($subscription->id);

        $subscription = Subscription::find($subscription->id);

        $this->assertNull($subscription);
    }
}
