@extends('layouts.default')

@section('title', 'Add Logbook User')

@push('addon-style')


<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">

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
        <div class="card-header">
        <a href="{{route('logbook-user-daily.index')}}" class="btn btn-info rounded float-right">Back to
                        Logbook</a>
        </div>
        <div class="card-body">
            
            <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>



                    <tr>
                        <th>CID</th>
                        <th>Customer</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($corpnets as $item)
                    <tr>
                        <td>{{$item->cid}}</td>
                        <td>{{$item->nama}}</td>
                        <td>
                            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal"
                                data-target="#modal{{$item->id}}" data-category="#category{{$item->id}}"
                                data-subcat="#subcat{{$item->id}}">
                                Add to Logbook
                            </button>

                        </td>
                    </tr>

                    <div class="modal" id="modal{{$item->id}}">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Add New Logbook User</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="card border-o shadow rounded">
                                        <div class="card-body">
                                            <form action="{{route('logbook-user-daily.storefromlogbook', $item->id)}}"
                                                method="post" id="submit-form">
                                                @method("POST")
                                                @csrf
                                                <div class="form-row">
                                                    <div class="form-group col-md-2">
                                                        <label for="cid">CID User</label>
                                                        <input type="text" readonly value="{{$item->cid}}" name="cid"
                                                            id="cid" class="form-control">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="name">Name of Customer</label>
                                                        <input type="text" readonly id="nama" class="form-control"
                                                            value="{{$item->nama}}">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="off_date">Off Date</label>
                                                        <input type="date" required placeholder="Input Date"
                                                            class="form-control" name="off_date"
                                                            value="{{old('off_date') }}">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="off_time">Off Time</label>
                                                        <input type="time" required class="form-control" name="off_time"
                                                            value="{{old('off_time') }}">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="location_site">Location Site</label>
                                                        <select class="form-control" name="location_site">
                                                            <option value="Corpnet Bandung">Corpnet Bandung
                                                            </option>
                                                            <option value="Corpnet Bogor">Corpnet Bogor
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="source_problem">Source Problem</label>
                                                        <select class="form-control" name="source_problem">
                                                            <option value="User">User</option>
                                                            <option value="ISP">ISP</option>
                                                            <option value="StarNet">StarNet</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="link">Link ISP</label>
                                                        <select class="form-control" name="link">
                                                            <option value="None">None</option>
                                                            <option value="All">All</option>
                                                            <option value="iForte">iForte</option>
                                                            <option value="Indosat">Indosat</option>
                                                            <option value="HSP">HSP</option>
                                                            <option value="FiberStar">FiberStar</option>
                                                            <option value="Telkom">Telkom</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="segment_isp">Segment ISP</label>
                                                        <select class="form-control" name="segment_isp">
                                                            <option value="None">None</option>
                                                            <option value="Power Issue">Power Issue</option>
                                                            <option value="Network Issue">Network Issue
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="segment_user">Segment User</label>
                                                        <select class="form-control browser-default custom-select"
                                                            name="segment_user" id="category{{$item->id}}">
                                                            <option value=""><b>Choose Segment User</b></option>
                                                            @foreach ($category as $c)
                                                            @if ($c->parent_id == null)
                                                            <option value="{{$c->nama}}">{{$c->nama}}

                                                                @endif

                                                                @endforeach

                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-2">
                                                        <label for="on_date">On Date</label>
                                                        <input type="date" name="on_date" placeholder="Input Date"
                                                            class="form-control" value="{{old('on_date') }}">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="on_time">On Time</label>
                                                        <input type="time" name="on_time" placeholder="Input Date"
                                                            class="form-control" value="{{old('on_time') }}">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="impact">Impact Problem</label>
                                                        <select name="impact"
                                                            class="form-control browser-default custom-select"
                                                            id="subcat{{$item->id}}">
                                                            {{-- @foreach ($category as $item)
                                                            @if ($item->parent_id != null)
                                                            option
                                                            @endif
                                                            @endforeach
                                                            <option value="Internet Down">Internet Down
                                                            </option>
                                                            <option value="Internet Problem">Internet
                                                                Problem</option>
                                                            <option value="Support">Support</option> --}}
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="description">Description of
                                                            Problem</label>
                                                        <input type="text" name="description" class="form-control"
                                                            value="{{old('description')}}">
                                                    </div>

                                                    <div class="form-group col-md-9">
                                                        <label for="action">Action Problem</label>
                                                        <input type="text" name="action" value="{{old('action')}}"
                                                            class="form-control">
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <label for="solved_by">Solved By</label>
                                                        <select name="solved_by" class="form-control">
                                                            <option value="">Choose Solved By</option>
                                                            <option value="NOC">NOC</option>
                                                            <option value="Team Internet">Team Internet
                                                            </option>
                                                            <option value="Team Maintenance">Team
                                                                Maintenance</option>
                                                            <option value="User">User</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <button type="submit" class="btn btn-primary rounded btn-md"
                                                            id="save-button">Save
                                                            Changes</button>
                                                        <button type="reset"
                                                            class="btn btn-warning rounded btn-md">Reset</button>

                                                    </div>

                                                    <div class="form-group col-md-4 offset-md-2">
                                                        <button type="button" class="btn btn-danger float-right"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    @endsection

    @push('addon-script')



    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>


    <script type="text/javascript">
        $.ajaxSetup({
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        


        $(document).on('click', 'button[data-target]', function (e) {
            var dataCategory = $(this).attr('data-category');
            var dataSubcat = $(this).attr('data-subcat');
            console.log(dataCategory);
            // console.log(dataSubcat);
            
            $(dataCategory).on('change', function(e){
                var cat_name = e.target.value;
                
                $.ajax({
                    url: "{{route('logbook-user-daily.subcat')}}",
                    type: 'POST',
                    data: {
                        cat_name : cat_name
                    },

                    success:function(data) {
                        console.log(data.children[0].children)
                        $(dataSubcat).empty();

                        console.log(dataSubcat)

                            // console.log(data.children[0].children);
                        $.each(data.children[0].children, function(index, subcategory) {
                            console.log(index, subcategory.nama)
                            $(dataSubcat).append('<option value="'+subcategory.nama+'">'+subcategory.nama+'</option>');
                        });
                    }
                });

            });
           

            
        });

        $(document).ready( function () {

            

var table = $('#example').DataTable({
    "lengthChange": false
// columnDefs:[{targets:2,type:"date"}],
// createdRow: function(row){
// var td = $(row).find(".truncate");
// td.attr("title", td.html());
// }
    // order: [[2, "desc"]]
});
} );

$('.datepicker').datepicker({ 
    format: 'dd/mm/yyyy',
    startDate: new Date()
    });




    </script>

    @endpush