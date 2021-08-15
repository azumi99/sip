@extends('main/admin')
@section('title', 'Category')
@section ('content')


<form action=" " method="POST">
    {{ csrf_field() }}
    <div class="card">
        <div class="card-header">
            Detail
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="exampleFormControlInput1" class="form-label">Kategori</label>
                <input readonly name="kategori" class="form-control"  value="{{$category->name}}">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1" class="form-label">Status</label>
                <input readonly name="kategori" class="form-control" value="{{$category->status}}">
            </div>
        </div>
    </div>

    @endsection