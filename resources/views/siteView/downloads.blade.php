@extends( Auth::check()  ?  'layouts.customerDashboard' : 'layouts.pharmacistDashboard' )

@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Downloads
            </div>
            <div class="panel-body">
               <ul>
                   @if(!empty($files))
                   @foreach ($files as $file)
                       <li>
                           <a href={{ asset( 'storage/myAssets/files/'.$file->filename) }} download= {{$file->title}} >{{ $file->title }}</a>
                           <br>
                           {{ $file->description }}
                       </li>
                       <br>
                   @endforeach
                   @else
                   <h3>No Files</h3>
                   @endif
               </ul>
</div>
</div>
            </div>
        </div>
<!--/.row-->
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

