<?php

namespace App\Http\Repositories;


use App\Http\Repositories\Contracts\SubscriptionContract;
use App\Subscription;
use Illuminate\Support\Collection;

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
     */
    public function all(): Collection
    {
        return $this->subscription->confirmed()->get();
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
     */
    public function confirm(string $email)
    {
        $subscriber = $this->subscription->where('email', $email)->first();

        if ($subscriber) {
            $subscriber->confirmed = true;
            $subscriber->save();

            return $subscriber;
        }

        return null;
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
