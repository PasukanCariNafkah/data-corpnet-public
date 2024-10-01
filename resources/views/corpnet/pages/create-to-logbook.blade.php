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
        <div class="card-body">
            <form action="{{route('logbook-user-daily.storefromdata', $item->id)}}" method="post" id="submit-form">
                @method("POST")
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="cid">CID User</label>
                        <input type="text" readonly value="{{$item->cid}}" name="cid" id="cid" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">Name of Customer</label>
                        <input type="text" readonly id="nama" class="form-control" value="{{$item->nama}}" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="off_date">Off Date</label>
                        <input type="date" required placeholder="Input Date" class="form-control" name="off_date"
                            value="{{old('off_date') }}" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="off_time">Off Time</label>
                        <input type="time" required class="form-control" name="off_time" value="{{old('off_time') }}" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="location_site">Location Site</label>
                        <select class="form-control" name="location_site" required>
                        <option value=""> Select location
                            </option>  
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
                        <select class="form-control browser-default custom-select" name="segment_user" id="category" required>
                            <option value=""><b>Choose Segment User</b></option>
                            @foreach ($category as $item)
                            @if ($item->parent_id == null)
                            <option value="{{$item->nama}}">{{$item->nama}}

                                @endif

                                @endforeach

                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="follow_up_by">Follow Up By</label>
                        <select name="follow_up_by" class="form-control" required>
                            <option value="">Choose One</option>
                            <option value="Dzikry Darmawan Pratama">Dzikry</option>
                            <option value="Asep Kurniawan">Asep K</option>
                            <option value="Asep Mulyana">Asep M</option>
                            <option value="Hendi Irwanto">Hendi</option>
                            <option value="Irwan Maulana">Irwan</option>
                            <option value="Julyadi Asmawi">Julyadi</option>
                            <option value="Muhammad Muntako">Muntako</option>
                            <option value="Nur Rizki Agustian">Nur Rizki</option>
                            <option value="Rijal Ahmad Janani">Rijal</option>
                            <option value="Roni Juwansyah">Roni</option>
                            <option value="Syarif Ainul Yaqin">Syarif</option>

                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="status">Status Logbook</label>
                        <select name="status" class="form-control" required>
                            <option value="">Choose One</option>
                            <option value="DONE">Done</option>
                            <option value="PENDING">Pending</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="impact">Impact Problem</label>
                        <select name="impact" class="form-control browser-default custom-select" id="subcategory" required>

                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="description">Description of
                            Problem</label>
                        <input type="text" name="description" class="form-control" value="{{old('description')}}" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="action">Action Problem</label>
                        <input type="text" name="action" value="{{old('action')}}" class="form-control" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="on_date">On Date</label>
                        <input type="date" name="on_date" placeholder="Input Date" class="form-control"
                            value="{{old('on_date') }}" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="on_time">On Time</label>
                        <input type="time" name="on_time" placeholder="Input Date" class="form-control"
                            value="{{old('on_time') }}" required>
                    </div>


                    <div class="form-group col-md-2">
                        <label for="solved_by">Solved By</label>
                        <select name="solved_by" class="form-control" required>
                            <option value="">Choose Solved By</option>
                            <option value="Dzikry Darmawan Pratama">Dzikry</option>
                            <option value="Asep Kurniawan">Asep K</option>
                            <option value="Asep Mulyana">Asep M</option>
                            <option value="Hendi Irwanto">Hendi</option>
                            <option value="Irwan Maulana">Irwan</option>
                            <option value="Julyadi Asmawi">Julyadi</option>
                            <option value="Muhammad Muntako">Muntako</option>
                            <option value="Nur Rizki Agustian">Nur Rizki</option>
                            <option value="Rijal Ahmad Janani">Rijal</option>
                            <option value="Roni Juwansyah">Roni</option>
                            <option value="Syarif Ainul Yaqin">Syarif</option>
                            <option value="Team Internet">Team Internet
                            </option>
                            <option value="Team Maintenance">Team
                                Maintenance</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary rounded btn-md" id="save-button">Save
                            Changes</button>
                        <button type="reset" class="btn btn-warning rounded btn-md">Reset</button>

                    </div>

                    <div class="form-group col-md-4 offset-md-2">
                        <a href="{{route('corpnet.index')}}" class="btn btn-danger btn-md float-right">Back</a>
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
                    url: "{{route('logbook-user-daily.subcat')}}",
                    type: 'POST',
                    data: {
                        cat_name : cat_name
                    },

                    success:function(data) {
                        $("#subcategory").empty();

                            // console.log(data.children[0].children);
                        $.each(data.children[0].children, function(index, subcategory) {
                            $("#subcategory").append('<option value="'+subcategory.nama+'">'+subcategory.nama+'</option>');
                        });
                    }
                });

            });
       


} );






    </script>

    @endpush