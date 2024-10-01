@extends('layouts.default')

@section('title', 'Logbook User CorpNet')

@push('addon-style')


<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">

{{-- Datatable Style --}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.bootstrap4.min.css">
{{-- ===================================================================================================================
--}}

<style>
    .truncate {
        max-width: 150px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

@endpush

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <!-- Button trigger modal -->
                <a href="{{route('logbook-user-daily.index')}}" class="btn btn-info rounded float-right">Back to
                    Logbook</a>
                {{-- <a href="{{ route('olt.index') }}" class="btn btn-info float-right rounded">
                    Data OLT (s)
                </a> --}}
            </div>
            <div class="card-body">
                <table border="0" cellspacing="5" cellpadding="5">
                    <tbody>
                        <tr>
                            <td>Start date:</td>
                            <td><input type="text" id="min" name="min"></td>
                        </tr>
                        <tr>
                            <td>End date:</td>
                            <td><input type="text" id="max" name="max"></td>
                        </tr>
                    </tbody>
                </table>

                <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>

@php
$no = 1;
@endphp

<tr>
    <th>No</th>
    <th>Upstream / ISP</th>
    <th>Off Date</th>
    <th>Off Time</th>
    <th>Site</th>
    <th>Link</th>
    <th>Segment Problem</th>
    <th>Impact</th>
    <th>Description</th>
    <th>On Date</th>
    <th>On Time</th>
    <th>Ticket</th>
</tr>
</thead>
<tbody>
@foreach ($items as $item)
<tr>
    <td>{{$no++}}</td>
    <td>{{$item->upstream->nama}}</td>
    <td>{{$item->off_date}}</td>
    <td>{{$item->off_time}}</td>
    <td>{{$item->location_site}}</td>
    <td>{{$item->link}}</td>
    <td>{{$item->segment}}</td>
    <td>{{$item->impact}}</td>
    <td>{{$item->description}}</td>
    <td>{{$item->on_date }}</td>
    <td>{{$item->on_time}}</td>
    <td>{{$item->ticket}}</td>


</tr>
@endforeach
</tbody>
                </table>




            </div>
        </div>
    </div>
</div>






@endsection


@push('addon-script')



<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>


{{-- Datatable script --}}
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js">
</script>
<script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.colVis.min.js"></script>
{{-- ===================================================================================================== --}}


<script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    var minDate, maxDate;
 
// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        // var min = minDate.val();
        // var max = maxDate.val();
        var minDate = document.getElementById("min").value;
      var min = new Date(minDate);
      var maxDate = document.getElementById("max").value;
      var max = new Date(maxDate);
        var date = new Date( data[2] );
        
        // if (
        //     ( min === null && max === null ) ||
        //     ( min === null && date <= max ) ||
        //     ( min <= date  && max === null ) ||
        //     ( min <= date   && date <= max )
        // ) {
        //     return true;
        // }
        // return false;
        if (!minDate && !maxDate) {
        return true;
      }
      if (!minDate && date <= max) {
        return true;
      }
      if (!maxDate && date >= min) {
        return true;
      }
      if (date <= max && date >= min) {
        return true;
      }
      return false;
    }
);


    $(document).ready( function () {
        minDate = new DateTime($('#min'), {
        format: 'YYYY-MM-DD'
    });
    maxDate = new DateTime($('#max'), {
        format: 'YYYY-MM-DD'
    });
    

var table = $('#example').DataTable({
    // dom: 'Bfrtip',
    lengthChange: false,
    buttons: [ {
            extend: 'excelHtml5',
            sheetName: 'Logbook User'
        } ],
    
columnDefs:[{targets:2,type:"date"}],
    order: [[2, "desc"]]
   
   
});

table.buttons().container()
        .appendTo( '.col-md-6:eq(0)' );


$('#min, #max').on('change', function () {
        table.draw();
    });



});










       


</script>

@endpush