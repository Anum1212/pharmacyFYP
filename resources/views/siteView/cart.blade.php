@extends('layouts.customerDashboard') 

@section('head')
    <link href="{{ asset('css/table.css') }}" rel="stylesheet">
@endsection

@section('activeCrumb', 'crumbNameHere') 

@section('panelHeading', 'panelHeadingHere')

@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
				@if(Cart::count()==0)
				No Items in Cart
				@else
                Your Orders ({{Cart::count()}})
                <span class="pull-right clickable panel-toggle panel-button-tab-left">
                    <em class="fa fa-toggle-up"></em>
                </span>
            </div>
            <div class="panel-body">
<form action="/updateCart" method="post">
					{{csrf_field()}}
					<table>
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Product</th>
								<th scope="col">Seller</th>
								<th scope="col">Price</th>
								<th scope="col">Prescription</th>
								<th scope="col">Quantity</th>
								<th scope="col">Subtotal</th>
								<th scope="col">Remove</th>
							</tr>
						</thead>
						<tbody>
							<?php
    $i=1;
	?>
								@foreach(Cart::content() as $row)
								<tr>
									<td data-label="#">{{$i}}</td>
									<td data-label="Product">{{$row->name}}</td>
									<td data-label="Seller">
										<a href="{{'/pharmacyDetails/'.$row->options->pharmacistId}}">{{$row->options->pharmacistName}}</td>
									<td data-label="Price">{{$row->price}}</td>
									@if($row->options->prescription==0)
                						<!-- 0 = Not Required -->
                						<td data-label="prescription">Not Required</td>
                						@elseif($row->options->prescription==1)
                						<!-- 1 = Required -->
                						<td data-label="prescription">Required</td>
                					@endif
									<td data-label="Quantity">
										<input type="number" name="qty[]" max="99" min="1" maxlength="2" value="{{$row->qty}}" />
									</td>
									<td data-label="Subtotal">{{$row->total}}</td>
									<td data-label="Remove">
										<a href="{{'/removeFromCart/'.$row->rowId}}">
											<i class="fa fa-trash" style="color:red"></i>
										</a>
									</td>
								</tr>
								<?php
      $i++;
      ?>
									@endforeach

									<tr>
										<td>
											<b>Total</b>
										</td>
										<td colspan="7">{{Cart::total()}}</td>
									</tr>

									<tr>
										{{-- <td colspan="2">
											<a href="/" class="btn btn-warning btn-block">
												<i class="fa fa-caret-left"></i> Continue Shopping</a>
										</td> --}}
										<td colspan="4">
											<button type="submit" class="btn btn-info btn-block">
												<i class="fa fa-refresh"></i> UpdateCart</button>
										</td>
										<td colspan="4">
											<a href="{{'/prescriptionUploadForm'}}" class="btn btn-success btn-block">Checkout
												<i class="fa fa-caret-right"></i>
											</a>
										</td>
									</tr>
						</tbody>
					</table>
				</form>
            </div>
        </div>
    </div>
</div>
<!--/.row-->
@endif
@endsection