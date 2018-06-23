@if (session()->has('error'))
	<div class="alert alert-danger" style="text-align: center; margin-top: 65px;">
		<button type="button" class="close" data-dismiss="alert">×</button>
		{!! session()->get('error') !!}
	</div>
@endif
