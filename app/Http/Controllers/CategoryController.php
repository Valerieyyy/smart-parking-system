<?php

namespace App\Http\Controllers;

use App\User;
use App\profInfo;
use App\userInfo;
use App\categories;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categories()
    {
        $data ['category'] = categories::select('id', 'user_id', 'name', 'active')->get();
        $data['first_name'] = User::where('id',Auth::user()->id)->select('first_name')->value('first_name');
        $data['middle_name'] = User::where('id',Auth::user()->id)->select('middle_name')->value('middle_name');
        $data['last_name'] = User::where('id',Auth::user()->id)->select('last_name')->value('last_name');
        $data['prof_pic'] = profInfo::where('user_id',Auth::user()->id)->select('prof_pic')->value('prof_pic');
        return view('categories.category', $data);
    }

    public function createCategories()
    {
        $data['first_name'] = User::where('id',Auth::user()->id)->select('first_name')->value('first_name');
        $data['middle_name'] = User::where('id',Auth::user()->id)->select('middle_name')->value('middle_name');
        $data['last_name'] = User::where('id',Auth::user()->id)->select('last_name')->value('last_name');
        $data['prof_pic'] = profInfo::where('user_id',Auth::user()->id)->select('prof_pic')->value('prof_pic');
        return view('categories.category-create', $data);
    }
    public function categoriesStore(Request $request){
        $data = $request->except('_method','_token','submit');
     
        $data = array(
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'active' => $request->active,
        );
        $category = categories::Create($data);
     
     
        if($category){
     
         Session::flash('message', 'Update successfully!');
         Session::flash('alert-class', 'alert-success');
         return redirect()->route('category');
      }else{
         Session::flash('message', 'Data not updated!');
         Session::flash('alert-class', 'alert-danger');
      }
     }
     public function categoriesEdit($id){
      
        $category = categories::find($id);
        $data ['id'] = categories::where('id',$id)->select('id')->value('id');
        $data['name'] = categories::where('id',$id)->select('name')->value('name');
        $data['active'] = categories::where('id',$id)->select('active')->value('active');
        $data['first_name'] = User::where('id',Auth::user()->id)->select('first_name')->value('first_name');
        $data['middle_name'] = User::where('id',Auth::user()->id)->select('middle_name')->value('middle_name');
        $data['last_name'] = User::where('id',Auth::user()->id)->select('last_name')->value('last_name');
        $data['prof_pic'] = profInfo::where('user_id',Auth::user()->id)->select('prof_pic')->value('prof_pic');
     
        return view('categories.category-edit', $data);
     }
     public function categoriesUpdate(Request $request, $id)
     {
         $data = array(  
           
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'active' => $request->active,
      
         );
         $category = categories::find($id);
      
         if($category->update($data)){
      
            Session::flash('message', 'Update successfully!');
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('category');
         }else{
            Session::flash('message', 'Data not updated!');
            Session::flash('alert-class', 'alert-danger');
         }
      
         return Back()->withInput();
      }
      // Delete
      public function categoriesDestroy($id){
         categories::destroy($id);
     
        Session::flash('message', 'Delete successfully!');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('category');
     }
     
}
