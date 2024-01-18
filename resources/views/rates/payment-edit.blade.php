@extends('layouts.dashboard')
@section('content')

<h3>Edit Payment</h3>

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

        <a class='btn btn-info float-right' href="{{route('payment')}}">List</a>

     </div>

     <form action="{{route('payment.update',[$id])}}" method="post" >
        @csrf



        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="equipment">Rate Name: <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="rate_name" class="form-control col-md-12 col-xs-12" name="rate_name" placeholder="Enter Firstname" required type="text" value='{{$rate_name}}'>

             @if ($errors->has('rate_name'))
               <span class="errormsg">{{ $errors->first('rate_name') }}</span>
             @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="equipment">Type: <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
          <select class="form-control" id="type" name="type" value='{{$type}}'>
                    <option value="">Select Rate</option>
                    <option value="1">Fixed</option>
                    <option value="2">Hourly</option>
                  </select>

             @if ($errors->has('type'))
               <span class="errormsg">{{ $errors->first('type') }}</span>
             @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="equipment">Rate: <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="rate" class="form-control col-md-12 col-xs-12" name="rate" placeholder="Enter Firstname" required type="text" value='{{$rate}}'>

             @if ($errors->has('rate'))
               <span class="errormsg">{{ $errors->first('rate') }}</span>
             @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="room"> Category  <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
           
                <select name="category" id="category" class="form-control select2 required" style="width: 100%;">
                                            <option selected disabled>[ Select Designation ]</option>
                                            @foreach ($category as $item)
                                            @if($item->active == 1)
                                                <option value="{{ $item->name }}" {{ isset($row) && $row->name == $item->name  ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @else
                                            @endif
                                            @endforeach
                </select>

             @if ($errors->has('category'))
               <span class="errormsg">{{ $errors->first('category') }}</span>
             @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="equipment">Status: <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
          <select id="status" class="form-control col-md-12 col-xs-12" name="status" placeholder="Enter subject name" required>
                                @if ($status == 1)
                                                <option value="{{ $status }}" selected>Active</option>
                                            @elseif ($status == 2)
                                                <option value="{{ $status }}">InActive</option>         
                                    @endif 
                                    <option value="1">Active</option>
                                        <option value="2">InActive</option>
                                      

             @if ($errors->has('status'))
               <span class="errormsg">{{ $errors->first('status') }}</span>
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