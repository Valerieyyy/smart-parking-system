@extends('layouts.dashboard')
@section('content')
  <form action="{{route('save.profile')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Profile</h4>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="row">
                                            <div class="col-md-3 pr-1">
                                            <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" id="first_name" class="form-control" placeholder="Company" name="first_name" value="{{$first_name}}"disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3 px-1">
                                                <div class="form-group">
                                                    <label>Middle Name</label>
                                                    <input type="text" id="middle_name" class="form-control" placeholder="Company" name="middle_name" value="{{$middle_name}}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3 pl-1">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" id="last_name" class="form-control" placeholder="Company" name="last_name" value="{{$last_name}}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label>Contact Number</label>
                                                    <input type="number" id="contact_num" class="form-control" placeholder="Company" name="contact_num" value="{{$contact_num}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 pl-1">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" id="address" class="form-control" placeholder="Company" name="address" value="{{$address}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Birthday</label>
                                                    <input type="date" id="birthday" class="form-control" placeholder="Company" name="birthday" value="{{$birthday}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                <select id="sex" class="form-control col-md-12 col-xs-12" name="sex" placeholder="Enter subject name" value="{{$sex}}">
                                                    <option value="" selected disabled>{{$sex}}</option>
													<option value="Male">Male</option>
													<option value="Female">Female</option>
													<option value="prefer not to say">prefer not to say</option>
												</select>
                                                </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                            @if ($prof_pic !== NULL)
                                                <div class="image-input-wrapper" style="background-image: url(/storage/prof_pic/{{$prof_pic}})"></div>
                                            @else
                                                <div class="image-input-wrapper" style="background-image: url({{asset('assets/img/Dummy-image.jpg') }})"></div>
                                            @endif

                                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                             <i class="fa fa-pen icon-sm text-muted"></i>
                                             <input type="file" name="prof_pic" accept=".png, .jpg, .jpeg"/>
                                             <input type="hidden" name="prof_pic_remove"/>
                                            </label>

                                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                             <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </span>

                                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                             <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </span>
                                        </div>
                                        <span class="form-text"><strong>NOTE:</strong> Allowed file types: png, jpg, jpeg. Please upload 1x1 or 2x2 picture.</span>
                                            </div>
                                        </div>
                                            <!-- <div class="col-md-4 pl-1">
                                                <div class="form-group">
                                                    <label>Postal Code</label>
                                                    <input type="number" class="form-control" placeholder="ZIP Code">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>About Me</label>
                                                    <textarea rows="4" cols="80" class="form-control" placeholder="Here can be your description" value="Mike">Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</textarea>
                                                </div>
                                            </div> -->
                                        </div>
                                        <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-user">
                                <div class="card-image">
                                    <!-- <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."> -->
                                </div>
                                <div class="card-body">
                                    <div class="author">
                                        <a href="/edit_profile">
                                        <!-- <img src="/storage/prof_pic/{{$prof_pic}}" class="img-thumbnail" alt="Responsive image" max-width="160px" height="auto"> -->
                                        @if ($prof_pic !== NULL)
                                            <img src="/storage/prof_pic/{{$prof_pic}}" class="img-thumbnail" alt="Responsive image" max-width="160px" height="auto">
                                            @else
                                            <img src="{{asset('assets/img/dummy.png') }}" class="img-thumbnail" alt="Responsive image" max-width="160px" height="auto">
                                            @endif

                                        
                                            
                                        </a>
                                        <style>
                                        .p .description
                                        {
                                            justify-content: center;
                                        }
                                        </style>
                                        <p class="description">
                                        <h5 class="title">{{$first_name}}  {{$middle_name}}, {{$last_name}}</h5> 
                                            Contact Number: {{$contact_num}}
                                            <br>
                                            Address:{{$address}}
                                            <br>
                                            Birthday:{{$birthday}}
                                            <br>
                                            Sex: {{$sex}}
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="button-container mr-auto ml-auto">
                                    <button href="#" class="btn btn-simple btn-link btn-icon">
                                        <i class="fa fa-facebook-square"></i>
                                    </button>
                                    <button href="#" class="btn btn-simple btn-link btn-icon">
                                        <i class="fa fa-twitter"></i>
                                    </button>
                                    <button href="#" class="btn btn-simple btn-link btn-icon">
                                        <i class="fa fa-google-plus-square"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </form>


@endsection