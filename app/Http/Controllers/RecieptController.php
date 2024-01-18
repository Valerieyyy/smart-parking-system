<?php

namespace App\Http\Controllers;

use App\User;
use App\profInfo;
use App\userInfo;
use App\recieptSlip;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RecieptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Reciept()
    {
        $data ['receipt'] = recieptSlip::select('id', 'user_id', 'company_name', 'address','currency', 'message')->get();
        $data['company_name'] = recieptSlip::where('id',Auth::user()->id)->select('company_name')->value('company_name');
        $data['address'] = recieptSlip::where('id',Auth::user()->id)->select('address')->value('address');
        $data['currency'] = recieptSlip::where('id',Auth::user()->id)->select('currency')->value('currency');
        $data['message'] = recieptSlip::where('id',Auth::user()->id)->select('message')->value('message');
        $data['first_name'] = User::where('id',Auth::user()->id)->select('first_name')->value('first_name');
        $data['middle_name'] = User::where('id',Auth::user()->id)->select('middle_name')->value('middle_name');
        $data['last_name'] = User::where('id',Auth::user()->id)->select('last_name')->value('last_name');
        $data['prof_pic'] = profInfo::where('user_id',Auth::user()->id)->select('prof_pic')->value('prof_pic');
        
        return view('receipt.receipt',$data);
    }
    public function receiptStore(Request $request){
        $data = $request->except('_method','_token','submit');
     
        $data = array(
            'user_id' => Auth::user()->id,
            'company_name' => $request->company_name,
            'address' => $request->address,
            'currency' => $request->currency,
            'message' => $request->message,
        );
        $receipt = recieptSlip::updateOrCreate(['user_id'=>Auth::user()->id],$data);
     
        if($receipt){
     
         Session::flash('message', 'Update successfully!');
         Session::flash('alert-class', 'alert-success');
         return redirect()->route('receipt');
      }else{
         Session::flash('message', 'Data not updated!');
         Session::flash('alert-class', 'alert-danger');
      }
     }

}
