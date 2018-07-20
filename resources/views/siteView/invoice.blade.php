@extends('layouts.siteLayout') 

@section('tabTitle', 'Invoice')

@section('head') 
<link href="{{ asset('css/siteView/invoice.css') }}" rel="stylesheet"> 
<link href="{{ asset('css/table.css') }}" rel="stylesheet"> 
@endsection 

@section('style') @endsection 
<style>
	.container{
		border:2px solid #EBEBEB; 
	}

</style>
@section('body')

<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(/themeAssets/images/invoiceBackground.jpg);">
	<h2 class=" t-center">
		Invoice
	</h2>
</section>
<!-- Cart -->
<section class="cart bgwhite p-t-70 p-b-100">
	<div class="container" style="padding:50px;">
							<div class="row">
						<div class="col-12">
							<div class="row">
								<div class="col-6">
									<address>
										<strong>Billed To:</strong>
										<br> {{$customerDetails->name}}
										<br> {{$customerDetails->address}}
										<br> {{$customerDetails->society}}
										<br> {{$customerDetails->city}}
									</address>
								</div>
								<div class="col-6 text-right">
									<address>
										<strong>Shipped To:</strong>
										<br> {{$customerDetails->name}}
										<br> {{$customerDetails->address}}
										<br> {{$customerDetails->society}}
										<br> {{$customerDetails->city}}
									</address>
								</div>
							</div>
							<div class="row">
								<div class="col-6">
									<address>
										<strong>Payment Method:</strong>
										<br> Cash on Delivery
									</address>
								</div>
								<div class="col-6 text-right">
									<address>
										<strong>Order Date:</strong>
										<br> {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y')}}
										<br>
										<br>
									</address>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="md-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">
										<strong>Order summary</strong>
									</h3>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-condensed">
											<thead>
												<tr>
													<td>
														<strong>Item</strong>
													</td>
													<td>
														<strong>Type</strong>
													</td>
													<td class="text-center">
														<strong>Price</strong>
													</td>
													<td class="text-center">
														<strong>Quantity</strong>
													</td>
													<td class="text-right">
														<strong>Totals</strong>
													</td>
												</tr>
											</thead>
											<tbody>
												@foreach ($products as $product)
												 <tr>
													<td>{{$product->name}}</td>
													@if($product->options->type=='1')
													<!-- 1 = Tablet -->
													<td class="title">Tablet</td>
													@elseif($product->options->type=='2')
													<!-- 2 = Capsule -->
													<td class="title">Capsule </td>
													@elseif($product->options->type=='3')
													<!-- 3 = Syrup -->
													<td class="title">Syrup</td>
													@elseif($product->options->type=='4')
													<!-- 4 = Inhaler -->
													<td class="title">Inhaler</td>
													@elseif($product->options->type=='5')
													<!-- 5 = Drops -->
													<td class="title">Drops
														</> @elseif($product->options->type=='6')
														<!-- 6 = Injection -->
														<td class="title">Injection
															</> @elseif($product->options->type=='7')
															<!-- 7 = Cream -->
															<td class="title">Cream</td>
															@endif
															<td class="text-center">{{$product->price}}</td>
															<td class="text-center">{{$product->qty}}</td>
															<td class="text-right">{{$product->price*$product->qty}}</td>
															</tr>

															@endforeach


															<tr>
																<td class="thick-line"></td>
																<td class="thick-line"></td>
																<td class="thick-line"></td>
																<td class="thick-line text-center">
																	<strong>Subtotal</strong>
																</td>
																<td class="thick-line text-right">{{$order->cost}}</td>
															</tr>
															<tr>
																<td class="no-line"></td>
																<td class="no-line"></td>
																<td class="no-line"></td>
																<td class="no-line text-center">
																	<strong>Total</strong>
																</td>
																<td class="no-line text-right">{{$order->cost}}</td>
															</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
	</div>
</section>
@endsection 

@section('script')

@endsection
