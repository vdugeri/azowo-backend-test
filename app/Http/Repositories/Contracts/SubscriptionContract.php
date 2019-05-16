<?php
/**
 * @author: Verem
 * Date: 16/05/2019
 * Time: 4:42 PM
 */

namespace App\Http\Repositories\Contracts;


use App\Subscription;

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
     * Creates a new subscriber record in the database
     *
     * @param array $data
     *
     * @return Subscription
     */
    public function createSubscription(array $data): Subscription;

    /**
     * Updates a subscription matching the specified id
     *
     * @param int $id
     * @param array $data
     *
     * @return Subscription
     */
    public function updateSubscription(int $id, array $data): Subscription;

    /**
     * Finds  a subscriber with a matching email address
     *
     * @param string $email
     *
     * @return mixed
     */
    public function findSubscriber(string $email);

    /**
     * Delete  a subscription record matching the specified id from the database.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function deleteSubscription(int $id);
}
