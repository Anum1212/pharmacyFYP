@if (session()->has('error'))
	<div class="alert alert-danger" style="text-align: center; margin-top: 65px;">
		<button type="button" class="close" data-dismiss="alert">×</button>
		{!! session()->get('error') !!}
	</div>
@endif

<script>
	$('div.alert').delay(5000).slideUp(300);
</script>