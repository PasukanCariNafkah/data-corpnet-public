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

{{-- ===================================================================================================================
--}}

<style>
    .truncate {
        max-width: 150px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .ol_style {
        margin-top: 13px
    }

    .li_style {
        margin-top: 20px
    }
</style>

@endpush

@section('content')

<div class="card">
    <div class="card-header">
    <a href="{{route('logbook-user-daily.index')}}" class="btn btn-info rounded float-right">Back to
                    Logbook</a>
</div>
        <div class="card-body">
            <div class="row">
                <div class="col-5">
                    <div class="card">
                        <div class="card-header">
                            <h6>Add Category or Subcategory</h6>
                        </div>
                        <form action="{{route('logbook-user-weekly.store')}}" method="post">
                            <div class="card-body">
                                @method("POST")
                                @csrf
                                <div class="form-group">
                                    <label for="caetory">Category of Logbook</label>
                                    <input type="text" required name="nama" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="parent_id">Sub Category / Description</label>
                                    <select name="parent_id" class="form-control">
                                        <option value=""></option>
                                        @foreach ($categories as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-7">
                    <div class="card">
                        <div class="card-header">
                            <!-- Button trigger modal -->
                            <h6>List of Category and Sub Category</h6>
                        </div>
                        <div class="card-body">

                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                                style="width:100%">
                                <thead>



                                    <tr>
                                        <th>No</th>
                                        <th>Category / Subcategory</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no= 1;

                                    @endphp
                                    @foreach ($categories as $item)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>
                                            <b>{{$item->nama}}</b>
                                            <ul>
                                                @foreach ($item->children as $subcategory)
                                                <li class="li_style">{{$subcategory->nama}}</li>
                                                @endforeach
                                            </ul>
                                        </td>


                                        <td>
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('logbook-user-weekly.edit', $item->id) }}"><i
                                                    class="fa fa-pencil"></i>
                                            </a>
                                            <form action="{{route('logbook-user-weekly.destroy', $item->id)}}"
                                                id="delete-form" class="d-inline" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" id="delete-button"
                                                    class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                            </form>

                                            <ul>
                                                @foreach ($item->children as $subcategory)
                                                <ol class="ol_style">
                                                    <a class="btn btn-sm btn-primary table_style"
                                                        href="{{ route('logbook-user-weekly.edit', $subcategory->id) }}"><i
                                                            class="fa fa-pencil"></i>
                                                    </a>
                                                    <form
                                                        action="{{route('logbook-user-weekly.destroy', $subcategory->id)}}"
                                                        id="delete-form" class="d-inline" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" id="delete-button"
                                                            class="btn btn-danger btn-sm"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </ol>

                                                @endforeach
                                            </ul>

                                        </td>
                                    </tr>


                                    @endforeach
                                </tbody>
                            </table>




                        </div>
                    </div>
                </div>
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
<script src="https://cdn.datatables.net/rowgroup/1.1.4/js/dataTables.rowGroup.min.js"></script>
{{-- ===================================================================================================== --}}


<script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $(document).ready( function () {
    
    

var table = $('#example').DataTable({
 

    order: [[0, "asc"]],
    // rowGroup: {
    //         dataSrc: 1
    //     },
    //     columnDefs: [ {
    //         targets: 1,
    //         visible: false
    //     } ]
   
   
});





});




$('#delete-button').on('click', function (e) {
            e.preventDefault();
            
            const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    swalWithBootstrapButtons.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    );
    $('#delete-form').submit();
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your imaginary file is safe :)',
      'error'
    )
  }
})






        });


</script>

@endpush