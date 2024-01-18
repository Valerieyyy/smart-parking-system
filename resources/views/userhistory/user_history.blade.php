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
<h3>User History Driver</h3>
<h2>
    {{$first_name}}
</h2>
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

      <a class='btn btn-info float-right' href="{{route('userhistory.user_history-create')}}">Add</a>

      </div>
      
     <table  id="hminventories" class="display nowrap" style="width:100%">
                          <thead>
                            <tr>
                              
                                <td width="200px">Firstname</td>
                                <td width="200px">Middlename</td>
                                <td width="200px">Lastname</td>
                                <td width="200px">Status</td>
                                <td width="200px">Actions</td>

                            </tr>
                          </thead>
                          <tbody>
                            @if (isset($creds))
                            <!-- @dump($creds) -->
                                @foreach ($creds as $item)
                                    @if($item->user_type != 1 && $item->user_type != 2)
                                        <tr>
                                        
                                            <td>{{ $item->first_name }}</td>
                                            <td>{{ $item->middle_name }}</td>
                                            <td>{{ $item->last_name }}</td>
                                            <td>
                                            @if ($item->user_type == 1)
                                                <span class="badge badge-success">Super_admin</span>
                                                @elseif( $item->user_type == 2)					
                                                <span class="badge badge-danger text-white">Admin</span>
                                                @elseif( $item->user_type == 3)					
                                                <span class="badge badge-danger text-white">Staff</span>
                                                @elseif( $item->user_type == 4)					
                                                <span class="badge badge-danger text-white">Faculty</span>
                                                @elseif( $item->user_type == 5)					
                                                <span class="badge badge-danger text-white">Guest</span>
                                                @elseif( $item->user_type == 6)					
                                                <span class="badge badge-danger text-white">Student</span>
                                                
                                                @else
                                            @endif
                                            <td>
                                                <a href="{{ route('userhistory.user-add',[$item->id]) }}" class="btn btn-sm btn-success"> <i class='la la-plus-square-o'></i></a>
                                                <a href="{{ route('userhistory.user_history-view',[$item->id]) }}" class="btn btn-sm btn-success"> <i class='la la-eye'></i></a>
                                                <a href="{{ route('userhistory.user_history-edit',[$item->id]) }}" class="btn btn-sm btn-success"> <i class="la la-edit"></i></a>
                                                <a href="{{ route('user_history.delete',$item->id) }}" class="btn btn-sm btn-danger"><i class="la la-trash "> </i></a> 
                                                
                                            </td>
                                    @endif
                                    @endforeach
                            @endif 

                                </tr>

                                                     
                          </tbody>
                      </table>

   </div>
</div>

@endsection