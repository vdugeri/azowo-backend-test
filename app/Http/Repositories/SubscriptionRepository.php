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
        $this->subscription = $subscription;
    }

    /**
     * {@inheritdoc}
     *
     */
    public function createSubscription(array $data): Subscription
    {
        return $this->subscription->create($data);
    }

    /**
     * {@inheritdoc}
     *
     */
    public function updateSubscription(int $id, array $data)
    {
        $subscription = $this->subscription->find($id);

        if ($subscription) {
            $subscription->email = $data['email'];
            $subscription->confirmed = $data['confirmed'];

            $subscription->save();

            return $subscription;
        }

        return null;
    }

    /**
     * {@inheritdoc}
     *
     */
    public function findSubscriber(string $email)
    {
        return $this->subscription->where('email', $email)->get();
    }

    /**
     * {@inheritdoc}
     *
     */
    public function deleteSubscription(int $id)
    {
        $this->subscription->destroy($id);
    }
}
