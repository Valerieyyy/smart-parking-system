<?php

namespace App\Http\Controllers;


use App\categories;
use App\User;
use App\profInfo;
use App\userInfo;
use App\parkingSlot;
use App\parkingManagement;
use App\Attendance;
use App\paymentMethod;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class ParkingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function parkingSlot()

    {
        $data ['parking'] = parkingSlot::select('id', 'user_id', 'slot', 'active','availability')->get();
        $data['first_name'] = User::where('id',Auth::user()->id)->select('first_name')->value('first_name');
        $data['middle_name'] = User::where('id',Auth::user()->id)->select('middle_name')->value('middle_name');
        $data['last_name'] = User::where('id',Auth::user()->id)->select('last_name')->value('last_name');
        $data['prof_pic'] = profInfo::where('user_id',Auth::user()->id)->select('prof_pic')->value('prof_pic');
        return view('parking.parking-slot',$data);
    }

    public function parkingCreate(){
        $data ['Userhistory'] = userInfo::select('id', 'user_id','plate_number', 'vehicle')->get();
        $data['first_name'] = User::where('id',Auth::user()->id)->select('first_name')->value('first_name');
        $data['middle_name'] = User::where('id',Auth::user()->id)->select('middle_name')->value('middle_name');
        $data['last_name'] = User::where('id',Auth::user()->id)->select('last_name')->value('last_name');
        $data['prof_pic'] = profInfo::where('user_id',Auth::user()->id)->select('prof_pic')->value('prof_pic');
     
        
        return view('parking.parking-slot-create', $data);
        // return view('driver_info.create')->with('inventory',$inventory);
       }
       public function parkingStore(Request $request){
        $data = $request->except('_method','_token','submit');
     
        $data = array(
            'user_id' => Auth::user()->id,
            'slot' => $request->slot,
            'active' => $request->active,
            'availability' => 1,
        );
        $parking = parkingSlot::Create($data);
     
        if($parking){
     
         Session::flash('message', 'Update successfully!');
         Session::flash('alert-class', 'alert-success');
         return redirect()->route('parking-slot');
      }else{
         Session::flash('message', 'Data not updated!');
         Session::flash('alert-class', 'alert-danger');
      }
     }

     public function parkingEdit($id){
      
        $parking = parkingSlot::find($id);
      //   $data['slots'] = parkingSlot::get();
        $data ['id'] = parkingSlot::where('id',$id)->select('id')->value('id');
        $data ['slot'] = parkingSlot::where('id',$id)->select('slot')->value('slot');
        $data ['active'] = parkingSlot::where('id',$id)->select('active')->value('active');
        $data ['availability'] = parkingSlot::where('id',$id)->select('availability')->value('availability');
   
        $data['first_name'] = User::where('id',Auth::user()->id)->select('first_name')->value('first_name');
        $data['middle_name'] = User::where('id',Auth::user()->id)->select('middle_name')->value('middle_name');
        $data['last_name'] = User::where('id',Auth::user()->id)->select('last_name')->value('last_name');
        $data['prof_pic'] = profInfo::where('user_id',Auth::user()->id)->select('prof_pic')->value('prof_pic');
     
        return view('parking.parking-slot-edit', $data);
     }
     public function parkingUpdate(Request $request, $id)
{
    $data = array(  
      
       'user_id' => Auth::user()->id,
       'slot' => $request->slot,
       'active' => $request->active,
       'availability' => 1,
 
    );
    $parking = parkingSlot::find($id);
 
    if($parking->update($data)){
 
       Session::flash('message', 'Update successfully!');
       Session::flash('alert-class', 'alert-success');
       return redirect()->route('parking-slot');
    }else{
       Session::flash('message', 'Data not updated!');
       Session::flash('alert-class', 'alert-danger');
    }
 
    return Back()->withInput();
 }
 // Delete
 public function Parkingdestroy($id){
   parkingSlot::destroy($id);

   Session::flash('message', 'Delete successfully!');
   Session::flash('alert-class', 'alert-success');
   return redirect()->route('parking-slot');
}

