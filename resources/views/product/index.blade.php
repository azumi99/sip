@extends('main/admin')
@section('title', 'Product')
@section ('content')
<div class="card">
    <div class="card-header">
        Product
        <a href="{{route('product.create')}}" class="btn btn-primary btn-xs float-right" ><i class="fas fa-plus"></i></a>
        <a href="{{route('product.index')}}" class="btn btn-primary btn-xs float-right" style="margin-right: 10px!important;"><i class="fas fa-sync-alt "></i></a>
    </div>
    <div class="card-body">
        @if (Session::has('messege'))
        <div class="alert alert-success">
            {{Session::get('messege')}}
        </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Pilih Kategori</label>
                    {{Form::select('category_id',$categories , null, ['class'=>'form-control', 'placeholder'=>'Pilih Category', 'id'=>'category_id'])}}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Keyword</label>
                    {{Form::text('keyword', null, ['class'=> 'form-control', 'id'=>'keyword'])}}
                </div>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered">
            <thead>     
              <tr class="text-center">
                <th>No</th>
                <th>Category</th>
                <th>Name</th>
                <th>Price</th>
                <th>SKU</th>
                <th>Image</th>
                <th>Status</th>
                <th>Action</th>
                </tr>
              </tr>
            </thead>
            <tbody>
                @foreach ($product as $key=>$item)
                <tr>
                    <td class="text-center">{{$key + 1}}</td>
                    <td>{{$item->category_name}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->sku}}</td>
                    <td><img width="150px" src="{{asset('storage/'.$item->image)}}" alt=""></td>
                    <td>{{$item->status}}</td>
                    <td style="text-align: center">
                        <form action="{{route('product.destroy', $item->id)}}" method="post">
                            <input type="hidden" name="_method" value="delete">
                            @csrf
                        <a href="{{route('product.show', $item->id)}}" class="btn btn-primary "><i class="fas fa-eye"></i></a>
                        <a href="{{route('product.edit', $item->id)}}"  class="btn btn-success"><i class="fas fa-pen-square"></i></a>
                        
                        <button type="submit" onclick="return confirm('Apakah anda ingin menghapus data ini?')" class="btn btn-danger"><i class="far fa-trash-alt"></i></button></form>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
          <div class="row">
            <div class="col-md-12">
                {{$product->links()}}
            </div>
          </div>
        </div>
    </div>
    </div>
</div>


@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $('#category_id').on('change', function(){
            filter();
        });
        $('#keyword').keypress(function(event){
            if(event.keyCode==13){
                filter();
            }
        });
        var filter =function(){
            var catId=$('#category_id').val();
            var keyword = $('#keyword').val();

            window.location.replace("{{URL::to('product')}}?category_id="+catId+"&keyword="+keyword);
        }
    })
</script>
@endsection
