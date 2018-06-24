@extends('layouts.customerDashboard')

@section('body')
<div class="row">
    {{-- Gap --}}
  <div class="col-lg-12" style="margin-top:25px">
  </div>
  {{-- weather Widget --}}
<div class="col-lg-12">
  <iframe src="https://www.meteoblue.com/en/weather/widget/three?geoloc=detect&nocurrent=0&noforecast=0&noforecast=1&days=4&tempunit=CELSIUS&windunit=KILOMETER_PER_HOUR&layout=image"  frameborder="0" scrolling="NO" allowtransparency="true" sandbox="allow-same-origin allow-scripts allow-popups allow-popups-to-escape-sandbox" style="width: 100%;height: 170px"></iframe><div></div>
</div>
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