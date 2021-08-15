@extends('main/admin')
@section('title', 'Category')
@section ('content')


<form action=" {{url('category/store')}} " method="POST">
    {{ csrf_field() }}
    <div class="card">
        <div class="card-header">
            Tambah Kategori
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
                <label for="exampleFormControlInput1" class="form-label">Category</label>
                <input name="kategori" class="form-control" id="exampleFormControlInput1" placeholder="Enter Category">
            </div>
            <div class="form-group">
                <label for="status">Nama Kategori</label>
                <select name="status" class="form-control">
                    <option value="active">active</option>
                    <option value="inactive">inactive</option>
                </select>
            </div>

        </div>
        <div class="card-footer">
            <a href="{{ url('category')}}" class="btn btn-outline-info">back</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>

    @endsection