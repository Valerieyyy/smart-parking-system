@extends('layouts.dashboard')
@section('content')

<h3>Create Parking Management</h3>

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

     <form action="{{route('parkingmanagement.parkingManageStore')}}" method="post" >
        @csrf



        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="equipment">Slot: <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
          <select name="slot_id" id="slot_id" class="form-control select2 required" style="width: 100%;">
                                            <option selected disabled>[ Select  ]</option>
                                            @foreach ($parking as $item)
                                            @if($item->availability == 1)
                                                <option value="{{ $item->id }}" {{ isset($row) && $row->slot == $item->slot  ? 'selected' : '' }}>{{ $item->slot }}</option>
                                             @else
                                            @endif
                                          @endforeach
                </select>

             <!-- <input id="slot" class="form-control col-md-12 col-xs-12" name="slot" placeholder="Enter Firstname" required type="text" > -->

             @if ($errors->has('slot'))
               <span class="errormsg">{{ $errors->first('slot') }}</span>
             @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="equipment">Category: <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
          <select name="vehicle_cat_id" id="vehicle_cat_id" class="form-control select2 required" style="width: 100%;">
                                            <option selected disabled>[ Select  ]</option>
                                            @foreach ($category as $item)

                                                <option value="{{ $item->name }}" {{ isset($row) && $row->name == $item->name  ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                </select>

             <!-- <input id="vehicle_cat_id" class="form-control col-md-12 col-xs-12" name="vehicle_cat_id" placeholder="Enter Firstname" required type="text" > -->

             @if ($errors->has('vehicle_cat_id'))
               <span class="errormsg">{{ $errors->first('vehicle_cat_id') }}</span>
             @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="equipment">Category: <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
          <select name="rate_id" id="rate_id" class="form-control select2 required" style="width: 100%;">
                                            <option selected disabled>[ Select  ]</option>
                                            @foreach ($rate as $item)

                                                <option value="{{ $item->rate_name }}" {{ isset($row) && $row->rate_name == $item->rate_name  ? 'selected' : '' }}>{{ $item->rate_name }}</option>
                                            @endforeach
                </select>

             <!-- <input id="rate_id" class="form-control col-md-12 col-xs-12" rate_name="rate_id" placeholder="Enter Firstname" required type="text" > -->

             @if ($errors->has('rate_id'))
               <span class="errormsg">{{ $errors->first('rate_id') }}</span>
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