// parking management //

public function parkingManagement(Request $request)

{
   $data ['parkings'] = parkingManagement::select('id', 'parking_code', 'time_in', 'time_out','vehicle_cat_id','rate_id','slot_id','total_time','total_amount','paid_status')->get();
    $data ['parking'] = parkingSlot::select('id', 'user_id', 'slot', 'active','availability')->get();
    $data['first_name'] = User::where('id',Auth::user()->id)->select('first_name')->value('first_name');
    $data['middle_name'] = User::where('id',Auth::user()->id)->select('middle_name')->value('middle_name');
    $data['last_name'] = User::where('id',Auth::user()->id)->select('last_name')->value('last_name');
    $data['prof_pic'] = profInfo::where('user_id',Auth::user()->id)->select('prof_pic')->value('prof_pic');

    $data ['check_time'] = DB::table('users')
     ->join('user_info_driver', 'users.id', '=', 'user_info_driver.user_id')
     ->join('parking', 'users.id', '=', 'parking.id')
     ->join('attendance', 'users.id', '=', 'attendance.user_id')
    ->get();

      //  dd($data ['check_time']).die;
    
    return view('parkingmanagement.parking-manag',$data);
}
public function parkingmanageCreate(){
   $data ['Userhistory'] = userInfo::select('id', 'user_id',  'plate_number', 'vehicle')->get();
   $data['first_name'] = User::where('id',Auth::user()->id)->select('first_name')->value('first_name');
   $data['middle_name'] = User::where('id',Auth::user()->id)->select('middle_name')->value('middle_name');
   $data['last_name'] = User::where('id',Auth::user()->id)->select('last_name')->value('last_name');
   $data['prof_pic'] = profInfo::where('user_id',Auth::user()->id)->select('prof_pic')->value('prof_pic');
   $data ['rate'] = paymentMethod::select('id', 'rate_name', 'type', 'rate','category','status')->get();
   $data ['parking'] = parkingSlot::select('id', 'user_id', 'slot', 'active','availability')->get();
   $data ['category'] = categories::select('id', 'user_id', 'name', 'active')->get();
//   dd($data ['parking']).die;
   return view('parkingmanagement.parking-manag-create', $data);
   // return view('driver_info.create')->with('inventory',$inventory);
  }
  public function parkingManageStore(Request $request){
   // dd($request->all()).die;
   $data = $request->except('_method','_token','submit');

   $parking_code = strtoupper('pupb-'.substr(md5(uniqid(mt_rand(), true)), 0, 6));

   $data = array(
       'user_id' => Auth::user()->id,
       'parking_code' =>$parking_code,
       'vehicle_cat_id' => $request->vehicle_cat_id,
       'rate_id' => $request->rate_id,
       'slot_id' => $request->slot_id,
       'time_in' => strtotime('now'),
       'paid_status' => 0
   );
   // dd($request->slot_id).die;
   $parking = parkingManagement::Create($data);

   $parking_data = parkingSlot::where('id', $request->slot_id)->value('availability');
   // dd($parking_data).die;
   if($parking_data == 1){

      $slot_data = array(
        			'availability' => 2
        		);
      
   $parking = parkingSlot::where('id', $request->slot_id)->update($slot_data);
   // $update_slot = $this->model_slots->updateSlotAvailability($slot_data, $this->input->post('parking_slot'));

    Session::flash('message', 'Update successfully!');
    Session::flash('alert-class', 'alert-success');
    return redirect()->route('parking-slot');
 }else{
   
    Session::flash('message', 'Parking Not Available!');
    Session::flash('alert-class', 'alert-danger');
    return redirect()->route('parking-slot');
 }

 
}
public function getAttendance(Request $request)
{
 

    $data['login'] = Attendance::where('user_id', Auth::user()->id)->whereDate('time_in', '=', date('Y-m-d'))->value('id');
    $data['logout'] = Attendance::where('time_in',date('Y-m-d'))->orderBy('time_out', 'desc')->limit(80)->get();
 $data ['Attendance'] = DB::table('users')
      ->join('attendance', 'users.id', '=', 'attendance.user_id')
      ->get();
    return view('attendance.time_in', $data);
}
public function saveAttendance(Request $request){
   // dd($request->all()).die;
   $rfid_number = $request->rfid_number;

   $check_rfid = DB::table('user_info_driver as uid')->where('rfid', $rfid_number)->exists();
   $slot_id = DB::table('parking')->where('availability', 1)->limit(1)->value('id');
   // dd($slot_id).die;
   // dd($check_rfid).die;
   if($check_rfid){
      $uid = DB::table('user_info_driver as uid')->where('rfid', $rfid_number)->value('user_id');
      $vehicle_id = DB::table('user_info_driver as uid')->where('rfid', $rfid_number)->value('uid.id');
      $today = date('Y-m-d');
      // dd(Auth::user()->id).die;
      $chk_time = Attendance::where(['user_id' => $uid, 'vehicle_id' => $vehicle_id])->where('created_at', 'LIKE', "%$today%")->value('id');
      // dd($chk_time).die;
   
      if($chk_time == NULL){
         $time_in = date('H:i:s');
         // dd($time_in).die;
         $data = array(
            'user_id' => $uid,
            'vehicle_id' => $vehicle_id,
            'time_in' => $time_in,
            'slot_id' => $slot_id
        );
   
        $login = Attendance::updateOrCreate(['user_id'=>$uid],$data);
        DB::table('parking')->where('id', $slot_id)->update(['availability' => 2]);
         Session::flash('message', 'Update successfully!');
         Session::flash('alert-class', 'alert-success');
         return redirect()->route('attendance');
      }else{
         Attendance::where('id', $chk_time)->update(['time_out' => date('H:i:s')]);
         $slot = Attendance::where('id', $chk_time)->value('slot_id');
         DB::table('parking')->where('id', $slot)->update(['availability' => 1]);


         Session::flash('message', 'Update successfully!');
         Session::flash('alert-class', 'alert-success');
         return redirect()->route('attendance');
      }
   }else{
      return redirect()->back() ->with('alert', 'Invalid RFID number!');

   }

}
// public function saveAttendance(Request $request)
//     {
      
