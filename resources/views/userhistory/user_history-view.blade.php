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
<h3>{{ $fname }} {{ $mname }},{{ $lname  }}</h3>
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
      
     <table  id="hminventories" class="display nowrap" style="width:100%">
                          <thead>
                            <tr>
                              
                                <td width="200px">Time In</td>
                                <td width="200px">Time Out</td>

                            </tr>
                          </thead>
                          <tbody>
                            @if (isset($scan))
                           
                                @foreach ($scan as $item)
                                <tr>
                                
                                    <td>{{ date( 'h:i a', strtotime($item->time_in)) }}</td>
                                    @if($item->time_out != NULL)
                                    <td>{{ date( 'h:i a', strtotime($item->time_out)) }}</td>
                                    @else
                                    <td></td>
                                    @endif

                                </tr>
                                @endforeach
                            @endif
                          </tbody>
                      </table>

   </div>
</div>

@endsection
