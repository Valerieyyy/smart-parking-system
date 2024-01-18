<?php

namespace App\Http\Controllers;

use App\User;
use App\profInfo;
use App\userInfo;
use App\Attendance;
use App\parkingSlot;
use App\ParkingReserve;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\paymentMethod;
use App\categories;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['title'] = "Smart parking Dashboard";
        $data['first_name'] = User::where('id',Auth::user()->id)->select('first_name')->value('first_name');
        $data['middle_name'] = User::where('id',Auth::user()->id)->select('middle_name')->value('middle_name');
        $data['last_name'] = User::where('id',Auth::user()->id)->select('last_name')->value('last_name');
        $data['prof_pic'] = profInfo::where('user_id',Auth::user()->id)->select('prof_pic')->value('prof_pic');
        $data ['creds'] = User::select('id', 'first_name', 'middle_name', 'last_name','user_type','email' )->get();
        $data ['time_in'] = Attendance::select('time_in')->get();
        $data ['time_out']=Attendance::where('time_out')->count();
        $data ['full'] = parkingSlot::where('availability', 1)->count();
        $data ['empty'] = parkingSlot::where('availability', 2)->count();
        $data ['staff']=User::where('user_type', 4)->count();
        $data ['faculty']=User::where('user_type', 3)->count();
        $data ['countStaff']=User::where('user_type', 3 || 4)->count();
        $data ['countStudent']=User::where('user_type', 5 || 6)->count();
        $data ['guest']=User::where('user_type', 5)->count();
        $data ['student']=User::where('user_type', 6)->count();
        $data ['Attendance'] = DB::table('users')
        ->join('attendance', 'users.id', '=', 'attendance.user_id')
        ->get();
       
        return view('home', $data);
    }
    public function getProfile(){

        $data['first_name'] = User::where('id',Auth::user()->id)->select('first_name')->value('first_name');
        $data['middle_name'] = User::where('id',Auth::user()->id)->select('middle_name')->value('middle_name');
        $data['last_name'] = User::where('id',Auth::user()->id)->select('last_name')->value('last_name');
        $data['contact_num'] = profInfo::where('user_id',Auth::user()->id)->select('contact_num')->value('contact_num');
        $data['address'] = profInfo::where('user_id',Auth::user()->id)->select('address')->value('address');
        $data['birthday'] = profInfo::where('user_id',Auth::user()->id)->select('birthday')->value('birthday');
        $data['sex'] = profInfo::where('user_id',Auth::user()->id)->select('sex')->value('sex');
 
       $data['prof_pic'] = profInfo::where('user_id',Auth::user()->id)->select('prof_pic')->value('prof_pic');
       return view('user.edit_profile', $data); 
    }
    public function saveProfile(Request $request){

        if($request->hasFile('prof_pic')){
            $filenameWithExt = $request->file('prof_pic')->getClientOriginalName();
            $fileName = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('prof_pic')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
          $path = $request->file('prof_pic')->storeAs('public/prof_pic', $fileNameToStore);
              } else {
                $fileNameToStore= NULL;
            }
   
            //  dd($fileNameToStore);die;
   
         $data = array(
            'contact_num' => $request->contact_num,
            'address' => $request->address,
            'birthday' => $request->birthday,
            'sex' => $request->sex,
            'prof_pic' => $fileNameToStore,
           );
   
           $profile = profInfo::updateOrCreate(['user_id'=>Auth::user()->id],$data);
   
           if($profile){
     
            Session::flash('message', 'Update successfully!');
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('edit_profile');
         }else{
            Session::flash('message', 'Data not updated!');
            Session::flash('alert-class', 'alert-danger');
         }
        


    }
    public function adminAccount(Request $request){
        $data['first_name'] = User::where('id',Auth::user()->id)->select('first_name')->value('first_name');
        $data['middle_name'] = User::where('id',Auth::user()->id)->select('middle_name')->value('middle_name');
        $data['last_name'] = User::where('id',Auth::user()->id)->select('last_name')->value('last_name');
        $data['prof_pic'] = profInfo::where('user_id',Auth::user()->id)->select('prof_pic')->value('prof_pic');
        return view('admin_account', $data);
    }

    protected function AdminCreate(Request $request)
    {
        $generatedPassword = "password";

        $user = new User;
             $user->first_name = $request->first_name;
             $user->middle_name = $request->middle_name;
             $user->last_name = $request->last_name;
             $user->email = $request->email;
             $user->password = Hash::make($generatedPassword);
             $user->user_type = 2;
             if($user->save()){

                Session::flash('message', 'Update successfully!');
                Session::flash('alert-class', 'alert-success');
                return redirect()->route('admin_account');
             }else{
                Session::flash('message', 'Data not updated!');
                Session::flash('alert-class', 'alert-danger');
             }
    }
     public function userAccount(Request $request){
      $data['first_name'] = User::where('id',Auth::user()->id)->select('first_name')->value('first_name');
      $data['middle_name'] = User::where('id',Auth::user()->id)->select('middle_name')->value('middle_name');
      $data['last_name'] = User::where('id',Auth::user()->id)->select('last_name')->value('last_name');
      $data['prof_pic'] = profInfo::where('user_id',Auth::user()->id)->select('prof_pic')->value('prof_pic');
      return view('user_account', $data);
  }

  protected function UserCreate(Request $request)
    {
        $generatedPassword = "password";

        $data = array(
         'first_name' => $request->first_name,
         'middle_name' => $request->middle_name,
         'last_name' => $request->last_name,
         'user_type' => $request->user_type,
         'email' => $request->email,
         'password' => Hash::make($generatedPassword),
     );
     
         $userInfo = User::Create($data);
             
             if($userInfo){

                Session::flash('message', 'Update successfully!');
                Session::flash('alert-class', 'alert-success');
                return redirect()->route('user_account');
             }else{
                Session::flash('message', 'Data not updated!');
                Session::flash('alert-class', 'alert-danger');
             }
    }
    public function userHistory(){
      $data ['creds'] = User::select('id', 'first_name', 'middle_name', 'last_name','user_type','email' )->get();
            $data ['Userhistory'] = DB::table('user_info_driver')
            ->join('users', 'user_info_driver.user_id', '=', 'users.id') 
            ->get();

            // dd($data ['Userhistory']).die;
      //   $data ['Userhistory'] = userInfo::select('id', 'user_id','rfid','plate_number', 'vehicle')->get();
        $data['first_name'] = User::where('id',Auth::user()->id)->select('first_name')->value('first_name');
        $data['middle_name'] = User::where('id',Auth::user()->id)->select('middle_name')->value('middle_name');
        $data['last_name'] = User::where('id',Auth::user()->id)->select('last_name')->value('last_name');
        $data['prof_pic'] = profInfo::where('user_id',Auth::user()->id)->select('prof_pic')->value('prof_pic');
        
        return view('userhistory.user_history',$data);
    }
    public function USDcreate(){
        $data ['Userhistory'] = userInfo::select('id','rfid','plate_number', 'vehicle')->get();
        $data['first_name'] = User::where('id',Auth::user()->id)->select('first_name')->value('first_name');
        $data['middle_name'] = User::where('id',Auth::user()->id)->select('middle_name')->value('middle_name');
        $data['last_name'] = User::where('id',Auth::user()->id)->select('last_name')->value('last_name');
        $data['prof_pic'] = profInfo::where('user_id',Auth::user()->id)->select('prof_pic')->value('prof_pic');
        $data ['category'] = categories::select('id', 'user_id', 'name', 'active')->get();
        $data ['Name'] = User::get();

     
        
        return view('userhistory.user_history-create', $data);
        // return view('driver_info.create')->with('inventory',$inventory);
       }
       public function USDstore(Request $request){
        $data = $request->except('_method','_token','submit');
     
        $data = array(

            'user_id' => $request->user_id,
            'rfid' => $request->rfid,
            'plate_number' => $request->plate_number,
            'vehicle' => $request->vehicle,
        );
        $user_info = userInfo::Create($data);
     
        if($user_info){
     
         Session::flash('message', 'Update successfully!');
         Session::flash('alert-class', 'alert-success');
         return redirect()->route('user_history');
      }else{
         Session::flash('message', 'Data not updated!');
         Session::flash('alert-class', 'alert-danger');
      }
     }

     public function userhistoryEdit($id){
      
      $user_info = userInfo::find($id);
      $data ['Userhistory'] = userInfo::select('id','rfid','plate_number', 'vehicle')->get();
      $data ['plate_number'] = userInfo::where('id',$id)->select('plate_number')->value('plate_number');
      $data ['rfid'] = userInfo::where('id',$id)->select('rfid')->value('rfid');
      $data ['vehicle'] = userInfo::where('id',$id)->select('vehicle')->value('vehicle');
      $data ['id'] = userInfo::where('id',$id)->select('id')->value('id');

      $data['first_name'] = User::where('id',Auth::user()->id)->select('first_name')->value('first_name');
      $data['middle_name'] = User::where('id',Auth::user()->id)->select('middle_name')->value('middle_name');
      $data['last_name'] = User::where('id',Auth::user()->id)->select('last_name')->value('last_name');
      $data['prof_pic'] = profInfo::where('user_id',Auth::user()->id)->select('prof_pic')->value('prof_pic');
   
      return view('userhistory.user_history-edit', $data);
   }



     public function userInput($id){
      

        $user_info = userInfo::find($id);
        $data ['Userhistory'] = userInfo::select('id','rfid','plate_number', 'vehicle')->get();
        $data ['plate_number'] = userInfo::where('id',$id)->select('plate_number')->value('plate_number');
        $data ['rfid'] = userInfo::where('id',$id)->select('rfid')->value('rfid');
        $data ['vehicle'] = userInfo::where('id',$id)->select('vehicle')->value('vehicle');
        $data ['id'] = userInfo::where('id',$id)->select('id')->value('id');

        $data ['rfids'] = DB::table('user_info_driver')
         ->join('users', 'user_info_driver.user_id', '=', 'users.id')
         ->where('user_info_driver.user_id',$id)
         ->selectRaw('user_info_driver.id,user_info_driver.user_id, user_info_driver.rfid, user_info_driver.plate_number, user_info_driver.vehicle')
         ->get();
         //   dd($data['rfids']).die;

         $data['fname'] = User::where('id',$id)->select('first_name')->value('first_name');
         $data['mname'] = User::where('id',$id)->select('middle_name')->value('middle_name');
         $data['lname'] = User::where('id',$id)->select('last_name')->value('last_name');
        $data['first_name'] = User::where('id',Auth::user()->id)->select('first_name')->value('first_name');
        $data['middle_name'] = User::where('id',Auth::user()->id)->select('middle_name')->value('middle_name');
        $data['last_name'] = User::where('id',Auth::user()->id)->select('last_name')->value('last_name');
        $data['prof_pic'] = profInfo::where('user_id',Auth::user()->id)->select('prof_pic')->value('prof_pic');
        return view('userhistory.user-add', $data);
     }
     public function userReserve($id){
      
      // $user_info = userInfo::find($id);
      $data ['Userhistory'] = userInfo::select('id', 'user_id', 'rfid','plate_number', 'vehicle')->get();
      $data ['parkingReserve'] = ParkingReserve::select('id', 'user_id','parking_id')->get();
     //  dd( $data ['parkingReserve']).die;
     $data ['plate_number'] = userInfo::where('id',$id)->select('plate_number')->value('plate_number');
     $data ['vehicle'] = userInfo::where('id',$id)->select('vehicle')->value('vehicle');
     $data ['id'] = userInfo::where('id',$id)->select('id')->value('id');
     $data ['scan'] = DB::table('users')
     ->where('users.id',$id)
     ->join('user_info_driver', 'users.id', '=' ,'user_info_driver.user_id')
     ->join('parking', 'users.id', '=', 'parking.id')
     ->get();
            //  dd($data ['scan']).die;
      $data['first_name'] = User::where('id',Auth::user()->id)->select('first_name')->value('first_name');
      $data['middle_name'] = User::where('id',Auth::user()->id)->select('middle_name')->value('middle_name');
      $data['last_name'] = User::where('id',Auth::user()->id)->select('last_name')->value('last_name');
      $data['prof_pic'] = profInfo::where('user_id',Auth::user()->id)->select('prof_pic')->value('prof_pic');
   
      return view('userhistory.user-slot', $data);
   }
   
     

     public function userhistoryView($id){
      

       $data ['Userhistory'] = userInfo::select('id', 'user_id', 'rfid','plate_number', 'vehicle')->get();
      $data ['plate_number'] = userInfo::where('id',$id)->select('plate_number')->value('plate_number');
      $data ['vehicle'] = userInfo::where('id',$id)->select('vehicle')->value('vehicle');
      // $data ['id'] = userInfo::where('id',$id)->select('id')->value('id');
      $data ['scan'] = DB::table('user_info_driver')
       ->where('user_info_driver.user_id',$id)
      ->join('users', 'user_info_driver.user_id', '=', 'users.id')
      ->join('attendance', 'users.id', '=', 'attendance.user_id')
      ->get();

      // dd($data ['scan']).die;
      $data['first_name'] = User::where('id',Auth::user()->id)->select('first_name')->value('first_name');
      $data['middle_name'] = User::where('id',Auth::user()->id)->select('middle_name')->value('middle_name');
      $data['last_name'] = User::where('id',Auth::user()->id)->select('last_name')->value('last_name');
      $data['prof_pic'] = profInfo::where('user_id',Auth::user()->id)->select('prof_pic')->value('prof_pic');
      $data['fname'] = User::where('id',$id)->select('first_name')->value('first_name');
      $data['mname'] = User::where('id',$id)->select('middle_name')->value('middle_name');
      $data['lname'] = User::where('id',$id)->select('last_name')->value('last_name');
      
   
      return view('userhistory.user_history-view', $data);
   }
   
     
