@extends('layouts.dashboard')
@section('content')
<h3>CREATE ADMIN ACCOUNT</h3>
<form action="{{route('/save.admin')}}" method="post" enctype="multipart/form-data">
        @csrf
	<div class="modal-body">
											<div class="row">
														<div class="col-lg-12">
															<label for="first_name">Firstname:</label>
															<input id="first_name" type="text" class="form-control validate-field" error-message="First name is required" name="first_name" value="{{ old('first_name') }}">
															<span class="error-message text-center"></span>
														</div>
														<div class="col-lg-12">
															<label for="middle_name">Middlename:</label>
															<input  id="middle_name" type="text" class="form-control validate-field" error-message="Last name is required" name="middle_name" value="{{ old('middle_name') }}">
															<span class="error-message text-center"></span>
														</div>
														<div class="col-lg-12">
															<label for="last_name">Lastname:</label>
															<input id="last_name"type="text" class="form-control validate-field" error-message="Last name is required" id="last_name" name="last_name" value="{{ old('last_name') }}">
															<span class="error-message text-center"></span>
														</div>
													</div>
													<div class="row" style="margin-top:10px;">
														<div class="col-lg-12">
															<label for="email">Email:</label>
															<input id="email"type="text" class="form-control validate-field" error-message="Email is required" name="email" value="{{ old('email') }}">
															<span class="error-message text-center"></span>
														</div>
													</div>
												</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary btn-register-admin">Register New Admin</button>
						</div>
	</div>
</form>
@endsection