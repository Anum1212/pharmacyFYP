@extends('layouts.customerDashboard')

@section('customHeaderIncludes')
<script src="{{asset('customFiles/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('customFiles/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('customFiles/js/bootstrap-confirmation.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('customFiles/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('customFiles/css/custom_app.css')}}">
<style>
div.dataTables_wrapper div.dataTables_length label {
  display:none;
}
div.dataTables_wrapper div.dataTables_filter input{
  display:none;
}
div.dataTables_wrapper div.dataTables_filter label{
    display:none;
}

</style>
<script type="text/javascript">
  $(document).ready(function() {
    var quantitiy=0;
    //e.preventDefault();
   $('.quantity-right-plus').click(function(e){
        
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());
        
        // If is not undefined
            
            $('#quantity').val(quantity + 10);

          
            // Increment
        
    });

     $('.quantity-left-minus').click(function(e){
        // Stop acting like a button
       // e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());
        
        // If is not undefined
      
            // Increment
            if(quantity>0){
            $('#quantity').val(quantity - 10);
            }
    });
    // $.noConflict();
    $.ajaxSetup({
      headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });

    
    
  });
  
function fetchMediDetails(data)
{
     // var data=$("#MediName").val();
     console.log(data);
     window.location.href="medicneDetails?id="+data+"";
     /*data="panadol";
      $.getJSON("https://clin-table-search.lhc.nlm.nih.gov/api/rxterms/v3/search?terms="+data+" &ef=STRENGTHS_AND_FORMS", function(data) {
   console.log(data[1][0]);
     console.log(data[2].STRENGTHS_AND_FORMS[0][0]);
    }); */
  /* ;*/ // or alert($(this).attr('id'));
  /*  $("#action").val("Disapprove");
    var form =$('#editUsers');
    form.submit();*/
}
function getMedicineInformations(data)
{

  window.location.href="getMedicineInformations?id="+data+"";
}
function getVal()
{
  // e.preventDefault();
  console.log($("#pref-perpage").val());
  console.log($("#search").val());
  console.log($("#pref-orderby").val());
  /*if($("input:radio[name='optradio1']").is(":checked")) {
         //write your code 
         console.log($("#optradio1").val());        
}
else if($("input:radio[name='optradio2']").is(":checked"))
{
console.log($("#optradio1").val());
}
else
{
  alert();
}*/
  
if($('#optradio1')[0].checked) {
     console.log($("#optradio1").val());
}
else if($('#optradio2')[0].checked) {
    console.log($("#optradio2").val());
} 
else
{
  alert("kindly select generic or brand");
}

}
//quantity button

function getMedicineDetails(){
  //$('#patientCategory').empty();
 if ( ! $.fn.DataTable.isDataTable( '#patientCategory' ) )
 {
  var table = $('#patientCategory').DataTable({
      responsive: true,
      "pagingType": "full_numbers",
      "lengthMenu": [5, 7, 10, 25, 50, 75, 75, 100],
      "pageLength": 10,
      "language": {
        "lengthMenu": "Display _MENU_ Records Per Page",
        "zeroRecords": "Nothing Found - Sorry",
      // "info": "Showing Page _PAGE_ of _PAGES_",
      "infoEmpty": "No Records Available",
      "infoFiltered": "(Filtered From _MAX_ Total Records)"
    },
    "processing": true
  });
}
else
{
  var table = $('#patientCategory').DataTable();
  table
    .clear()
    .draw();
}
//table.empty();
var search=$("#search").val();
/*if(search.length==0)
{
  alert("provide two keywords for search");
  return false;
}*/
    $.ajax({
      type: "GET",
      url: "fetchMedicineName",
      dataType: "json",
      cache:false,
      data:{ search : search},
      success: function(data) 
      {
        table
    .clear()
    .draw();
        console.log(data);
        var size=data.length;
        for(var i = 0; i <size; i++) 
        {
          var row = $('<tr>')
          .append($('<td>').html(data[i].id))
          .append($('<td>').html(data[i].brandName))
          .append($('<td>').html(data[i].genericName))
          .append('<td><div style="display:inline"><button type="button" class="btn btn-primary" style="margin-right:7px" id="View" onclick=" fetchMediDetails('+data[i].id+')">Types</button><button type="button" class="btn btn-warning"  style="margin-right:7px" onclick=" getMedicineInformations('+data[i].id+')">Guidance</button><button type="button" class="btn btn-success"   onclick="searchMedicine('+data[i].id+')"  data-toggle="confirmation" data-placement="top" >Search</button></div><input id="delId" value='+data[i].id+' style="display:none"></input><input id="MediName" value='+data[i].name+' style="display:none"></input></td>')  
        table.row.add(row);
          // t .draw() is used to remove the msg no data available message 
       table.draw();
          $('#patientCategory tbody').prepend(row);
        
        }
      }
    });
    }
