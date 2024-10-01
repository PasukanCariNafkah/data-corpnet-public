@extends('layouts.default')

@section('title', 'Add Logbook Network')

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


    <div class="card border-o shadow rounded">
        <div class="card-body">
            <form action="{{route('logbook-network-daily.store')}}" method="post" id="submit-form">
                @method("POST")
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="cid">Area Problem</label>
                        <input type="text" value="{{old('area')}}" name="area" class="form-control" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="off_date">Off Date</label>
                        <input type="date" required placeholder="Input Date" class="form-control" name="off_date"
                            value="{{old('off_date') }}">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="off_time">Off Time</label>
                        <input type="time" required class="form-control" name="off_time" value="{{old('off_time') }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="sites">Location Site</label>
                        <select class="form-control" name="sites" required>
                            <option value="Bandung">Bandung
                            </option>
                            <option value="Bogor">Bogor
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="segment_user">Segment Problem</label>
                        <select class="form-control browser-default custom-select" name="segment" id="category"
                            required>
                            <option value=""><b>Choose Segment Problem</b></option>
                            @foreach ($category as $c)
                            @if ($c->parent_id == null)
                            <option value="{{$c->nama}}">{{$c->nama}}

                                @endif

                                @endforeach

                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="on_date">On Date</label>
                        <input type="date" name="on_date" placeholder="Input Date" class="form-control"
                            value="{{old('on_date') }}">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="on_time">On Time</label>
                        <input type="time" name="on_time" placeholder="Input Date" class="form-control"
                            value="{{old('on_time') }}">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="impact">Impact Problem</label>
                        <select name="impact" class="form-control browser-default custom-select" id="subcat">

                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="description">Description of
                            Problem</label>
                        <input type="text" name="description" class="form-control" value="{{old('description')}}">
                    </div>


                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary rounded btn-md" id="save-button">Save
                            Changes</button>
                        <button type="reset" class="btn btn-warning rounded btn-md">Reset</button>

                    </div>

                    <div class="form-group col-md-4 offset-md-2">
                        <button type="button" class="btn btn-danger float-right" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
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

    

        $(document).ready( function () {
            $("#category").on('change', function(e){
                var cat_name = e.target.value;
                
                $.ajax({
                    url: "{{route('logbook-network-daily.subcat')}}",
                    type: 'POST',
                    data: {
                        cat_name : cat_name
                    },

                    success:function(data) {
                        console.log(data.children[0].children)
                        $("#subcat").empty();
                            // console.log(data.children[0].children);
                        $.each(data.children[0].children, function(index, subcategory) {
                            console.log(index, subcategory.nama)
                            $("#subcat").append('<option value="'+subcategory.nama+'">'+subcategory.nama+'</option>');
                        });
                    }
                });

            });
            

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