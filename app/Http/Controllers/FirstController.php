<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;
use Illuminate\Support\Facades\Redirect;
use Unicodeveloper\Paystack\Paystack;

class FirstController extends Controller
{
    public $paystack;

    public function __construct()
    {
        $this->paystack = new Paystack();
    }

    //
    public function index() {
        return response()->json([
            'status'=>true
        ]);
    }

    public function redirectToGateway()
    {
        try{
            return $this->paystack->getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }        
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = $this->Paystack::getPaymentData();

        dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }

    public function create(Request $request){
        $this->validate($request, [
                "Surname" => 'required',
                "Firstname" => 'required',
                "PhoneNumber" => 'required',
                "Address" => 'required',
                "School" => 'required'
        ]);

        $people = new People;
        $people->Surname =$request->Surname;
        $people->Firstname =$request->Firstname;
        $people->PhoneNumber =$request->PhoneNumber;
        $people->Address =$request->Address;
        $people->School =$request->School;

        $people->save();

        return response()->json([
            'status' => true,
            'data' => $people
        ]);
    }

    public function people() {
        return response()->json([
            'status' => true,
            // 'data' => People::all() // getting only the people
            'data' => People::with('bank')->get() //getting with the foreign keys
        ]);
    }

    public function getSinglePeople($id) {
        $people = People::find($id);

        return response()->json([
            'status' => true,
            'data' => $people
        ]);
    }

    public function update($id, Request $request) {
        $people = People::find($id);

        $people->Surname =$request->Surname;
        $people->Firstname =$request->Firstname;
        $people->PhoneNumber =$request->PhoneNumber;
        $people->Address =$request->Address;
        $people->School =$request->School;

        $people->save();

        return response()->json([
            'status' => true,
            'success' => 'Update successful',
            'data' => $people
        ]);

    }

    public function delete($id) {
        People::findorfail($id)->delete();

        return response()->json([
            'status' => true,
            'success' => 'Data deleted successfully'
        ], 200);
    }
}
