@extends('main/admin')
@section('title', 'Category')
@section ('content')

<form action=" {{url('category/update/'. $category->id)}} " method="POST">
    {{ csrf_field() }}
    <div class="card">
        <div class="card-header">
           Edit
        </div>
        <div class="card-body">
            @if (!empty($errors->all()))
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="form-group">
                <label for="exampleFormControlInput1" class="form-label">Kategori</label>
                <input name="kategori" class="form-control" value="{{$category->name}}">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control">
                    <option {{$category->status == 'active' ? 'selected' : ''}} value="active">active</option>
                    <option {{$category->status == 'inactive' ? 'selected' : ''}} value="inactive">inactive</option>
                </select>
            </div>

        </div>
        <div class="card-footer">
            <a href="{{ url('category')}}" class="btn btn-outline-info">back</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>


    @endsection