</script>
@endsection
@section('content')




<script>
//var x = document.getElementById("demo");
window.onload=getLocation();
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
      //  x.innerHTML = "Geolocation is not supported by this browser.";
      alert("Geolocation is not supported by this browser");
    }
}

function showPosition(position) {
    //x.innerHTML = "Latitude: " + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude;
    $('#lat').val(position.coords.latitude);
     $('#lon').val( position.coords.longitude);
}
</script>

<div class="container">
  <div class="row">
    @include('partials.message')
     @include('error')
    {{-- <a href="patientCategory/create" class="btn btn-primary pull-right"> Add New Category</a> --}}
  <h3>Distance <strong>/Km</strong></h3>
    <div class="col-lg-2 " >
                                        <div class="input-group  ">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="">
                                          <span class="glyphicon glyphicon-minus"></span>
                                        </button>
                                    </span>
                                    <input type="text" id="quantity" name="quantity" class="form-control input-number" value="10" min="1" max="100">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                    </span>
                                </div>
                            </div>

    <div class="col-md-12">
      <h2>Medicine Category</h2>
        <div class="panel panel-default">
            <div class="panel-body">
     <form class="form-inline" role="form">
                <div class="form-group">
                  <label class="filter-col" style="margin-right:0;" for="pref-perpage">Categories Per Page:</label>
                  <select id="pref-perpage" class="form-control">
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option selected="selected" value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="300">300</option>
                    <option value="400">400</option>
                    <option value="500">500</option>
                    <option value="1000">1000</option>
                  </select>                                
                </div> <!-- form group [rows] -->
                <div class="form-group">
                  <label class="filter-col" style="margin-right:0;" for="pref-orderby">Filter By:</label>
                  <select id="pref-orderby" class="form-control">
                    <option val="1">Discount</option>
                    <option val="2">Location</option>
                    <option val="3">Amount</option>
                  </select>                                
                </div> <!-- form group [order by] --> 
                <div class="form-group">
                  <label class="filter-col" style="margin-right:0;" for="pref-search" >Search:</label>
                  <input type="text" class="form-control input-sm" id="search"  placeholder="Search here" onkeypress="getMedicineDetails()" >
                </div><!-- form group [search] -->


                            <!-- <button type="submit" class="btn btn-danger filter-col" >
                                <span class="glyphicon glyphicon-search"></span> Search
                              </button>  --> 
                              <form >
 {{csrf_field()}}
                                <label class="radio-inline">
                                  <input type="radio" name="optradio" id="optradio1" value="a"><b>By Name</b>
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="optradio" id="optradio2" value="b"><b>By Generic Name</b>
                                </label>
                                <button type="button" class="btn btn-danger filter-col" onclick="getVal()"   >
                                 Search
                                </button> 
                              </form>
                              
                        </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>    
              </div>
          </div>
      <form style=" display: inline-block;" method="post" action="" id="patientCategoryDel">
        {{csrf_field()}}
        {{method_field('DELETE')}}
      </form>
      <table class="table table-striped" id="patientCategory">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Generic</th>
            <th>Action</th>

          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
<form name="searchMedicneForm" id="searchMedicneForm"  method="post" action="searchAskMed" />
{{ csrf_field() }}
<input type="hidden" name="medId" id="medId" />
<input type="hidden" name="distance" id="distance" />
<input type="hidden" name="lat" id="lat" />
<input type="hidden" name="lon" id="lon" />
</form>
<script>
   function ConfirmDelete()
    {
      var x = confirm("Are you sure you want to delete?");
      if (x)
         delOperation();
      else
        return ("False");
    }
/*function del()
{
  console.log("call");
  $('[data-toggle=confirmation]').confirmation({
    title: 'Are you sure to delete record??',
    rootSelector: '[data-toggle=confirmation]',
    btnOkIcon: '',
    btnOkClass: 'btn btn-danger',
    btnCancelIcon: '',
    btnCancelClass: 'btn btn-success',
    onConfirm: function() {
      delOperation();
    },
    onCancel: function() {
      console.log('Deleted rejected');
    }
  }); 
}*/
function searchMedicine(data)
{
 // alert(data);
  $('#medId').val(data);
  $('#distance').val($('#quantity').val());
  var form =$('#searchMedicneForm');
  //form.attr('action','patientCategory/id='+data+'&''distance='+$('#quantity').val()+'');
  form.submit();
  //alert($('#quantity').val());
  //alert(data);
}
function delOperation()
{
  var Id=$('#delId').val();
  var form =$('#patientCategoryDel');
  form.attr('action','patientCategory/'+Id+'');
  form.submit();
}
</script> 
@endsection
