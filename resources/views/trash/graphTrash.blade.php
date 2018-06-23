
 @extends('layouts.customerDashboard')
  @section('head')
 <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
 
@endsection
@section('body')

<h1>Most search medicines</h1>
 <div id="chartContainer" style="height: 370px; max-width: 620px; margin: 0px auto;"></div>
 @section('script')
 <script>
window.onload = function () {
$.noConflict();
//Better to construct options first and then pass it as a parameter
var options = {
  title: {
    text: ""
  },

  animationEnabled: true,
  exportEnabled: true,
//ok loop is not wroking we will get all 10 data from db and use if and else
  data: [
        {
            type: "spline",
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
@endsection