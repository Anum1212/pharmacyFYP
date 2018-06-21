$(document).ready(function () {
    var quantitiy = 0;
    //e.preventDefault();
    $('.quantity-right-plus').click(function (e) {

        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());

        // If is not undefined

        $('#quantity').val(quantity + 10);


        // Increment

    });

    $('.quantity-left-minus').click(function (e) {
        // Stop acting like a button
        // e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());

        // If is not undefined

        // Increment
        if (quantity > 0) {
            $('#quantity').val(quantity - 10);
        }
    });
    // $.noConflict();
    $.ajaxSetup({
        headers: { 'X-CSRF-Token': $('meta[name=_token]').attr('content') }
    });



});

function fetchMediDetails(data) {
    // var data=$("#MediName").val();
    console.log(data);
    window.location.href = "medicneDetails?id=" + data + "";
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
function getMedicineInformations(data) {

    window.location.href = "getMedicineInformations?id=" + data + "";
}
function getVal() {
    var medicine=$('#search').val();
    // e.preventDefault();

    $.ajax({
        type: "GET",
        url: "storeSearhData",
        dataType: "json",
        cache: false,
        data: { name: medicine },
        success: function (data) {
            console.log(data);
        }
    });
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

    if ($('#optradio1')[0].checked) {
        console.log($("#optradio1").val());
    }
    else if ($('#optradio2')[0].checked) {
        console.log($("#optradio2").val());
    }
    else {
        alert("kindly select generic or brand");
    }

}
//quantity button

function getMedicineDetails() {
    //$('#patientCategory').empty();
    if (!$.fn.DataTable.isDataTable('#patientCategory')) {
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
    else {
        var table = $('#patientCategory').DataTable();
        table
            .clear()
            .draw();
    }
    //table.empty();
    var search = $("#search").val();
    /*if(search.length==0)
    {
      alert("provide two keywords for search");
      return false;
    }*/
    $.ajax({
        type: "GET",
        url: "fetchMedicineName",
        dataType: "json",
        cache: false,
        data: { search: search },
        success: function (data) {
            table
                .clear()
                .draw();
            console.log(data);
            var size = data.length;
            for (var i = 0; i < size; i++) {
                var row = $('<tr>')
                    .append($('<td>').html(data[i].id))
                    .append($('<td>').html(data[i].brandName))
                    .append($('<td>').html(data[i].genericName))
                    .append('<td><div style="display:inline"><button type="button" class="btn btn-primary" style="margin-right:7px" id="View" onclick=" fetchMediDetails(' + data[i].id + ')">Types</button><button type="button" class="btn btn-warning"  style="margin-right:7px" onclick=" getMedicineInformations(' + data[i].id + ')">Guidance</button><button type="button" class="btn btn-success"   onclick="searchMedicine(' + data[i].id + ')"  data-toggle="confirmation" data-placement="top" >Search</button></div><input id="delId" value=' + data[i].id + ' style="display:none"></input><input id="MediName" value=' + data[i].name + ' style="display:none"></input></td>')
                table.row.add(row);
                // t .draw() is used to remove the msg no data available message 
                table.draw();
                $('#patientCategory tbody').prepend(row);

            }
        }
    });
}