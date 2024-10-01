@extends('layouts.default')

@section('title', 'Data CorpNet')

@push('addon-style')


<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
{{--
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css"> --}}

<style>
    .truncate {
        max-width: 150px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}" />

@endpush

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <!-- Button trigger modal -->
                <a href="{{ route('corpnet.create') }}" class="btn btn-primary rounded">
                    Add Customer
                </a>
                <a href="{{ route('olt.index') }}" class="btn btn-info float-right rounded">
                    Data OLT (s)
                </a>
            </div>
            <div class="card-body">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                    <thead>



                        <tr>
                            <th>CID</th>
                            <th>Customer</th>
                            <th>Address</th>
                            <th>Site Area</th>
                            <th>Node</th>
                            <th>OLT</th>
                            <th>FSAN</th>
                            <th>Speed</th>
                            <th>VLAN</th>
                            <th>IP</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>{{$item->cid}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->alamat}}</td>
                            <td>{{$item->site}}</td>
                            <td>{{$item->node}}</td>
                            <td>{{$item->olt}}</td>
                            <td>{{$item->fsan}}</td>
                            <td>{{$item->speed}} Mb</td>
                            <td>{{$item->vlan}}</td>
                            <td>{{$item->ip}}</td>
                            <td>
                                <a href="{{ route('corpnet.show', $item->id) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-address-card-o"></i>
                                </a>

                                <a href="{{ route('corpnet.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <form action="{{ route('corpnet.destroy', $item->id) }}" method="post" id="delete-form"
                                    class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm" id="delete-button">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                                <a href="{{route('corpnet.logbook', $item->id)}}" class="btn btn-secondary btn-sm"><i
                                        class="fa fa-calendar-check-o"></i></a>
                                {{-- <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal"
                                    data-target="#modal{{$item->id}}">

                                </button> --}}


                            </td>
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
    $.ajaxSetup({
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        


      
    $(document).ready( function () {
var table = $('#example').DataTable({
    
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
});

// $('.datepicker').datepicker({ 
//     format: 'dd/mm/yyyy',
//     startDate: new Date()
//     });


// $('#save-button').on('click', function(e) {
//     e.preventDefault();
//     Swal.fire(
//         "Success",
//         "Data Logbook Successfully Added",
//         "success"
//     );
//     $('#submit-form').submit();

    
// })

// $('#delete-button').on('click', function (e) {
//             e.preventDefault();
            
//             const swalWithBootstrapButtons = Swal.mixin({
//   customClass: {
//     confirmButton: 'btn btn-success',
//     cancelButton: 'btn btn-danger'
//   },
//   buttonsStyling: false
// })

// swalWithBootstrapButtons.fire({
//   title: 'Are you sure?',
//   text: "You won't be able to revert this!",
//   icon: 'warning',
//   showCancelButton: true,
//   confirmButtonText: 'Yes, delete it!',
//   cancelButtonText: 'No, cancel!',
//   reverseButtons: true
// }).then((result) => {
//   if (result.isConfirmed) {
//     swalWithBootstrapButtons.fire(
//       'Deleted!',
//       'Your file has been deleted.',
//       'success'
//     );
//     $('#delete-form').submit();
//   } else if (
//     /* Read more about handling dismissals below */
//     result.dismiss === Swal.DismissReason.cancel
//   ) {
//     swalWithBootstrapButtons.fire(
//       'Cancelled',
//       'Your imaginary file is safe :)',
//       'error'
//     )
//   }
// })
//         });


</script>

@endpush