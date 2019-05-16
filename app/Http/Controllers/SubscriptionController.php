<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmSubscription;
use App\Utils\TokenUtils;
use Illuminate\Support\Facades\Mail;
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

        $url = TokenUtils::makeUrl($request->get('email'));

        Mail::to($request->get('email'))->send(new ConfirmSubscription($url));

        return response()->json($subscription, 201);
    }


    /**
     * Confirm subscription
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirm(Request $request)
    {
        $token = $request->get('token');
        $email = $request->get('email');

        $email = TokenUtils::validateToken($token, $email);

        if ($email) {
            $subscription = $this->subscriptions->confirm($email);

            if ($subscription) {
                return response()->json($subscription);
            }

            return response()->json(['error' => 'subscriber not found'], 404);
        } else {
            return response()->json(['error' => 'Error confirming subscription'], 400);
        }

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
