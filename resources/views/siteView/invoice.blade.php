@extends('layouts.customerDashboard') @section('head')
<link href="{{ asset('css/siteView/invoice.css') }}" rel="stylesheet"> @endsection @section('panelHeading', 'panelHeadingHere') @section('body')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Order Invoice
				<span class="pull-right clickable panel-toggle panel-button-tab-left">
					<em class="fa fa-toggle-up"></em>
				</span>
			</div>
			<div class="panel-body">
					<div class="row">
						<div class="col-xs-12">
							<div class="row">
								<div class="col-xs-6">
									<address>
										<strong>Billed To:</strong>
										<br> {{$customerDetails->name}}
										<br> {{$customerDetails->address}}
										<br> {{$customerDetails->society}}
										<br> {{$customerDetails->city}}
									</address>
								</div>
								<div class="col-xs-6 text-right">
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
								<div class="col-xs-6">
									<address>
										<strong>Payment Method:</strong>
										<br> Cash on Delivery
									</address>
								</div>
								<div class="col-xs-6 text-right">
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
						<div class="col-md-12">
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
												@for($i=0; $i
												<count($product); $i++) <tr>
													<td>{{$product[$i]->name}}</td>
													@if($product[$i]->type=='1')
													<!-- 1 = Tablet -->
													<td class="title">Tablet</td>
													@elseif($product[$i]->type=='2')
													<!-- 2 = Capsule -->
													<td class="title">Capsule </td>
													@elseif($product[$i]->type=='3')
													<!-- 3 = Syrup -->
													<td class="title">Syrup</td>
													@elseif($product[$i]->type=='4')
													<!-- 4 = Inhaler -->
													<td class="title">Inhaler</td>
													@elseif($product[$i]->type=='5')
													<!-- 5 = Drops -->
													<td class="title">Drops
														</> @elseif($product[$i]->type=='6')
														<!-- 6 = Injection -->
														<td class="title">Injection
															</> @elseif($product[$i]->type=='7')
															<!-- 7 = Cream -->
															<td class="title">Cream</td>
															@endif
															<td class="text-center">{{$product[$i]->price}}</td>
															<td class="text-center">{{$orderItems[$i]->quantity}}</td>
															<td class="text-right">{{$product[$i]->price*$orderItems[$i]->quantity}}</td>
															</tr>

															@endfor


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
		</div>
	</div>
</div>
<!--/.row-->

@endsection