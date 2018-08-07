@if (session()->has('message'))
	<div class="alert alert-success" style="text-align: center; margin-top: 15px;">
		<button type="button" class="close" data-dismiss="alert">×</button>
		{{session()->get('message')}}
	</div>
@endif
