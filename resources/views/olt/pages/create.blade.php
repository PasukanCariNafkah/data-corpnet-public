@extends('layouts.default')

@section('title', 'Add OLT')

@section('content')
<div class="container">


    <div class="card border-o shadow rounded ">

        <div class="card-body">
            <form action="{{ route('olt.store') }}" method="post">
                @method('POST')
                @csrf
                <div class="form-row">

                    <div class="form-group col-md-4">

                    </div>
                    <div class="form-group col-md-4">
                        <label for="name_olt" class="font-weight-bold">Name OLT</label>
                        <input type="text" name="name_olt" value="{{old('name_olt')}}"
                            class="form-control @error('name_olt') is-invalid @enderror">

                        @error('name_olt')
                        <div class="text-muted">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">

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