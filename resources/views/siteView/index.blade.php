@extends('layouts.siteView')

@section('body')
<div class="wrapper">
@include('includes.searchBar')
</div> {{-- Wrapper --}} 
@endsection 

@section('script')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAb86GIW2pKc-uVB8LdJrP_YKsYj7LedUo">
</script>

<script>
    $(document).ready(function () {
        $('.medicineForm').hide();
    });
</script>
<script type="text/javascript" src="{{ URL::asset('js/searchBar.js') }}"></script>
@endsection