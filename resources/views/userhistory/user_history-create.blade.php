@extends('layouts.dashboard')
@section('content')

<h3>Create User History</h3>

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

        <a class='btn btn-info float-right' href="{{route('user_history')}}">List</a>

     </div>

     <form action="{{route('userhistory.usdstore')}}" method="post" >
        @csrf

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="equipment">Name: <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
             <select name="user_id" id="user_id" class="form-control select2 required" style="width: 100%;">
                                            <option selected disabled>[ Select  ]</option>
                                            @foreach ($Name as $item)
                                                <option value="{{ $item->id }}">{{ $item->first_name }}, {{ $item->middle_name }}, {{ $item->last_name }}</option>
                                            @endforeach
                </select>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="equipment">PlateNumber: <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="plate_number" class="form-control col-md-12 col-xs-12" name="plate_number" placeholder="Enter Firstname" required type="text">

             @if ($errors->has('plate_number'))
               <span class="errormsg">{{ $errors->first('plate_number') }}</span>
             @endif
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="equipment">RFID: <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="rfid" class="form-control col-md-12 col-xs-12" name="rfid" placeholder="Enter Firstname" required type="text" autofocus>

             @if ($errors->has('rfid'))
               <span class="errormsg">{{ $errors->first('rfid') }}</span>
             @endif
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="equipment">Vehicle: <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
             <select name="vehicle" id="vehicle" class="form-control select2 required" style="width: 100%;">
                                            <option selected disabled>[ Select  ]</option>
                                            @foreach ($category as $item)

                                                <option value="{{ $item->name }}" {{ isset($row) && $row->name == $item->name  ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                </select>

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
</div>
@endsection