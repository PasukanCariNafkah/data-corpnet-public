@extends('layouts.default')

@section('title', 'Detail Info Customer')

@push('addon-style')
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">

@endpush

@section('content')


<div class="row">
    <div class="col-sm-5">
        <div class="card ">
            <div class=" card-header bg-primary text-white text-center">
                <h4>Detail Information user <strong>{{$data->nama}}</strong></h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <h5 class=" card-title">CID</h5>
                        <p class="card-text">{{$data->cid}}</p>
                    </div>
                    <div class="col-md-9">
                        <h5 class="card-title">Alamat</h5>
                        <p class="card-text">{{$data->alamat}}</p>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-md-4">
                        <h5 class="card-title">Node / Area</h5>
                        <p class="card-text">{{$data->node}}</p>
                    </div>
                    <div class="col-md-4">
                        <h5 class="card-title">OLT</h5>
                        <p class="card-text">{{$data->olt}}</p>
                    </div>
                    <div class="col-md-4">


                        <h5 class="card-title">Registration Date</h5>
                        <p class="card-text">{{date('F d, Y', strtotime($data->tanggal_regis))}}</p>
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <h5 class="card-title">Speed</h5>
                        <p class="card-text">{{$data->speed}}</p>
                    </div>
                    <div class="col-md-3">
                        <h5 class="card-title">FSAN</h5>
                        <p class="card-text">{{$data->fsan}}</p>
                    </div>
                    <div class="col-md-3">
                        <h5 class="card-title">VLAN</h5>
                        <p class="card-text">{{$data->vlan}}</p>
                    </div>
                    <div class="col-md-3">
                        <h5 class="card-title">Static IP</h5>
                        <p class="card-text">{{$data->ip}}</p>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <a href="{{ route('corpnet.index') }}" class="btn btn-primary btn-sm float-right text-white">Back to
                    Home</a>
            </div>
        </div>
    </div>
    <div class="col-sm-7">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4>History Pergantian ONU FSAN</h4>
            </div>
            <div class="card-body">
                <table id="example" class="table table-striped table-bordered table-hover dt-responsive nowrap"
                    style="width:100%">
                    <thead>



                        <tr>
                            <th>FSAN Lama</th>
                            <th>FSAN Baru</th>
                            <th>Tanggal Pergantian</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($histories as $history)

                        <tr class="table-danger">
                            <td>{{$history->fsan_lama}}</td>
                            <td>{{$history->fsan_baru}}</td>
                            <td>{{ date('d-m-Y', strtotime($history->created_at)) }}</td>
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
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js">
</script>
<script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>


<script>
    $(document).ready( function () {
var table = $('#example').DataTable();
} );
</script>
@endpush