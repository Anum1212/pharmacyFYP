  <!-- register Modal -->
  <div class="modal" id="notifyModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
                <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Notify when available</h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
           <form class="form-horizontal" role="form" method="get" action="setAvailabilityNotification">

                    <div class="form-group">
                        <label for="email" class="col-md-5 control-label">E-Mail Address</label>
                        <div>
                            <input id="email" type="email" class="form-control" name="email" required> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="medicineName" class="col-md-5 control-label">Medicine Name</label>
                        <div>
                            <input id="medicineName" type="text" class="form-control" name="medicineName" @if(session()->has('medicineSearched')) value="{{ session('medicineSearched') }}" @endif required> 
                        </div>
                    </div>

                    <div class="pull-right">
                            <button class="btn btn-primary" type="submit">Get Notified</button>
                    </div>

                </form>
        </div>
        
      </div>
    </div>
  </div>