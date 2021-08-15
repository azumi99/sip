@extends('main/admin')
@section('title', 'Category')
@section ('content')


<div class="card">
    <div class="card-header">
        Categories
        <a href="{{url('category/create')}}" class="btn btn-primary btn-lx float-right"><i class="fas fa-plus float-right"></i></a>
    </div>
    <div class="card-body">
        @if (Session::has('message'))
        <div class="alert alert-success">
            {{Session::get('message')}}
        </div>
        @endif
        <table class="table table-bordered">
            <thead>     
              <tr class="text-center">
                <th scope="col">no</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($category as $key=> $value)
            <tr>
                <td class="text-center">{{ $key+1}}</td>
                <td>{{$value->name}}</td>
                <td>{{$value->status}}</td>
                <td style="text-align: center">
                    <form action="{{url('category/delete/'. $value->id)}}" method="post">
                        <input type="hidden" name="_method" value="delete">
                        @csrf
                    <a href="{{url('category/show/'. $value->id)}}" class="btn btn-primary "><i class="fas fa-eye"></i></a>
                    <a href="{{url('category/edit/'. $value->id)}}"  class="btn btn-success"><i class="fas fa-pen-square"></i></a>
                    
                    <button type="submit" onclick="return confirm('Apakah anda ingin menghapus data ini?')" class="btn btn-danger"><i class="far fa-trash-alt"></i></button></form>
                </td>
            </tr>
            @endforeach
            </tbody>
          </table>
       
    </div>
</div>
@endsection