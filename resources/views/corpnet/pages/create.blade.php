@extends('layouts.default')

@section('title', 'Add Customer')

@section('content')
<div class="container">


    <div class="card border-o shadow rounded ">

        <div class="card-body">
            <form action="{{ route('corpnet.store') }}" method="post">
                @method('POST')
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="cid" class="font-weight-bold">CID User</label>
                        <input type="text" name="cid" value="{{ old('cid') }}"
                            class="form-control @error('cid') is-invalid @enderror">

                        @error('cid')
                        <div class="text-muted">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-8">
                        <label for="nama" class="font-weight-bold">Name of Customer</label>
                        <input type="text" name="nama" value="{{old('nama')}}"
                            class="form-control @error('nama') is-invalid @enderror">

                        @error('nama')
                        <div class="text-muted">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-8">
                        <label for="alamat" class="font-weight-bold">Address</label>
                        <input type="text" name="alamat" class="form-control @error('alamat') is-invaldi @enderror"
                            value="{{old('alamat')}}" placeholder="Contoh: Jl. Karang Tinggal No. 27 Sukajadi">

                        @error('alamat')
                        <div class="text-muted">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="site" class="font-weight-bold">Site Area</label>
                        <select name="site" id="exampleFormControlSelect1" class="form-control" required>
                            <option value="">Choose Site</option>
                            <option value="Bandung">Bandung</option>
                            <option value="Bogor">Bogor</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="olt" class="font-weight-bold">Choose OLT</label>
                        <select class="form-control" name="olt" id="exampleFormControlSelect1" required>
                            <option value="">Choose Olt</option>
                            @foreach ($items as $item)
                            <option value="{{$item->name_olt}}">{{$item->name_olt}}</option>
                            @endforeach

                        </select>
                        @error('olt')
                        <div class="text-muted">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label for="node" class="font-weight-bold">Node (Area OLT)</label>
                        <input type="text" name="node" value="{{old('node')}}" placeholder="ex:H01N15"
                            class="form-control @error('node') is-invalid @enderror">

                        @error('node')
                        <div class="text-muted">{{$error}}</div>
                        @enderror
                    </div>




                    <div class="form-group col-md-3">
                        <label for="olt_number" class="font-weight-bold">Registration Date</label>
                        <input type="date" name="tanggal_regis" placeholder="Tanggal registrasi" class="form-control"
                            required>

                    </div>


                    <div class="form-group col-md-3">
                        <label for="fsan" class="font-weight-bold">FSAN User</label>
                        <input type="text" name="fsan" value="{{old('fsan')}}"
                            class="form-control @error('fsan') is-invalid @enderror">

                        @error('fsan')
                        <div class="text-muted">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="speed" class="font-weight-bold">Speed User (Mb)</label>
                        <input type="number" name="speed" min="1" value="{{ old('speed') }}"
                            class="form-control @error('speed') is-invalid @enderror">

                        @error('speed')
                        <div class="text-muted">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="vlan" class="font-weight-bold">Vlan User</label>
                        <select name="vlan" class="form-control">
                            <option value="2500">2500</option>
                            <option value="2100">2100</option>
                            <option value="2010">2010</option>
                            <option value="2020">2020</option>
                            <option value="2030">2030</option>
                            <option value="2800">2800</option>
                            <option value="2850">2850</option>
                            <option value="2900">2900</option>
                            <option value="1031">1031</option>
                            <option value="2011">2011</option>
                        </select>




                    </div>

                    <div class="form-group col-md-4">
                        <label for="ip" class="font-weight-bold">IP Static User</label>
                        <input type="text" name="ip" value="{{old('ip') ? old('ip') : " 0.0.0.0" }}"
                            placeholder="Jika tidak ada ip static isikan 0.0.0.0"
                            class="form-control @error('ip') is-invalid @enderror">

                        @error('ip')
                        <div class="text-muted">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary rounded btn-md">Save Changes</button>
                        <button type="reset" class="btn btn-warning rounded btn-md">Reset</button>

                    </div>

                    <div class="form-group col-md-4 offset-md-2">
                        <a href="{{ route('corpnet.index') }}"
                            class="btn btn-secondary rounded btn-md float-right">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection