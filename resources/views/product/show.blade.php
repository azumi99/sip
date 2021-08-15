@extends('main/admin')
@section('title', 'Product')
@section ('content')

<div class="card">
    <div class="card-header">
        Detail
    </div>
    {{Form::open(['route'=>'product.store', 'files'=>true])}}
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 text-center">
                <img width="500px" src="{{asset('storage/'.$product->image)}}" alt="">
            </div>

            <div class="col-md-6">
                {{Form::label('Category')}}
                {{Form::text('category_id', $product->category_name, ['class'=>'form-control', 'readonly'])}}
            </div>
            <div class="col-md-6">
                {{Form::label('SKU')}}
                {{Form::text('sku', $product->sku, ['class'=>'form-control', 'readonly'])}}
            </div>
            <div class="col-md-6">
                {{Form::label('Name')}}
                {{Form::text('name', $product->name, ['class'=>'form-control', 'readonly'])}}
            </div>
            <div class="col-md-6">
                {{Form::label('Status')}}
                {{Form::text('status', $product->status, ['class'=>'form-control', 'readonly'])}}
            </div>
            <div class="col-md-6">
                {{Form::label('Price')}}
                {{Form::number('price', $product->price, ['class'=>'form-control', 'readonly'])}}
            </div>
            <div class="col-md-12">
                {{Form::label('Description')}}
                {{Form::textarea('description', $product->description, ['class'=>'form-control', 'readonly'])}}
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