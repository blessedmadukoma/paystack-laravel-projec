<?php

namespace App\Http\Controllers;

use App\Models\Second;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Unicodeveloper\Paystack\Paystack;

class SecondController extends Controller
{
    public $paystack;

    public function __construct()
    {
        $this->paystack = new Paystack();
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            "Surname" => 'required',
            "Firstname" => 'required',
            "PhoneNumber" => 'unique|required',
            "LastName" => 'required',
            "Status" => 'required',
            "RefID" => 'required',
            "email_address" => 'unique|email'
        ]);

        $users = new Second;
        $users->last_name = $request->last_name;
        $users->first_name = $request->first_name;
        $users->phone = $request->phone;
        $users->amount = "21500";
        $users->purpose = $request->purpose;
        $users->status = $request->Status;
        $users->channel = $request->channel;
        $users->refID = $request->refID;

        $users->save();

        return response()->json([
            'status' => true,
            'data' => $users
        ]);
    }

    public function pay()
    {
        paystack()->getPaymentData();
    }

    public function redirectToGateway()
    {
        try {
            return $this->paystack->getAuthorizationUrl()->redirectNow();
        } catch (\Exception $e) {
            return Redirect::back()->withMessage(['msg' => 'The paystack token has expired. Please refresh the page and try again.', 'type' => 'error']);
        }
    }


    public function handleGatewayCallback()
    {
        $paymentDetails = $this->Paystack::getPaymentData();

        dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}
