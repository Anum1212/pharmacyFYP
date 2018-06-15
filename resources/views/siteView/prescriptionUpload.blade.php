@extends('layouts.customerDashboard') @section('head')

<style>
	.abcd img {
		height: 250px;
		width: 250px;
		padding: 5px;
		border: 1px solid #e8debd;
		margin-bottom: 15px;
	}
</style>

@endsection @section('body')


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
				<form enctype="multipart/form-data" action="prescriptionUpload" method="post">
					{{csrf_field()}}
					<div id="filediv">
						<div class="myDiv row">
						</div>
					</div>
					<div class="text-center">
					<input type="button" id="add_more" class="upload btn btn-primary" value="Add More Files" />
					<input type="submit" value="Upload File" name="submit" id="upload" class="upload btn btn-primary" />
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--/.row-->
@endsection @section('script')
<script>
	var abc = 0; // Declaring and defining global increment variable.
	$(document).ready(function () {
		//  To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
		$('#add_more').click(function () {
			$(this).before($("<div/>", {
				id: 'filediv'
			}).fadeIn('slow').append($("<input/>", {
				name: 'file[]',
				type: 'file',
				id: 'file'
			})));
		});
		// Following function will executes on change event of file input to select different file.
		$('body').on('change', '#file', function (e) {
			if (this.files && this.files[0]) {
				abc += 1; // Incrementing global variable by 1.
				var z = abc - 1;
				var x = $(this).parent().find('#previewimg' + z).remove();
				$(this).before("<div id='abcd" + abc +
					"' class='abcd col-lg-4 col-md-4 col-sm-4 col-xs-12'><img id='previewimg" + abc + "' src=''/></div></div>");
				var reader = new FileReader();
				reader.onload = imageIsLoaded;
				reader.readAsDataURL(this.files[0]);
				$(this).hide();
				$("#abcd" + abc).append($('<p>' + e.target.files[0].name + '</p>'), $(
					'<button class="btn btn-warning">Delete</button><br><br><br><br>').click(function () {
					$(this).parent().parent().remove();
				}));
			}
		});
		// To Preview Image
		function imageIsLoaded(e) {
			$('#previewimg' + abc).attr('src', e.target.result);
		};
		$('#upload').click(function (e) {
			var name = $(":file").val();
			if (!name) {
				alert("First Image Must Be Selected");
				e.preventDefault();
			}
		});
	});
</script>
@endsection