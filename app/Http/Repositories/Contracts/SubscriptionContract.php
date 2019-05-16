<?php
/**
 * @author: Verem
 * Date: 16/05/2019
 * Time: 4:42 PM
 */

namespace App\Http\Repositories\Contracts;


use App\Subscription;
use Illuminate\Support\Collection;

/**
 * @author Verem Dugeri <verem.dugeri@gmail.com>
 *
 * Interface SubscriptionContract
 *
 * @package App\Http\Repositories\Contracts
 */
interface SubscriptionContract
{
    /**
     * Fetch and return all confirmed subscriptions;
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Creates a new subscriber record in the database
     *
     * @param array $data
     *
     * @return Subscription
     */
    public function createSubscription(array $data): Subscription;


    /**
     * Confirm a subscription matching the specified email
     *
     * @param string $email
     *
     * @return mixed
     */
    public function confirm(string $email);

    /**
     * Delete  a subscription record matching the specified id from the database.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function deleteSubscription(int $id);
}
