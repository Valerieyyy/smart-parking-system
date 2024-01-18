@extends('layouts.dashboard')
@section('content')
<h3>Edit User History</h3>

<div class="row">

   <div class="col-md-12 col-sm-12 col-xs-12">

     <!-- Alert message (start) -->
     @if(Session::has('message'))
     <div class="alert {{ Session::get('alert-class') }}">
        {{ Session::get('message') }}
     </div>
     @endif
     <!-- Alert message (end) -->

     <div class="actionbutton">

        <a class='btn btn-info float-right' href="{{route('user_history')}}">List</a>

     </div>

     <form action="{{route('user_history.update',[$id])}}" method="post" >
         @csrf

         <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="equipment">RFID: <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="rfid" class="form-control col-md-12 col-xs-12" name="rfid" placeholder="Enter Firstname" required type="text" value='{{$rfid}}'>

             @if ($errors->has('rfid'))
               <span class="errormsg">{{ $errors->first('rfid') }}</span>
             @endif
          </div>
        </div>
         
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="equipment">PlateNumber: <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="plate_number" class="form-control col-md-12 col-xs-12" name="plate_number" placeholder="Enter Firstname" required type="text" value='{{$plate_number}}'>

             @if ($errors->has('plate_number'))
               <span class="errormsg">{{ $errors->first('plate_number') }}</span>
             @endif
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="equipment">Vehicle: <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="vehicle" class="form-control col-md-12 col-xs-12" name="vehicle" placeholder="Enter Firstname" required type="text" value='{{$vehicle}}'>

             @if ($errors->has('vehicle'))
               <span class="errormsg">{{ $errors->first('vehicle') }}</span>
             @endif
          </div>
        </div>
        <div class="form-group">
           <div class="col-md-6">

              <input type="submit" name="submit" value='Submit' class='btn btn-success'>
   
           </div>
        </div>

        
     </form>

   </div>
</div>
@endsection