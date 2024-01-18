@extends('layouts.dashboard')
@section('content')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js" defer></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js" defer></script>
<h3>Parking Slot</h3>
<script type="text/javascript"> $(document).ready(function() {
    $('#hminventories').DataTable( {
        dom: 'Bfrtip',
    } );
} );</script>

<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <!-- Alert message (start) -->
      @if(Session::has('message'))
      <div class="alert {{ Session::get('alert-class') }}">
         {{ Session::get('message') }}
      </div>
      @endif
      <!-- Alert message (end) -->

      <div class='actionbutton'>

      <a class='btn btn-info float-right' href="{{route('parking.parking-slot-create')}}">Add</a>

      </div>
      
     <table  id="hminventories" class="display nowrap" style="width:100%">
                          <thead>
                            <tr>
                              
                                <td width="200px">slot</td>
                                <td width="200px">active</td>
                                <td width="200px">availability</td>
                                <td width="200px">Actions</td>

                            </tr>
                          </thead>
                          <tbody>
                            @if (isset($parking))
                           
                                @foreach ($parking as $item)
                                <tr>
                                
                                    <td>{{ $item->slot }}</td>
                                    <td>
                                    @if ($item->active == 1)
										<span class="badge badge-success">Active</span>
									    @elseif( $item->active == 2)					
										<span class="badge badge-danger text-white">Inactive</span>
                        
										@else
									@endif
                                    </td>
                                    <td>
                                    @if ($item->availability == 1)
										<span class="badge badge-success">yes</span>
									    @elseif( $item->availability == 2)					
										<span class="badge badge-danger text-white">No</span>
                        
										@else
									@endif
                                    </td>

                                    <td>
									
										<a href="{{ route('parking.parking-slot-edit',[$item->id]) }}" class="btn btn-sm btn-success"> <i class="la la-edit"></i></a>
                                        <a href="{{ route('parking.delete',$item->id) }}" class="btn btn-sm btn-danger"><i class="la la-trash "> </i></a> 
										
									</td>
								

                                </tr>
                                @endforeach
                            @endif
                          </tbody>
                      </table>

   </div>
</div>

@endsection