//       $validator = Validator::make($request->all(), [
//          'email' => 'required|email|max:100',
//          'password' => 'required',
//      ])->validate();

//      if ($validator) {
//       // dd("TEST1").die;
//       $user_id = User::where('email', $request->email)->value('id');
//       $login = Attendance::where('user_id', $user_id)->whereDate('time_in', '=', date('Y-m-d'))->value('id');
//       $logout = Attendance::where('user_id', $user_id)->whereDate('time_out', '=', date('Y-m-d'))->value('id');
//       $time = date("H");

//       $time_in = date('Y-m-d H:i:s');
//       $data = array(
//          'user_id' => $user_id,
//          'time_in' => $time_in,
//      );

     

//      $login = Attendance::updateOrCreate(['user_id'=>Auth::user()->id],$data);

//      if($login){

//       Attendance::where('id', $login)->update(['time_out' => date('Y-m-d H:i:s')]);
   
//       Session::flash('message', 'Update successfully!');
//       Session::flash('alert-class', 'alert-success');
//       return redirect()->route('attendance');
//       }
//       else
//       {
//          // dd("TEST2").die;
         
         

//          $time_in = date('Y-m-d H:i:s');
//          $data = array(
//             'user_id' => $user_id,
//             'time_in' => $time_in,
//          );

//          if($login)
//          {
//             Attendance::where('id', $login)->update(['time_in' => date('Y-m-d H:i:s')]);
//          } else {
//             Attendance::insert($data);
//          }


//          Attendance::where('id', $login)->update(['time_in' => date('Y-m-d H:i:s')]);

//          Session::flash('message', 'Data not updated!');
//          Session::flash('alert-class', 'alert-danger');
//       }
//       }

//    }
}