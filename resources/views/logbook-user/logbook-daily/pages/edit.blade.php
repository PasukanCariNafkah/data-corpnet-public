@extends('layouts.default')

@section('title', 'Add Customer')
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
<div class="container">


    <div class="card border-o shadow rounded ">

        <div class="card-body">
            <form action="{{route('logbook-user-daily.update', $item->id)}}" method="post" id="submit-form">
                @method("PUT")
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="cid">CID User</label>
                        <input type="text" value="{{$item->corpnet->cid}}" name="cid" id="cid" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">Name of Customer</label>
                        <input type="text" readonly id="nama" class="form-control" value="{{$item->corpnet->nama}}">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="off_date">Off Date</label>
                        <input type="date" required placeholder="Input Date" class="form-control" name="off_date"
                            value="{{$item->off_date}}">
                        <input type="hidden" name="off_date_old" value={{$item->off_date}}>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="off_time">Off Time</label>
                        <input type="time" required class="form-control" name="off_time" value="{{$item->off_time}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="location_site">Location Site</label>
                        <select class="form-control" name="location_site">
                            <option value="Corpnet Bandung" {{$item->location_site
                                ==
                                "Corpnet Bandung" ?
                                'selected' : ''}}>Corpnet Bandung
                            </option>
                            <option value="Corpnet Bogor" {{$item->location_site ==
                                "Corpnet Bogor" ?
                                'selected' : ''}}>Corpnet Bogor
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="source_problem">Source Problem</label>
                        <select class="form-control" name="source_problem">
                            <option value="User" {{$item->source_problem == "User" ?
                                'selected' : ''}}>User</option>
                            <option value="ISP" {{$item->source_problem == "ISP" ?
                                'selected' : ''}}>ISP</option>
                            <option value="StarNet" {{$item->source_problem ==
                                "StarNet" ?
                                'selected' : ''}}>StarNet</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="link">Link ISP</label>
                        <select class="form-control" name="link">
                            <option value="None" {{$item->link == "None" ?
                                'selected' : ''}}>None</option>
                            <option value="All" {{$item->link == "All" ?
                                'selected' : ''}}>All</option>
                            <option value="iForte" {{$item->link == "iForte" ?
                                'selected' : ''}}>iForte</option>
                            <option value="Indosat" {{$item->link ==
                                "Indosat" ?
                                'selected' : ''}}>Indosat</option>
                            <option value="HSP" {{$item->link == "HSP" ?
                                'selected' : ''}}>HSP</option>
                            <option value="FiberStar" {{$item->link ==
                                "FiberStar"
                                ?
                                'selected' : ''}}>FiberStar</option>
                            <option value="Telkom" {{$item->link == "Telkom"
                                ?
                                'selected' : ''}}>Telkom</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="segment_isp">Segment ISP</label>
                        <select class="form-control" name="segment_isp">
                            <option value="None" {{$item->segment_isp == "None" ?
                                'selected' : ''}} >None</option>
                            <option value="Power Issue" {{$item->segment_isp ==
                                "Power Issue" ?
                                'selected' : ''}}>Power Issue</option>
                            <option value="Network Issue" {{$item->segment_isp ==
                                "Network Issue" ?
                                'selected' : ''}}>Network Issue
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="segment_user">Segment User</label>
                        <select class="form-control browser-default custom-select" name="segment_user"
                            id="category{{$item->id}}">
                            <option value="None"><b>None</b></option>
                            @foreach ($category as $c)
                            @if ($c->parent_id == null)
                            <option value="{{$c->nama}}" {{$c->nama ==
                                $item->segment_user
                                ? 'selected' : ''}} id="{{$c->id}}">{{$c->nama}}

                                @endif

                                @endforeach

                        </select>
                    </div>



                    <div class="form-group col-md-2">
                        <label for="follow_up_by">Follow Up By</label>
                        <select name="follow_up_by" class="form-control" required>

                            <option value="Dzikry Darmawan Pratama" {{$item->follow_up_by == "Dzikry Darmawan Pratama" ? 'selected' :
                                ''}}>Dzikry
                            </option>
                            <option value="Asep Kurniawan" {{$item->follow_up_by == "Asep Kurniawan" ? 'selected' :
                                ''}}>Asep K</option>
                            <option value="Asep Mulyana" {{$item->follow_up_by == "Asep Mulyana" ? 'selected' :
                                ''}}>Asep M</option>
                            <option value="Hendi Irwanto" {{$item->follow_up_by == "Hendi Irwanto" ? 'selected' :
                                ''}}>Hendi</option>
                            <option value="Irwan Maulana" {{$item->follow_up_by == "Irwan Maulana" ? 'selected' :
                                ''}}>Irwan</option>
                            <option value="Julyadi Asmawi" {{$item->follow_up_by == "Julyadi Asmawi" ? 'selected' :
                                ''}}>Julyadi</option>
                            <option value="Muhammad Muntako" {{$item->follow_up_by == "Muhammad Muntako" ? 'selected' :
                                ''}}>Muntako
                            </option>
                            <option value="Nur Rizki Agustian" {{$item->follow_up_by == "Nur Rizki Agustian" ?
                                'selected' : ''}}>Nur Rizki
                            </option>
                            <option value="Rijal Ahmad Janani" {{$item->solved_by == "Rijal Ahmad Janani" ?
                                'selected' : ''}}>Rijal
                            </option>
                            <option value="Roni Juwansyah" {{$item->follow_up_by == "Roni Juwansyah" ? 'selected' :
                                ''}}>Roni</option>
                            <option value="Syarif Ainul Yaqin" {{$item->follow_up_by == "Syarif Ainul Yaqin" ? 'selected' :
                                ''}}>Syarif</option>

                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="status">Status Logbook</label>
                        <select name="status" class="form-control">
                            <option value="DONE" {{$item->status == "DONE" ? 'selected' : ''}}>Done</option>
                            <option value="PENDING" {{$item->status == "PENDING" ? 'selected' : ''}}>Pending</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="impact">Impact Problem</label>
                        <input type="hidden" name="impact_old" value="{{$item->impact}}">
                        <select name="impact" class="form-control browser-default custom-select"
                            id="subcat{{$item->id}}">

                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="description">Description of
                            Problem</label>
                        <input type="text" name="description" class="form-control" value="{{$item->description}}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="action">Action Problem</label>
                        <input type="text" name="action" value="{{$item->action}}" class="form-control">
                    </div>


                    <div class="form-group col-md-2">
                        <label for="on_date">On Date</label>
                        <input type="date" name="on_date" placeholder="Input Date" class="form-control"
                            value="{{$item->on_date}}">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="on_time">On Time</label>
                        <input type="time" name="on_time" placeholder="Input Date" class="form-control"
                            value="{{$item->on_time}}">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="solved_by">Solved By</label>
                        <select name="solved_by" class="form-control">

                            <option value="Dzikry Darmawan Pratama" {{$item->solved_by == "Dzikry Darmawan Pratama" ? 'selected' :
                                ''}}>Dzikry
                            </option>
                            <option value="Asep Kurniawan" {{$item->solved_by == "Asep Kurniawan" ? 'selected' :
                                ''}}>Asep K</option>
                            <option value="Asep Mulyana" {{$item->solved_by == "Asep Mulyana" ? 'selected' :
                                ''}}>Asep M</option>
                            <option value="Hendi Irwanto" {{$item->solved_by == "Hendi Irwanto" ? 'selected' :
                                ''}}>Hendi</option>
                            <option value="Irwan Maulana" {{$item->solved_by == "Irwan Maulana" ? 'selected' :
                                ''}}>Irwan</option>
                            <option value="Julyadi Asmawi" {{$item->solved_by == "Julyadi Asmawi" ? 'selected' :
                                ''}}>Julyadi</option>
                            <option value="Muhammad Muntako" {{$item->solved_by == "Muhammad Muntako" ? 'selected' :
                                ''}}>Muntako
                            </option>
                            <option value="Nur Rizki Agustian" {{$item->solved_by == "Nur Rizki Agustian" ?
                                'selected' : ''}}>Nur Rizki
                            </option>
                            <option value="Rijal Ahmad Janani" {{$item->solved_by == "Rijal Ahmad Janani" ?
                                'selected' : ''}}>Rijal
                            </option>
                            <option value="Roni Juwansyah" {{$item->solved_by == "Roni Juwansyah" ? 'selected' :
                                ''}}>Roni</option>
                            <option value="Syarif Ainul Yaqin" {{$item->solved_by == "Syarif Ainul Yaqin" ? 'selected' :
                                ''}}>Syarif</option>
                            <option value="Team Internet" {{$item->solved_by ==
                                "Team Internet" ?
                                'selected' : ''}} >Team Internet
                            </option>
                            <option value="Team Maintenance" {{$item->solved_by ==
                                "Team Maintenance" ?
                                'selected' : ''}} >Team
                                Maintenance</option>
                            <option value="User" {{$item->solved_by == "User" ?
                                'selected' : ''}} >User</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary rounded btn-md" id="save-button">Save
                            Changes</button>
                    </div>

                    <div class="form-group col-md-4 offset-md-2">

                        <a href="{{route('logbook-user-daily.index')}}"
                            class="btn btn-secondary btn-md float-right">Back</a>
                    </div>
                </div>
            </form>
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

    $(document).ready( function () {
        var impact = {!! json_encode($item->impact) !!}
        var getCat = 'category'+{!! json_encode($item->id) !!}+''
        var getSubcat = '#subcat'+{!! json_encode($item->id) !!}+''
        var getData = document.getElementById(getCat);
        
        $('#category'+{!! json_encode($item->id) !!}+'').on('change', function(e) {
                var dataCat = $(this).children("option:selected").attr("value");
                $.ajax({
                    url: "{{route('logbook-user-daily.subcat')}}",
                    type: 'POST',
                    data: {
                        cat_name : dataCat
                    },

                    success:function(data) {
                        $(getSubcat).empty()
                        $.each(data.children[0].children, function(index, subcategory) {
                            var selected = subcategory.nama == impact ? "selected" : "";      
                            $(getSubcat).append('<option value="'+subcategory.nama+'" '+selected+'>'+subcategory.nama+'</option>');
                        });
                        
                    }
                });
        });
                var cat_name = $(getData).val();
                $.ajax({
                    url: "{{route('logbook-user-daily.subcat')}}",
                    type: 'POST',
                    data: {
                        cat_name : cat_name
                    },

                    success:function(data) {
                        $.each(data.children[0].children, function(index, subcategory) {
                            var selected = subcategory.nama == impact ? "selected" : "";      
                            $(getSubcat).append('<option value="'+subcategory.nama+'" '+selected+'>'+subcategory.nama+'</option>');
                        });
                        
                    }
                });
        $('#cid').on('change', function(e) {
            var cid = e.target.value;
                $.ajax({
                    url: "{{route('logbook-user-daily.add-logbook')}}",
                    type: 'POST',
                    data: {
                        cid : cid
                    },

                    success:function(data) {
                        $("#nama").val(data.name_corpnet.nama);
                        
                    }
                });

        });

var table = $('#example').DataTable({
 
columnDefs:[{targets:2,type:"date"}],
    order: [[2, "desc"], [3, "desc"]]
   
   
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