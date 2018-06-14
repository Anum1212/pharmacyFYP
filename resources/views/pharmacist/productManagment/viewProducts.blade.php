@extends('layouts.pharmacistDashboard')

@section('panelHeading', 'panelHeadingHere')

@section('body')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Products ({{$totalProducts}})
                <span class="pull-right clickable panel-toggle panel-button-tab-left">
                    <em class="fa fa-toggle-up"></em>
                </span>
            </div>
            <div class="panel-body">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Dosage</th>
                            <th scope="col">Type</th>
                            <th scope="col">Prescription</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td data-label="#">{{ (($products->currentPage() - 1 ) * $products->perPage() ) + $loop->iteration }}</td>
                            <td data-label="Name">{{$product->name}}</td>
                            <td data-label="Dosage">{{$product->dosage}}</td>
                            @if($product->type=='1')
                            <!-- 1 = Tablet -->
                            <td data-label="Type">Tablet</td>
                            @elseif($product->type=='2')
                            <!-- 2 = Capsule -->
                            <td data-label="Type">Capsule</td>
                            @elseif($product->type=='3')
                            <!-- 3 = Syrup -->
                            <td data-label="Type">Syrup</td>
                            @elseif($product->type=='4')
                            <!-- 4 = Inhaler -->
                            <td data-label="Type">Inhaler</td>
                            @elseif($product->type=='5')
                            <!-- 5 = Drops -->
                            <td data-label="Type">Drops</td>
                            @elseif($product->type=='6')
                            <!-- 6 = Injection -->
                            <td data-label="Type">Injection</td>
                            @elseif($product->type=='7')
                            <!-- 7 = Cream -->
                            <td data-label="Type">Cream</td>
                            @endif @if($product->prescription=='0')
                            <!-- 0 = Not Required -->
                            <td data-label="prescription">Not Required</td>
                            @elseif($product->prescription=='1')
                            <!-- 1 = Required -->
                            <td data-label="Type">Required</td>
                            @endif
                            <td data-label="Price">{{$product->price}}</td>
                            <td data-label="Quantity">{{$product->quantity}}</td>
                            <td data-label="Edit">
                                <a class="btn btn-success" href="editProduct/{{$product->id}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            <td data-label="Delete">
                                <form class="confirm" action="/pharmacist/deleteProduct/{{$product->id}}" method="post">
                                    {{csrf_field()}} {{method_field('DELETE')}}
                                    <button class="btn btn-danger" type="submit">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
<!--/.row-->

@endsection