@extends('layouts.adminDashboard')

@section('panelHeading', 'panelHeadingHere') 

@section('searchBar')
<form role="search" action="/admin/searchOrder" method="get" role="search">
    <div class="form-group">
        <input type="number" class="form-control" name="search" placeholder="Search for order" required>
    </div>
</form>
@endsection 

@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Orders
                <span class="pull-right clickable panel-toggle panel-button-tab-left">
                    <em class="fa fa-toggle-up"></em>
                </span>
            </div>
            <div class="panel-body">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Order#</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Cost</th>
                            <th scope="col">View</th>
                        </tr>
                    </thead>
                    @if(!empty($orders) && !empty($customers))
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td data-label="#">{{ (($orders->currentPage() - 1 ) * $orders->perPage() ) + $loop->iteration }}</td>
                            <td data-label="Order#">{{$order->id}}</td>
                            @foreach($customers as $customer) @if($customer->id == $order->userId)
                            <td data-label="Customer Name">{{$customer->name}}</td>
                            @endif @endforeach
                            <td data-label="Cost">{{$order->cost}}</td>
                            <td data-label="View">
                                <a href="/admin/viewSpecificOrder/{{$order->id}}">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
<!--/.row-->
@endsection