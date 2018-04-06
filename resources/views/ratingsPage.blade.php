@extends('layouts.siteView')

@section('style')
  <style>

  @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

fieldset, label { margin: 0; padding: 0; }
body{ margin: 20px; }
h1 { font-size: 1.5em; margin: 10px; }

/****** Style Star Rating Widget *****/

.rating {
  border: none;
  float: left;
}

.rating > input { display: none; }
.rating > label:before {
  margin: 5px;
  font-size: 1.25em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating > .half:before {
  content: "\f089";
  position: absolute;
}

.rating > label {
  color: #ddd;
 float: right;
}

/***** CSS Magic to Highlight Stars on Hover *****/

.rating > input:checked ~ label, /* show gold star when clicked */
.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { color: #FFED85;  }

  </style>
@endsection



@section('body')
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Pharamacy Ratings</div>

                <div class="panel-body">
{{-- if $pharmacyRatings variable is not empty  --}}
@if(!empty($pharmacyRatings))
{{-- setting value of i for using in form --}}
{{-- this variable will be used in form input id to get unique input id for each form set --}}
<?php $i = '0'; ?>
                  @foreach ($pharmacyRatings as $pharmacyRating)
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

{{-- pharmacy name --}}
                  <div id="pharamacyName" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    {{$pharmacyRating->pharmacyName}}
                  </div>

{{-- pharmacy current rating --}}
                  <div id="pharamacyRating" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    {{$pharmacyRating->rating}}/5
                  </div>

{{-- stars so user can rate --}}
                  <div id="userRating" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="stars">
  <form action="ratePharmacy/{{$pharmacyRating->id}}" method="post">

    {{ csrf_field() }}

    <fieldset class="rating">
    <input onChange="this.form.submit();" type="radio" id="star5-{{$i}}" name="rating" value="5" /><label class = "full" for="star5-{{$i}}" title="Awesome - 5 stars"></label>
    <input onChange="this.form.submit();" type="radio" id="star4half-{{$i}}" name="rating" value="4.5" /><label class="half" for="star4half-{{$i}}" title="Pretty good - 4.5 stars"></label>
    <input onChange="this.form.submit();" type="radio" id="star4-{{$i}}" name="rating" value="4" /><label class = "full" for="star4-{{$i}}" title="Pretty good - 4 stars"></label>
    <input onChange="this.form.submit();" type="radio" id="star3half-{{$i}}" name="rating" value="3.5" /><label class="half" for="star3half-{{$i}}" title="Meh - 3.5 stars"></label>
    <input onChange="this.form.submit();" type="radio" id="star3-{{$i}}" name="rating" value="3" /><label class = "full" for="star3-{{$i}}" title="Meh - 3 stars"></label>
    <input onChange="this.form.submit();" type="radio" id="star2half-{{$i}}" name="rating" value="2.5" /><label class="half" for="star2half-{{$i}}" title="Kinda bad - 2.5 stars"></label>
    <input onChange="this.form.submit();" type="radio" id="star2-{{$i}}" name="rating" value="2" /><label class = "full" for="star2-{{$i}}" title="Kinda bad - 2 stars"></label>
    <input onChange="this.form.submit();" type="radio" id="star1half-{{$i}}" name="rating" value="1.5" /><label class="half" for="star1half-{{$i}}" title="Meh - 1.5 stars"></label>
    <input onChange="this.form.submit();" type="radio" id="star1-{{$i}}" name="rating" value="1" /><label class = "full" for="star1-{{$i}}" title="Sucks big time - 1 star"></label>
    <input onChange="this.form.submit();" type="radio" id="starhalf-{{$i}}" name="rating" value="0.5" /><label class="half" for="starhalf-{{$i}}" title="Sucks big time - 0.5 stars"></label>
</fieldset>

  </form>
</div>
</div>
                  </div>
{{-- incrementing value of i after each element is printed so that next form inputs have unique name --}}
                  <?php $i++; ?>
                @endforeach
{{-- if $pharmacyRatings variable is empty  --}}
@else
  no pharmacies yet
@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
