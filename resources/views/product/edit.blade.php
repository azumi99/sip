@extends('main/admin')
@section('title', 'Product')
@section ('content')

<div class="card">
    <div class="card-header">
        Detail
    </div>
    {{Form::open(['route'=>['product.update',$product->id], 'method'=>'put', 'files'=>true])}}

    <div class="card-body">
        <div class="row">
            <div class="col-md-12 text-center">
                <img width="500px" src="{{asset('storage/'.$product->image)}}" alt="">
            </div>

            <div class="col-md-6">
                {{Form::label('Category')}}
                {{Form::select('category_id', $categories,$product->category_id, ['class'=>'form-control'])}}
            </div>
            <div class="col-md-6">
                {{Form::label('SKU')}}
                {{Form::text('sku', $product->sku, ['class'=>'form-control'])}}
            </div>
            <div class="col-md-6">
                {{Form::label('Name')}}
                {{Form::text('name', $product->name, ['class'=>'form-control'])}}
            </div>
            <div class="col-md-6">
                {{Form::label('Status')}}
                {{Form::select('status', ['active'=>'active', 'inactive'=>'inactice'],$product->status, ['class'=>'form-control'])}}
            </div>
            <div class="col-md-6">
                {{Form::label('Price')}}
                {{Form::number('price', $product->price, ['class'=>'form-control'])}}
            </div>
            <div class="col-md-12">
                {{Form::label('Description')}}
                {{Form::textarea('description', $product->description, ['class'=>'form-control'])}}
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