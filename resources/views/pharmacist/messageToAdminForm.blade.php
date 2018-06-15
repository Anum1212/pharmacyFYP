@extends('layouts.pharmacistDashboard')

@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Contact Admin
                <span class="pull-right clickable panel-toggle panel-button-tab-left">
                    <em class="fa fa-toggle-up"></em>
                </span>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="/contactUs" method="POST">
                    {{ csrf_field() }}
                    <fieldset>
                        <!-- Pharmacist Name-->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name">Name</label>
                            <div class="col-md-9">
                                <input id="name" name="name" type="text" class="form-control" value="{{ Auth::user()->name }}" required autofocus>
                            </div>
                        </div>

                        <!-- Pharmacist Email-->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="email">Your E-mail</label>
                            <div class="col-md-9">
                                <input id="email" name="email" type="text" class="form-control" value="{{ Auth::user()->email }}" required autofocus>
                            </div>
                        </div>

                        <!-- Pharmacist Message -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="message">Your message</label>
                            <div class="col-md-9">
                                <textarea class="form-control" id="message" name="message" rows="5" required autofocus></textarea>
                            </div>
                        </div>

                        <!-- Form actions -->
                        <div class="form-group">
                            <div class="col-md-12 widget-right">
                                <button type="submit" class="btn btn-default btn-md pull-right">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/.row-->
@endsection