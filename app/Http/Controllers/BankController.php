<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;
use App\Models\Bank;

class BankController extends Controller
{
    //
    public function createBank(Request $request){
        
        $people = People::find($request->people_id);

        if(!$people) return response()->json([
            'status'=>false,
            'message'=>'User not in the database'
        ], 404);

        $bank = new Bank;
        $bank->people_id =$request->people_id;
        $bank->bankName =$request->bankName;
        $bank->accountName =$request->accountName;
        $bank->accountNumber =$request->accountNumber;

        $bank->save();

        return response()->json([
            'status' => true,
            'data' => $bank
        ]);
    }

    public function getBank() {
        return response()->json([
            'status'=>true,
            'data'=>Bank::all()
        ]);
    }
}
