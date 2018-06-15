@extends('layouts.pharmacistDashboard')

@section('body')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">

				<span class="pull-right clickable panel-toggle panel-button-tab-left">
					<em class="fa fa-toggle-up"></em>
				</span>
			</div>
			<div class="panel-body">
				<form class="form-horizontal confirm" method="POST" action="/pharmacist/editAccountDetails">
					{{ csrf_field() }}
					<fieldset>
						<!-- Pharmacy Owner Name -->
						<div class="form-group">
							<label class="col-md-3 control-label" for="name">Name</label>
							<div class="col-md-9">
								<input id="name" name="name" type="text" class="form-control" value="{{ $pharmacyDetails->name }}" required>
							</div>
						</div>

						<!-- Pharmacy Email -->
						<div class="form-group">
							<label class="col-md-3 control-label" for="email">E-mail</label>
							<div class="col-md-9">
								<input id="email" name="email" type="email" class="form-control" value="{{ $pharmacyDetails->email }}" required>
							</div>
						</div>

						<!-- Pharmacy Contact -->
						<div class="form-group">
							<label class="col-md-3 control-label" for="contact">Contact#</label>
							<div class="col-md-9">
								<input id="contact" name="contact" type="text" class="form-control" minlength="11" maxlength="11" value="{{ $pharmacyDetails->contact }}"
								    required>
							</div>
						</div>

						<!-- Pharmacy Name -->
						<div class="form-group">
							<label class="col-md-3 control-label" for="pharmacyName">Pharmacy Name</label>
							<div class="col-md-9">
								<input id="pharmacyName" name="pharmacyName" type="text" class="form-control" value="{{ $pharmacyDetails->pharmacyName }}"
								    required>
							</div>
						</div>

						<!-- Pharmacy Address -->
						<div class="form-group">
							<label class="col-md-3 control-label" for="address">House#-Block</label>
							<div class="col-md-9">
								<input id="address" name="address" type="text" class="form-control" value="{{ $pharmacyDetails->address }}" required>
							</div>
						</div>

						<!-- Pharmacy Society -->
						<div class="form-group">
							<label class="col-md-3 control-label" for="society">Society</label>
							<div class="col-md-9">
								<input id="society" name="society" type="text" class="form-control" value="{{ $pharmacyDetails->society }}" required>
							</div>
						</div>

						<!-- Pharmacy City -->
						<div class="form-group">
							<label class="col-md-3 control-label" for="city">City</label>
							<div class="col-md-9">
								<input id="city" name="city" type="text" class="form-control" value="{{ $pharmacyDetails->city }}" required>
							</div>
						</div>

						{{--
						<!-- Pharmacy freeDeliveryPurchase -->
						<div class="form-group">
							<label class="col-md-3 control-label" for="freeDeliveryPurchase">Max Purchase for Free Delivery</label>
							<div class="col-md-9">
								<input id="freeDeliveryPurchase" name="freeDeliveryPurchase" type="text" class="form-control" value="{{ $pharmacyDetails->freeDeliveryPurchase }}"
								    required>
							</div>
						</div> --}}

						<!-- Form actions -->
						<div class="form-group">
							<div class="col-md-12 widget-right">
								<button type="submit" class="btn btn-default btn-md pull-right">Submit</button>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
<!--/.row-->
@endsection