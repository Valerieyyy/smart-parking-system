@extends('layouts.dashboard')
@section('content')

<h3>Create Parking Slot</h3>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>

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

        <a class='btn btn-info float-right' href="{{route('parking-slot')}}">List</a>

     </div>

     <form action="{{route('parking.parkingStore')}}" method="post" >
        @csrf



        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="equipment">Slot: <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="slot" class="form-control col-md-12 col-xs-12" name="slot" placeholder="Enter Firstname" required type="text" >

             @if ($errors->has('slot'))
               <span class="errormsg">{{ $errors->first('slot') }}</span>
             @endif
          </div>
        </div>
    
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="room"> Active  <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
           
             <select id="active" class="form-control col-md-12 col-xs-12" name="active" placeholder="Enter subject name" required>
                          <option value="" selected disabled>Select</option>
                                                    <option value="1">active</option>
													<option value="2">inactive</option>
												</select>

             @if ($errors->has('active'))
               <span class="errormsg">{{ $errors->first('active') }}</span>
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
</div>
@endsection