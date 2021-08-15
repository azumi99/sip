@extends('main/admin')
@section('title', 'Product')
@section ('content')
<div class="row">
    <div class="col md 12">
        <div class="card">
            {{ Form::open(['route' => 'transaction.store', 'files' => true])}}
            <div class="card-header">
                Import Excel
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
                    <label for="">File Excel</label>
                    {{Form::file('file_excel', ['class' =>'form-control'])}}
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Import</button>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>

@endsection