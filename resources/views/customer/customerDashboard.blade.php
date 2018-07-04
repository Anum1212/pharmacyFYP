@extends('layouts.customerDashboard')

@section('body')
<div class="row">
{{-- Gap --}}
<div class="col-lg-12" style="margin-top:25px">
          </div>

  {{-- Number of Orders Users Panel--}}
			<div class="col-lg-12">
				<div class="panel panel-default">
			<div class="row">
				<div class="col-xs-6 col-md-6 col-lg-6 no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-shopping-cart color-blue"></em>
							<div class="large">{{ $newOrders }}</div>
							<div class="text-muted">New Orders</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-6 col-lg-6 no-padding">
					<div class="panel panel-blue panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-shopping-cart color-orange"></em>
							<div class="large">{{ $totalOrders }}</div>
							<div class="text-muted">Total Orders</div>
						</div>
					</div>
				</div>
			</div><!--/.row-->
				</div>
      </div>
</div>
<!--/.row-->
@endsection