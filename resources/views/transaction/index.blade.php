@extends('main/admin')
@section('title', 'Product')
@section ('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Transaction
                <a href="{{route('transaction.create')}}" class="btn btn-primary btn-xs float-right" ><i class="fas fa-plus"></i></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered">
                        <thead>     
                          <tr class="text-center">
                            <th>No</th>
                            <th>Product</th>
                            <th>Date</th>
                            <th>Price</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaction as $key=>$item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->product_name}}</td>
                                <td>{{$item->trx_date}}</td>
                                <td>{{$item->price}}</td>
                            </tr>
                            @endforeach
                           
                        </tbody>
                      </table>
                      <div class="row">
                        <div class="col-md-12">
                           
                        </div>
                      </div>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection