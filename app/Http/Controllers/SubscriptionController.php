<?php

namespace App\Http\Controllers;

use Validator;
use App\Http\Repositories\Contracts\SubscriptionContract;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    private $subscriptions;

    public function __construct(SubscriptionContract $subscriptions)
    {
        $this->subscriptions = $subscriptions;
    }


    /**
     * Fetch and return all confirmed subscriptions
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
       $subscriptions =  $this->subscriptions->all();

       return response()->json($subscriptions);
    }

    /**
     * Create a subscription
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = $this->validateRequest($request->all());

        if ($validator->fails()) {
            return response()->json($validator->errors()->all(), 400);
        }

        $subscription = $this->subscriptions->createSubscription($request->all());

        return response()->json($subscription, 201);
    }


    public function show($email)
    {
        $subscriber  = $this->subscriptions->findSubscriber($email);

        if ($subscriber) {
            return response()->json($subscriber, 200);
        }

        return response()->json(['error' => 'subscriber not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validateUpdateRequest($request->all());

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $subscription = $this->subscriptions->updateSubscription($id, $request->all());

        return response()->json($subscription);
    }

    public function confirm(Request $request)
    {
        $email = $request->get('email');

        $subscription = $this->subscriptions->confirm($email);

        if ($subscription) {
            return response()->json($subscription);
        }

        return response()->json(['error' => 'subscriber not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->subscriptions->deleteSubscription($id);

        return response()->noContent(204);
    }

    private function validateRequest(array $data)
    {
        $rules = [
            'email' => 'required|string|email|unique:subscriptions,email'
        ];

        return Validator::make($data, $rules);
    }

    private function validateUpdateRequest(array $data)
    {
        $rules = [
            'email' => 'required|string|email|exists:subscriptions,email',
            'confirmed' => 'required|bool'
        ];

        return Validator::make($data, $rules);
    }
}
