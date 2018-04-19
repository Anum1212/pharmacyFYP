@extends('layouts.siteView') @section('style')

<style media="screen">
	.table>tbody>tr>td,
	.table>tfoot>tr>td {
		vertical-align: middle;
	}

	@media screen and (max-width: 600px) {
		table#cart tbody td .form-control {
			width: 20%;
			display: inline !important;
		}
		.actions .btn {
			width: 36%;
			margin: 1.5em 0;
		}

		.actions .btn-info {
			float: left;
		}
		.actions .btn-danger {
			float: right;
		}

		table#cart thead {
			display: none;
		}
		table#cart tbody td {
			display: block;
			padding: .6rem;
			min-width: 320px;
		}
		table#cart tbody tr td:first-child {
			background: #333;
			color: #fff;
		}
		table#cart tbody td:before {
			content: attr(data-th);
			font-weight: bold;
			display: inline-block;
			width: 8rem;
		}



		table#cart tfoot td {
			display: block;
		}
		table#cart tfoot td .btn {
			display: block;
		}

	}
</style>

@endsection @section('body')
<div class="container col-md-7" id="myWrapper">
	<div class="row">
		<div class="container col-md-6 col-md-offset-2" id="myWrapper3">
			<form action="/updateCart" method="post">
				<table id="cart" class="table table-hover table-condensed">
					<thead>
						<tr>
							<th style="width:50%">Product</th>
							<th style="width:50%">Seller</th>
							<th style="width:10%">Price</th>
							<th style="width:8%">Quantity</th>
							<th style="width:22%" class="text-center">Subtotal</th>
							<th style="width:10%"></th>
						</tr>
					</thead>
					<tbody>
						@foreach(Cart::content() as $row)
						<tr>
							<td data-th="Product">
								<div class="row">

									<h4 class="nomargin">{{$row->name}}</h4>
								</div>
		</div>
		</td>
		<td data-th="Seller">
			<h4 class="nomargin">
				<a href="{{'/pharmacyDetails/'.$row->options->pharmacistId}}">{{$row->options->pharmacistName}}</h4>
	</div>
	</td>
	<td data-th="Price">{{$row->price}}</td>
	<td data-th="Quantity">
		{{csrf_field()}}
		<input type="number" name="qty[]" max="99" min="1" maxlength="2" value="{{$row->qty}}" />
	</td>
	<td data-th="Subtotal" class="text-center">{{$row->total}}</td>

	</td>
	</tr>
	@endforeach
	</tbody>
	<tfoot>
		<tr class="visible-xs">
			<td class="text-center">
				<strong>Total {{Cart::total()}}</strong>
			</td>
		</tr>
		<tr>
			<td class="hidden-xs text-center">
				<strong>Total</strong>
			</td>
			<td colspan="2" class="hidden-xs"></td>
			<td class="hidden-xs text-center">
				<strong>{{Cart::total()}}</strong>
			</td>
		</tr>

		<tr>
			<td>
				<a href="/" class="btn btn-warning">
					<i class="fa fa-angle-left"></i> Continue Shopping</a>
			</td>
			<td>
				<button type="submit" class="btn btn-info btn-block">
					<i class="fa fa-refresh"></i> UpdateCart</button>
			</td>
			<td>
				<a href="{{'/CheckOutCart'}}" class="btn btn-success btn-block">Checkout
					<i class="fa fa-angle-right"></i>
				</a>
			</td>
			<td colspan="1" class="hidden-xs"></td>

		</tr>
	</tfoot>
	</table>
	</form>
</div>

<div class="container col-md-2" id="myWrapper4">
	<table id="cart" class="table table-hover table-condensed">
		<thead>
			<tr>
				<th style="width:10%">Remove</th>
			</tr>
		</thead>
		<tbody>
			@foreach(Cart::content() as $row)
			<tr style="height:50px;">
				<td data-th="Remove">
					<form action="{{'/removeFromCart/'.$row->rowId}}" method="post">
						{{csrf_field()}} {{method_field('DELETE')}}
						<button class="btn btn-danger btn-sm">
							<i class="fa fa-trash-o"></i>
						</button>
					</form>
				</td>
			</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<td colspan="2" class="hidden-xs"></td>
			</tr>
		</tfoot>
	</table>
</div>
</div>
</div>
@endsection