@extends('layouts.default')

@section('title', 'Edit Logbook Network Weekly')

@section('content')
<div class="container">


    <div class="card bg-light ">
        <div class="card-header">
            <h3>Edit Logbook Weekly</h3>
        </div>
        <div class="card-body">
            <form action="{{route('logbook-network-weekly.update', $category->id)}}" method="post" id="submit-form">
                @method("PUT")
                @csrf

                <div class="form-group">
                    <label for="cid">Category of Logbook</label>
                    <input type="text" required value="{{$category->nama}}" name="nama" class="form-control">
                </div>
                <div class="form-group">
                    @if ($category->parent_id == null)
                    <input type="hidden" name="parent_id" value="">
                    @else
                    <label for="parent_id">Sub Category / Description</label>
                    <select name="parent_id" class="form-control">
                        <option value=""><b>To Make Category</b>
                        </option>
                        @foreach ($categories as $item)
                        <option value="{{$item->id}}" @if ($item->id == $category->parent_id)
                            selected="selected"
                            @endif>
                            {{$item->nama}}
                        </option>
                        @endforeach
                    </select>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary rounded btn-md" id="save-button">Save
                        Changes</button>
                    <a href="{{route('logbook-network-weekly.index')}}" class="btn btn-secondary  float-right">Back</a>

                </div>

            </form>
        </div>
    </div>
</div>
@endsection