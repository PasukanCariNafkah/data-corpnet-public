@extends('layouts.default')

@section('title', 'Edit Customer')

@section('content')
<div class="container">


    <div class="card bg-light ">
        <div class="card-header">
            <h3>Edit Customer <small>{{$data->nama}}</small></h3>
        </div>
        <div class="card-body">
            <form action="{{ route('corpnet.update', $data->id) }}" method="post">
                @method('PUT')
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="cid" class="font-weight-bold">CID User</label>
                        <input type="text" name="cid" value="{{ old('cid') ? old('cid') : $data->cid }}"
                            class="form-control @error('cid') is-invalid @enderror">

                        @error('cid')
                        <div class="text-muted">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-8">
                        <label for="nama" class="font-weight-bold">Name of Customer</label>
                        <input type="text" name="nama" value="{{old('nama') ? old('nama') : $data->nama }}"
                            class="form-control @error('nama') is-invalid @enderror">

                        @error('nama')
                        <div class="text-muted">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-8">
                        <label for="alamat" class="font-weight-bold">Address</label>
                        <input type="text" name="alamat" class="form-control @error('alamat') is-invaldi @enderror"
                            value="{{old('alamat') ? old('alamat') : $data->alamat}}"
                            placeholder="Contoh: Jl. Karang Tinggal No. 27 Sukajadi">

                        @error('alamat')
                        <div class="text-muted">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="site" class="font-weight-bold">Site Area</label>
                        <select name="site" id="exampleFormControlSelect1" class="form-control">
                            <option value="Bandung" {{$data->site == "Bandung" ? "selected" : ""}} >Bandung</option>
                            <option value="Bogor" {{$data->site == "Bogor" ? "selected" : ""}} >Bogor</option>

                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="olt" class="font-weight-bold">Choose OLT</label>
                        <select class="form-control" name="olt" id="exampleFormControlSelect1" required>
                            {{-- <option value="{{$data->olt}}">{{$data->olt}}</option>
                            <option value="">-----------------</option> --}}

                            @foreach ($items as $item)
                            @if ($item->name_olt == $data->olt)

                            <option value="{{$data->olt}}" selected>{{$data->olt}}</option>
                            @else
                            <option value="{{$item->name_olt}}">{{$item->name_olt}}</option>

                            @endif
                            @endforeach
                        </select>

                        @error('olt')
                        <div class="text-muted">{{$message}}</div>
                        @enderror

                    </div>

                    <div class="form-group col-md-3">
                        <label for="node" class="font-weight-bold">Node (Area OLT)</label>
                        <input type="text" name="node" value="{{old('node') ? old('node') : $data->node}}"
                            placeholder="ex:H01N15" class="form-control @error('node') is-invalid @enderror">

                        @error('node')
                        <div class="text-muted">{{$error}}</div>
                        @enderror
                    </div>


                    <div class="form-group col-md-2">
                        <label for="tanggal_regis" class="font-weight-bold">Registration Date</label>
                        <input type="date" value="{{$data->tanggal_regis}}" name="tanggal_regis"
                            placeholder="Tanggal Registrasi" class="form-control" required>

                    </div>

                    <div class="form-group col-md-2">
                        <label for="fsan" class="font-weight-bold">Old FSAN User</label>
                        <input type="text" name="old_fsan" value="{{$data->fsan}}" readonly class="form-control">


                    </div>


                    <div class="form-group col-md-2">
                        <label for="fsan" class="font-weight-bold">FSAN User</label>
                        <input type="text" name="fsan" value="{{$data->fsan}}"
                            class="form-control @error('fsan') is-invalid @enderror">

                        @error('fsan')
                        <div class="text-muted">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="speed" class="font-weight-bold">Speed User (Mb)</label>
                        <input type="number" name="speed" min="1"
                            value="{{ old('speed') ? old('speed') : $data->speed }}"
                            class="form-control @error('speed') is-invalid @enderror">

                        @error('speed')
                        <div class="text-muted">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="vlan" class="font-weight-bold">Vlan User</label>
                        <select name="vlan" class="form-control">
                            {{-- <option value="{{$data->vlan}}">{{$data->vlan}}</option>
                            <option value="">-----------------</option> --}}
                            <option value="2500" {{ $data->vlan == "2500" ? 'selected' : '' }}>2500</option>
                            <option value="2100" {{ $data->vlan == "2100" ? 'selected' : '' }}>2100</option>
                            <option value="2010" {{ $data->vlan == "2010" ? 'selected' : '' }}>2010</option>
                            <option value="2020" {{ $data->vlan == "2020" ? 'selected' : '' }}>2020</option>
                            <option value="2030" {{ $data->vlan == "2030" ? 'selected' : '' }}>2030</option>
                            <option value="2800" {{ $data->vlan == "2800" ? 'selected' : '' }}>2800</option>
                            <option value="2850" {{ $data->vlan == "2850" ? 'selected' : '' }}>2850</option>
                            <option value="2900" {{ $data->vlan == "2900" ? 'selected' : '' }}>2900</option>
                            <option value="1031" {{ $data->vlan == "1031" ? 'selected' : '' }}>1031</option>
                            <option value="2011" {{ $data->vlan == "2011" ? 'selected' : '' }}>2011</option>
                        </select>




                    </div>

                    <div class="form-group col-md-4">
                        <label for="ip" class="font-weight-bold">IP Static User</label>
                        <input type="text" name="ip" value="{{old('ip') ? old('ip') : $data->ip }}"
                            placeholder="Jika tidak ada ip static isikan 0.0.0.0"
                            class="form-control @error('ip') is-invalid @enderror">

                        @error('ip')
                        <div class="text-muted">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary rounded btn-md">Save Changes</button>

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