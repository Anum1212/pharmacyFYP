function ConfirmDelete() {
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
function searchMedicine(data) {
    // alert(data);
    $('#medId').val(data);
    $('#distance').val($('#quantity').val());
    var form = $('#searchMedicneForm');
    //form.attr('action','patientCategory/id='+data+'&''distance='+$('#quantity').val()+'');
    form.submit();
    //alert($('#quantity').val());
    //alert(data);
}
function delOperation() {
    var Id = $('#delId').val();
    var form = $('#patientCategoryDel');
    form.attr('action', 'patientCategory/' + Id + '');
    form.submit();
}