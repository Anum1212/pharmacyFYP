@extends('layouts.pharmacistDashboard')

  @section('head')
 <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
 
@endsection
@section('body')

<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						Most Searched Medicine
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<div id="chartContainer" style="height: 370px; width:auto; margin: 0px auto;"></div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->		
@endsection


@section('script')
 <script>
window.onload = function () {

    // set chart colors
    CanvasJS.addColorSet("greenShades", [ //colorSet Array
      "#EDEDED",
      "#D6EDFF",
    ]);

    $.noConflict();
    //Better to construct options first and then pass it as a parameter
    var options = {
        colorSet: "greenShades",
        // cset grid line color
        axisY: {
          gridColor: "#e5eae7",
          lineColor: "#e5eae7",
          lineThickness: 2,
          labelFontColor: "#A9A9A9",
          labelFontWeight: "bold",
        },
        axisX: {
          lineColor: "#e5eae7",
          lineThickness: 2,
          labelFontColor: "#30A5FF",
          labelFontWeight: "bold",
        },
        toolTip: {
          fontColor: "#30A5FF",
        },
        animationEnabled: true,
        // exportEnabled: true,
        //ok loop is not wroking we will get all 10 data from db and use if and else
        data: [{
            type: "column",
            dataPoints: [
              @if(isset($medicines[0]->name))
                { label: "{{$medicines[0]->name}}", y: {{$medicines[0]->total or 0}} },
                @endif
              @if(isset($medicines[1]->name))
                { label: "{{$medicines[1]->name}}", y: {{$medicines[1]->total or 0}} },
                @endif
                @if(isset($medicines[2]->name))
                { label: "{{$medicines[2]->name}}", y: {{$medicines[2]->total or 0}} },
                @endif
                @if(isset($medicines[3]->name))
                { label: "{{$medicines[3]->name}}", y: {{$medicines[3]->total or 0}} },
                @endif
                @if(isset($medicines[4]->name))
                { label: "{{$medicines[4]->name}}", y: {{$medicines[4]->total or 0}} },
                @endif
                @if(isset($medicines[5]->name))
                { label: "{{$medicines[5]->name}}", y: {{$medicines[5]->total or 0}} },
                @endif
                @if(isset($medicines[6]->name))
                { label: "{{$medicines[6]->name}}", y: {{$medicines[6]->total or 0}} },
                @endif
                @if(isset($medicines[7]->name))
                { label: "{{$medicines[7]->name}}", y: {{$medicines[7]->total or 0}} },
                @endif
                @if(isset($medicines[8]->name))
                { label: "{{$medicines[8]->name}}", y: {{$medicines[8]->total or 0}} },
                @endif
                 @if(isset($medicines[9]->name))
                { label: "{{$medicines[9]->name}}", y: {{$medicines[9]->total or 0}} },
                @endif
            ]
        }
        ]
};
$("#chartContainer").CanvasJSChart(options);
}
</script>
@endsection