@extends('layouts.customerDashboard') @section('body')


<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Upload Prescription
				<span class="pull-right clickable panel-toggle panel-button-tab-left">
					<em class="fa fa-toggle-up"></em>
				</span>
			</div>
			<div class="panel-body">
				Upload <span style="color:red">'jpg', 'jpeg', 'png', 'gif'</span> file only. <span style="color:red">size > 10Mb</span>
				<br>
				<br>
				<br>
				<form enctype="multipart/form-data" action="prescriptionUpload/{{ $deliveryDate }}" method="post">
					{{csrf_field()}}

					<div class="form-group">
						<div class="imageupload">
							<div class="file-tab">
								<label class="btn">
									<span style="display:none">Browse</span>
									<!-- The file is stored here. -->
									<input type="file" name="imageFile" required>
								</label>
								<button type="button" class="btn btn-default">Remove</button>
							</div>
						</div>
					</div>
					<div class="form-group">
							<button type="submit" class="btn btn-primary">
								Upload Prescription
							</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
<!--/.row-->
@endsection @section('script')
<script src="{{ asset('js/bootstrap-imageupload.js') }}"></script>
<script>
	// Image Upload
	var $imageupload = $('.imageupload');
	$imageupload.imageupload();
</script>
@endsection