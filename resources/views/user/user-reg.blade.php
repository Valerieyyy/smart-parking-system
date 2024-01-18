@extends('layouts.dashboard')
@section('content')


<div class="col-md-15">
								<div class="card">
									<div class="card-header ">
										<h4 class="card-title">User Registered</h4>
										<p class="card-category">Users Table</p>
									</div>
									<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
									<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" defer></script>
									<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js" defer></script>
									<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
									<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
									<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
									<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js" defer></script>
									<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js" defer></script>

									<script type="text/javascript"> $(document).ready(function() {
											$('#userid').DataTable( {
											} );
										} );</script>
									<div class="card-body">
											<div class="table-responsive">
													<table class="table table-head-bg-success table-striped table-hover" id="userid">
														<thead>
															<tr>
																				
																<th scope="col">Name</th>
																<th scope="col">Email</th>
																<th scope="col">Status</th>
																				
																				
																				
															</tr>
														</thead>
														<tbody>
														@if (isset($creds))
																@foreach ($creds as $item)
																@if($item->user_type != 3 && $item->user_type != 4 && $item->user_type != 5 && $item->user_type != 6)
																<tr>
																		<td>{{Str::ucfirst($item->first_name)}}, 
																		{{Str::ucfirst($item->last_name)}},</td>
																		<td>{{ $item->email }}</td>
																		<td>@if ($item->user_type  == 1)
																				Super Admin
																			@elseif ($item->user_type  == 2)
																				Admin
																			@elseif ($item->user_type  == 3)
																				Faculty
                                                                            @elseif ($item->user_type  == 4)
																				Staff
                                                                            @elseif ($item->user_type  == 5)
																				Guest
                                                                            @elseif ($item->user_type  == 6)
																				Student
																			@else
																			@endif
																			 
																		</td>
																</tr>		
																@endif
																@endforeach
														@endif
													   </tbody>
												
													</table>
											</div>
									</div>
								</div>
							</div>
@endsection