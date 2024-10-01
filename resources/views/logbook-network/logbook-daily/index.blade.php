@extends('layouts.default')

@section('title', 'Logbook User CorpNet')

@push('addon-style')


<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">

{{-- Datatable Style --}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="sweetalert2.min.css">
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
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <!-- Button trigger modal -->
                <a href="{{route('logbook-network-daily.create')}}" class="btn btn-primary rounded">Add Logbook
                    Network</a>
                <a href="{{route('logbook-network-weekly.index')}}" class="btn btn-secondary rounded">To Category
                    Logbook</a>
                <a href="{{ route('report.logbookNetworkWeekly') }}" class="btn btn-success ml-4  float-right rounded">
                    Report Logbook Weekly
                </a>
                <a href="{{ route('report.logbookNetworkDaily') }}" class="btn btn-info float-right rounded">
                    Report Logbook
                </a>

            </div>
            <div class="card-body">


                <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                    <thead>

                        <tr>
                            <th>Area</th>
                            <th>Off Date</th>
                            <th>Off Time</th>
                            <th>Site</th>
                            <th>Impact</th>
                            <th>Description of Problem</th>
                            <th>On Date</th>
                            <th>On Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>{{$item->area}}</td>
                            <td>{{$item->off_date}}</td>
                            <td>{{$item->off_time}}</td>
                            <td>{{$item->sites}}</td>
                            <td>{{$item->impact}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{$item->on_date }}</td>
                            <td>{{$item->on_time}}</td>

                            <td>

                                <a href="{{route('logbook-network-daily.edit', $item->id)}}"
                                    class="btn btn-success btn-sm">Edit</a>
                                <form action="{{route('logbook-network-daily.destroy', $item->id)}}" method="post"
                                    id="delete-form" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" id="delete-button" class="btn btn-danger btn-sm"><i
                                            class="fa fa-trash"></i></button>
                                </form>
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

{{-- ===================================================================================================== --}}


<script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
    $.ajaxSetup({
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        


        $(document).on('click', 'button[data-target]', function (e) {
           

            var dataCategory = $(this).attr('data-category');
            var dataSubcat = $(this).attr('data-subcat');
            var dataGet = $(this).attr('data-get');
            var getData = document.getElementById(dataGet);
            console.log(dataCategory.value);
            console.log(getData.value);
       
            
         
                var cat_name = $(getData).val();
                console.log(cat_name)
                $.ajax({
                    url: "{{route('logbook-user-daily.subcat')}}",
                    type: 'POST',
                    data: {
                        cat_name : cat_name
                    },

                    success:function(data) {
                        // console.log(data.children[0].children)
                        // $(dataSubcat).empty();

                        // console.log(dataSubcat)
                        @foreach ($items as $item)
                        @if ($loop->first) {
                        var impact = {!! json_encode($item->impact) !!}  
                        // console.log(impact)
                        }
                        @endif
                        @endforeach
                            // console.log(data.children[0].children);
                        $.each(data.children[0].children, function(index, subcategory) {
                            console.log(index, subcategory.nama)

                            console.log(impact)
                            $(dataSubcat).append('<option value="'+subcategory.nama+'">'+subcategory.nama+'</option>');
                        });
                    }
                });

      
           

            
        });



    $(document).ready( function () {
    
    

var table = $('#example').DataTable({
 
columnDefs:[{targets:1,type:"date"}],
    order: [[1, "desc"], [2, "desc"]]
   
   
});





});




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






        // });


</script>

@endpush