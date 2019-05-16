<?php

namespace App\Http\Repositories;


use App\Http\Repositories\Contracts\SubscriptionContract;
use App\Subscription;

/**
 * @author Verem Dugeri <verem.dugeri@gmail.com>
 *
 * Class SubscriptionRepository
 *
 * @package App\Http\Repositories
 */
class SubscriptionRepository implements SubscriptionContract
{
    private $subscription;

    /**
     * @author Verem Dugeri <verem.dugeri@gmail.com>
     *
     * SubscriptionRepository constructor.
     *
     * @param Subscription $subscription
     */
    public function __construct(Subscription $subscription)
    {

    }

    /**
     * {@inheritdoc}
     *
     */
    public function createSubscription(array $data): Subscription
    {
        // TODO: Implement createSubscription() method.
    }

    /**
     * {@inheritdoc}
     *
     */
    public function updateSubscription(int $id, array $data): Subscription
    {
        // TODO: Implement updateSubscription() method.
    }

    /**
     * {@inheritdoc}
     *
     */
    public function findSubscriber(string $email)
    {
        // TODO: Implement findSubscriber() method.
    }

    /**
     * {@inheritdoc}
     *
     */
    public function deleteSubscription(int $id)
    {
        // TODO: Implement deleteSubscription() method.
    }
}
