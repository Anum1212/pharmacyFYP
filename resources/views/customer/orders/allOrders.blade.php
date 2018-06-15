@extends('layouts.customerDashboard') 

@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Your Orders ({{$totalOrders}})
                <span class="pull-right clickable panel-toggle panel-button-tab-left">
                    <em class="fa fa-toggle-up"></em>
                </span>
            </div>
            <div class="panel-body">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Price</th>
                            <th scope="col">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td data-label="#">{{ (($orders->currentPage() - 1 ) * $orders->perPage() ) + $loop->iteration }}</td>
                            <td data-label="order date">{{$order->created_at}}</td>
                            <td data-label="price">{{$order->cost}}</td>
                            <td data-label="View">
                                <a href="viewSpecificOrder/{{$order->id}}">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
<!--/.row-->
@endsection