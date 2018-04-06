@extends('layouts.siteView')

@section('style')

@endsection

@section('body')
  <div class="container">
    <div class="row">
  {{-- ---------------------------- Message Div ----------------------------- --}}
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-heading">Enter your Query</div>

      <div class="panel-body">
        <form class="form-horizontal" method="POST" action="/contactUs">
          {{ csrf_field() }}

          <div class="form-group">
            <label for="name" class="col-md-4 control-label">Name</label>
            <div class="col-md-6">
              <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}" required autofocus></input>
            </div>
            </div>

            <div class="form-group">
            <label for="email" class="col-md-4 control-label">Email</label>
            <div class="col-md-6">
              <input type="text" id="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus></input>
            </div>
            </div>

            <div class="form-group">
            <label for="message" class="col-md-4 control-label">Message</label>
            <div class="col-md-6">
              <textarea rows="5" id="message" class="form-control" name="message" value="{{ old('message') }}" required autofocus></textarea>
            </div>
            </div>


          <div class="form-group">
            <div class="col-md-8 col-md-offset-4">
              <button type="submit" class="btn btn-primary">
                Ask for assistance
              </button>

              </a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>
  </div>
@endsection
