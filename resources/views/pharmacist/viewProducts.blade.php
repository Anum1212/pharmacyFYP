@extends('layouts.siteView')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                Name
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                Dosage
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                Type
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                Price
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                Quantity
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                Actions
            </div>
        </div>

        @foreach ($products as $product)
            
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                {{$product->name}}
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                {{$product->dosage}}
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                {{$product->type}}
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                {{$product->price}}
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                {{$product->quantity}}
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <a class="btn btn-success" href="/pharmacist/editProduct/{{$product->id}}"><i class="fa fa-edit"></i></a>
                <form action="/pharmacist/deleteProduct/{{$product->id}}" method="post">
                                    {{csrf_field()}} {{method_field('DELETE')}}
                                    <button class="btn btn-success" type="submit"><i class="fa fa-trash"></i></button>
                                </form>
            </div>
        </div>
        @endforeach
    </div>
@endsection