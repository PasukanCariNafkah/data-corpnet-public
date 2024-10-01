@extends('layouts.default')

@section('title', 'Home')

@section('content')
<div class="jumbotron jumbotron-fluid" style="padding-bottom: 150px; padding-top:150px">
    <div class="container text-center">
        <h1 class="display-4">Holla, {{ Auth::user()->name }} !</h1>
        <p class="lead">This web application to simplify work related to corpnet data.</p>

    </div>
</div>
<div class="container-fluid">
    <h3 class="text-center">Choose application you need.</h3>
    <div class="card-group">
        <div class="card border-right">
            <div class="card-body text-center">

                <div>

                    <a href="{{ route('corpnet.index') }}" class="btn btn-primary btn-lg rounded text-white">Data
                        CorpNet</a>
                    <p></P>
                    <h6 class="text-muted font-weight-normal mb-0 mt-1 w-100">This application
                        to check information about customer like Serial Number Device ONU (FSAN), Speed,
                        Vlan, etc.</h6>
                </div>


            </div>
        </div>

        <div class="card border-right">
            <div class="card-body text-center">

                <div class="row">
                    <div class="col-md">

                        <a href="{{route('logbook-user-daily.index')}}"
                            class="btn btn-success btn-lg rounded text-white">LogBook User</a>
                        <p></p>
                        <h6 class="text-muted font-weight-normal mb-0 mt-1 w-100 ">Wait for realease this
                            application.</h6>
                    </div>
                    <div class="col-md">

                        <a href="{{route('logbook-network-daily.index')}}"
                            class="btn btn-success btn-lg rounded text-white">LogBook Network</a>
                        <p></p>
                        <h6 class="text-muted font-weight-normal mb-0 mt-1 w-100 ">Wait for realease this
                            application.</h6>
                    </div>
                    <div class="col-md">

                        <a href="{{route('logbook-upstream-daily.index')}}"
                            class="btn btn-success btn-lg rounded text-white">LogBook Upstream</a>
                        <p></p>
                        <h6 class="text-muted font-weight-normal mb-0 mt-1 w-100 ">Wait for realease this
                            application.</h6>
                    </div>
                </div>




            </div>
        </div>

        <div class="card">
            <div class="card-body text-center">

                <div>

                    <a href="{{route('ups.index')}}" class="btn btn-secondary btn-lg rounded text-white">UPS</a>
                    <p></p>
                    <h6 class="text-muted font-weight-normal mb-0 mt-1 w-100 ">Wait for realease this
                        application.</h6>
                </div>


            </div>
        </div>

    </div>
</div>

@endsection

@push('addon-script')
<script src="https://code.highcharts.com/highcharts.js"></script>


@endpush