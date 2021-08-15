@extends('main/admin')
@section('title', 'Product')
@section ('content')

<div class="card">
    <div class="card-header">
        Create
    </div>
    {{Form::open(['route'=>'product.store', 'files'=>true])}}
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
        <div class="row">
            <div class="col-md-6">
                {{Form::label('Category')}}
                {{Form::select('category_id', $categories, null, ['class'=>'form-control'])}}
            </div>
            <div class="col-md-6">
                {{Form::label('SKU')}}
                {{Form::text('sku', null, ['class'=>'form-control'])}}
            </div>
            <div class="col-md-6">
                {{Form::label('Name')}}
                {{Form::text('name', null, ['class'=>'form-control'])}}
            </div>
            <div class="col-md-6">
                {{Form::label('Status')}}
                {{Form::select('status', ['active'=>'active', 'inactive'=>'inactice'], 'active', ['class'=>'form-control'])}}
            </div>
            <div class="col-md-6">
                {{Form::label('Price')}}
                {{Form::number('price', null, ['class'=>'form-control'])}}
            </div>
            <div class="col-md-6">
                {{Form::label('Image')}}
                {{Form::file('image',['class'=>'form-control'])}}
            </div>
            <div class="col-md-12">
                {{Form::label('Description')}}
                {{Form::textarea('description', null, ['class'=>'form-control'])}}
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ url('product')}}" class="btn btn-outline-info">back</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
    {{Form::close()}}
</div>



@endsection