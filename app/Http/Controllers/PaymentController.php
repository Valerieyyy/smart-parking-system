<?php

namespace App\Http\Controllers;

use App\User;
use App\profInfo;
use App\userInfo;
use App\parkingSlot;
use App\paymentMethod;
use App\categories;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentIndex()
    {
        $data ['payment'] = paymentMethod::select('id', 'user_id', 'rate_name', 'type','rate', 'category','status')->get();
        $data['first_name'] = User::where('id',Auth::user()->id)->select('first_name')->value('first_name');
        $data['middle_name'] = User::where('id',Auth::user()->id)->select('middle_name')->value('middle_name');
        $data['last_name'] = User::where('id',Auth::user()->id)->select('last_name')->value('last_name');
        $data['prof_pic'] = profInfo::where('user_id',Auth::user()->id)->select('prof_pic')->value('prof_pic');
     
        return view('rates.payment', $data);
    }
    public function PaymentCreate(){
      
        $data['category'] = categories::orderBy('name', 'ASC')->get();

        $data ['Userhistory'] = userInfo::select('id', 'user_id', 'plate_number', 'vehicle')->get();
        $data['first_name'] = User::where('id',Auth::user()->id)->select('first_name')->value('first_name');
        $data['middle_name'] = User::where('id',Auth::user()->id)->select('middle_name')->value('middle_name');
        $data['last_name'] = User::where('id',Auth::user()->id)->select('last_name')->value('last_name');
        $data['prof_pic'] = profInfo::where('user_id',Auth::user()->id)->select('prof_pic')->value('prof_pic');
     
        
        return view('rates.payment-create', $data);
 
       }
       public function paymentStore(Request $request){
        $data = $request->except('_method','_token','submit');
     
        $data = array(
            'user_id' => Auth::user()->id,
            'rate_name' => $request->rate_name,
            'type' => $request->type,
            'rate' => $request->rate,
            'category' => $request->category,
            'status' => $request->status
            
            
        );
        $payment = paymentMethod::Create($data);
     
        if($payment){
     
         Session::flash('message', 'Update successfully!');
         Session::flash('alert-class', 'alert-success');
         return redirect()->route('payment');
      }else{
         Session::flash('message', 'Data not updated!');
         Session::flash('alert-class', 'alert-danger');
      }
     }

      public function paymentEdit($id){
      
        $payment = paymentMethod::find($id);
        $data['name'] = categories::orderBy('name', 'ASC')->get();
        $data ['id'] = paymentMethod::where('id',$id)->select('id')->value('id');
        $data ['rate_name'] = paymentMethod::where('id',$id)->select('rate_name')->value('rate_name');
        $data ['type'] = paymentMethod::where('id',$id)->select('type')->value('type');
        $data ['rate'] = paymentMethod::where('id',$id)->select('rate')->value('rate');
        $data ['category'] = paymentMethod::where('id',$id)->select('category')->value('category');
        $data ['status'] = paymentMethod::where('id',$id)->select('status')->value('status');
        $data ['availability'] = parkingSlot::where('id',$id)->select('availability')->value('availability');
   
        $data['first_name'] = User::where('id',Auth::user()->id)->select('first_name')->value('first_name');
        $data['middle_name'] = User::where('id',Auth::user()->id)->select('middle_name')->value('middle_name');
        $data['last_name'] = User::where('id',Auth::user()->id)->select('last_name')->value('last_name');
        $data['prof_pic'] = profInfo::where('user_id',Auth::user()->id)->select('prof_pic')->value('prof_pic');
        $data['category'] = categories::orderBy('name', 'ASC')->get();
      //   $category = categories::where('id', $request->category)->update(['active' => 2]);

        return view('rates.payment-edit', $data);
     }
     public function paymentUpdate(Request $request, $id)
{
    $data = array(  
      
        'user_id' => Auth::user()->id,
        'rate_name' => $request->rate_name,
        'type' => $request->type,
        'rate' => $request->rate,
        'category' => $request->category,
        'status' => $request->status
 
    );
    $payment = paymentMethod::find($id);
 
    if($payment->update($data)){
 
       Session::flash('message', 'Update successfully!');
       Session::flash('alert-class', 'alert-success');
       return redirect()->route('payment');
    }else{
       Session::flash('message', 'Data not updated!');
       Session::flash('alert-class', 'alert-danger');
    }
 
    return Back()->withInput();
 }
 // Delete
 public function paymentDestroy($id){
    paymentMethod::destroy($id);

   Session::flash('message', 'Delete successfully!');
   Session::flash('alert-class', 'alert-success');
   return redirect()->route('payment');
}




}