public function Userupdate(Request $request, $id)
{
    $data = array(
       'user_id' => Auth::user()->id,
             'rfid' => $request->rfid,
             'plate_number' => $request->plate_number,
             'vehicle' => $request->vehicle,
     
 
    );
    $user_info = userInfo::find($id);
 
    if($user_info->update($data)){
 
       Session::flash('message', 'Update successfully!');
       Session::flash('alert-class', 'alert-success');
       return redirect()->route('user_history');
    }else{
       Session::flash('message', 'Data not updated!');
       Session::flash('alert-class', 'alert-danger');
    }
 
    return Back()->withInput();
 }
 // Delete
public function Userdestroy($id){
   userInfo::destroy($id);

   Session::flash('message', 'Delete successfully!');
   Session::flash('alert-class', 'alert-success');
   return redirect()->route('user_history');
}

public function userIndex(){


   $data ['Userhistory'] = DB::table('users')

   ->join('user_info_driver', 'users.id', '=', 'user_info_driver.user_id') 
   ->get();




$data ['creds'] = User::select('id', 'first_name', 'middle_name', 'last_name','user_type','email' )->get();


// ($data ['creds']).die;
$data['first_name'] = User::where('id',Auth::user()->id)->select('first_name')->value('first_name');
$data['middle_name'] = User::where('id',Auth::user()->id)->select('middle_name')->value('middle_name');
$data['last_name'] = User::where('id',Auth::user()->id)->select('last_name')->value('last_name');
$data['prof_pic'] = profInfo::where('user_id',Auth::user()->id)->select('prof_pic')->value('prof_pic');

return view('user.user-reg',$data);
}



}