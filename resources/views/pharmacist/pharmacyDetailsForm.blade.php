@extends('layouts.app') @section('content') @if (session('status'))
<div class="alert alert-success">
  {{ session('status') }}
</div>
@endif

<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Enter Pharamcy Details</div>

        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="/pharmacist/savePharmacyApi">
            {{ csrf_field() }} {{-- ---------------------------- Email ----------------------------- --}}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-md-4 control-label">E-Mail Address</label>

              <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" readonly>
              </div>
            </div>

            {{-- ---------------------------- Pharmacy Name ----------------------------- --}}
            <div class="form-group{{ $errors->has('pharmacyName') ? ' has-error' : '' }}">
              <label for="pharmacyName" class="col-md-4 control-label">Pharmacy Name</label>

              <div class="col-md-6">
                <input id="pharmacyName" type="text" class="form-control" name="pharmacyName" value="{{ Auth::user()->pharmacyName }}" readonly> @if ($errors->has('pharmacyName'))
                <span class="help-block">
									<strong>{{ $errors->first('pharmacyName') }}</strong>
								</span> @endif
              </div>
            </div>
            <div class="col-md-offset-2">
              <button class="btn btn-default" id='apiFormDivToggle'>
									Give access to pharmacy database
								</button>
              < or>
                <a href="pharmacist/storeProductsInTable" class="btn btn-default">
									enter products manually
								</a>
            </div>
            <br>
            <div id="apiFormDiv" style="display:none;">
              {{-- ---------------------------- DataBase API ----------------------------- --}}
              <div class="form-group{{ $errors->has('dbAPI') ? ' has-error' : '' }}">
                <label for="dbAPI" class="col-md-4 control-label">API</label>

                <div class="col-md-6">
                  <button class="btn btn-default" id='hideshow'>
									<i class="fa fa-question-circle-o" aria-hidden="true"></i>
								</button>
                  <input type="text" id="dbAPI" name="dbAPI" class="form-control" required autofocus> @if ($errors->has('dbAPI'))
                  <span class="help-block">
									<strong>{{ $errors->first('dbAPI') }}</strong>
								</span> @endif
                </div>
              </div>

              {{-- ---------------------------- DataBase API Validity Test Form ----------------------------- --}}
              <div id="medInput" class="well" style="display:none;">

                {{-- ---------------------------- Medicine 1 ----------------------------- --}}
                <div class="form-group{{ $errors->has('medicine') ? ' has-error' : '' }}">
                  <label for="medicine" class="col-md-4 control-label">Medicine 1</label>

                  <div class="col-md-6">
                    <input id="ownerName" type="text" class="form-control" name="medicine[]" required autofocus>
                  </div>
                </div>
                {{-- ---------------------------- Medicine 2 ----------------------------- --}}
                <div class="form-group{{ $errors->has('medicine') ? ' has-error' : '' }}">
                  <label for="medicine" class="col-md-4 control-label">Medicine 2</label>

                  <div class="col-md-6">
                    <input id="ownerName" type="text" class="form-control" name="medicine[]" required autofocus>
                  </div>
                </div>

                {{-- ---------------------------- Medicine 3 ----------------------------- --}}
                <div class="form-group{{ $errors->has('medicine') ? ' has-error' : '' }}">
                  <label for="medicine" class="col-md-4 control-label">Medicine 3</label>

                  <div class="col-md-6">
                    <input id="ownerName" type="text" class="form-control" name="medicine[]" required autofocus>
                  </div>
                </div>
              </div>

              {{-- ---------------------------- API Instructions Div (hidden)----------------------------- --}}
              <div id="apiSteps" class="well" style="display:none;">
                <p>
                  Respected Pharmist,
                  <br /> Kindly follow these steps to find your api
                  <br/>1) blah blah blah
                  <br/>2) blah blah blah
                  <br/>3) blah blah blah
                  <br/>4) blah blah blah
                  <br/>5) blah blah blah
                  <br/>6) blah blah blah
                  <br/>7) blah blah blah
                  <br/>8) blah blah blah
                </p>

              </div>

              {{-- ---------------------------- Save API Button ----------------------------- --}}
              <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">
									Save Details
								</button>
                </div>
              </div>

          </form>
          </div>
        </div>
      </div>
    </div>




  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
  // API instructions div hide/show
  $(document).ready(function() {
    $("#apiSteps").hide();

    $("#hideshow").click(function() {
      $("#apiSteps").toggle();
    });

    $("#apiFormDiv").hide();

    $("#apiFormDivToggle").click(function() {
      $("#apiFormDiv").toggle();
    });

    // If api input form filled show api validity form
    $('input[name=dbAPI]').keyup(function() {
      if ($(this).val().length)
        $('#medInput').show();
      else
        $('#medInput').hide();
    });
  });
</script>
@endsection
