@extends('layouts.default')

@section('title', 'Edit Logbook Upstream')

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
            <form action="{{route('logbook-upstream-daily.update', $item->id)}}" method="post" id="submit-form">
                @method("PUT")
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="cid">Upstream Problem</label>
                        <input type="hidden" name="upstream_old" value="{{$item->upstream->id}}">
                        <select name="upstream" required class="form-control">
                            <option value="">Choose Upstream</option>
                            @foreach ($userUpstream as $upstream)
                            <option value="{{$upstream->id}}" {{$upstream->id == $item->upstream_id ? 'selected' : ''}}
                                >{{$upstream->nama}}
                                @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="off_date">Off Date</label>
                        <input type="date" required placeholder="Input Date" class="form-control" name="off_date"
                            value="{{$item->off_date }}">
                        <input type="hidden" name="off_date_old" value={{$item->off_date}}>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="off_time">Off Time</label>
                        <input type="time" required class="form-control" name="off_time" value="{{$item->off_time }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="sites">Location Site</label>
                        <select class="form-control" name="location_site" required>
                            <option value="Bandung" {{$item->location_site == 'Bandung' ? 'selected' : ''}} >Bandung
                            </option>
                            <option value="Bogor" {{$item->location_site == 'Bogor' ? 'selected' : ''}}>Bogor
                            </option>
                            <option value="All" {{$item->location_site == 'All' ? 'selected' : ''}}>All
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="sites">Link</label>
                        <select class="form-control" name="link" required>
                            <option value="Domestik" {{$item->link == 'Domestik' ? 'selected' : ''}} >Domestik
                            </option>
                            <option value="Global" {{$item->link == 'Global' ? 'selected' : ''}}>Global
                            </option>
                            <option value="All" {{$item->link == 'All' ? 'selected' : ''}}>All
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="segment_user">Segment Problem</label>
                        <select class="form-control browser-default custom-select" name="segment"
                            id="category{{$item->id}}" required>
                            <option value=""><b>Choose Segment Problem</b></option>
                            @foreach ($category as $c)
                            @if ($c->parent_id == null)
                            <option value="{{$c->nama}}" {{$c->nama == $item->segment ? 'selected' : ''}}>{{$c->nama}}

                                @endif

                                @endforeach

                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="impact">Impact Problem</label>
                        <input type="hidden" name="impact_old" value="{{$item->impact}}">
                        <select name="impact" class="form-control browser-default custom-select"
                            id="subcat{{$item->id}}">

                        </select>
                    </div>

                    <div class="form-group col-md-5">
                        <label for="description">Description of
                            Problem</label>
                        <input type="text" name="description" class="form-control" value="{{$item->description}}">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="on_date">On Date</label>
                        <input type="date" name="on_date" placeholder="Input Date" class="form-control"
                            value="{{$item->on_date }}">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="on_time">On Time</label>
                        <input type="time" name="on_time" placeholder="Input Date" class="form-control"
                            value="{{$item->on_time }}">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="description">Ticket</label>
                        <input type="text" name="ticket" class="form-control" value="{{$item->ticket}}">
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
            var impact = {!! json_encode($item->impact) !!}
        var getCat = 'category'+{!! json_encode($item->id) !!}+''
            console.log(getCat)
        var getSubcat = '#subcat'+{!! json_encode($item->id) !!}+''
            console.log(getSubcat)
            var getData = document.getElementById(getCat);
            // console.log(getData)
            
            $('#category'+{!! json_encode($item->id) !!}+'').on('change', function(e) {
                var dataCat = $(this).children("option:selected").attr("value");
                console.log(dataCat);
                $.ajax({
                    url: "{{route('logbook-upstream-daily.subcat')}}",
                    type: 'POST',
                    data: {
                        cat_name : dataCat
                    },

                    success:function(data) {
                        $(getSubcat).empty()
                        console.log(data.children[0].children)
                        $.each(data.children[0].children, function(index, subcategory) {
                            console.log(index, subcategory.nama)
                            var selected = subcategory.nama == impact ? "selected" : "";      
                            $(getSubcat).append('<option value="'+subcategory.nama+'" '+selected+'>'+subcategory.nama+'</option>');
                        });
                        
                    }
                });
        });
            
            var cat_name = $(getData).val();
                console.log(cat_name)
                $.ajax({
                    url: "{{route('logbook-upstream-daily.subcat')}}",
                    type: 'POST',
                    data: {
                        cat_name : cat_name
                    },

                    success:function(data) {
                        console.log(data.children[0].children)
                        $.each(data.children[0].children, function(index, subcategory) {
                            console.log(index, subcategory.nama)
                            var selected = subcategory.nama == impact ? "selected" : "";      
                            $(getSubcat).append('<option value="'+subcategory.nama+'" '+selected+'>'+subcategory.nama+'</option>');
                        });
                        
                    }
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