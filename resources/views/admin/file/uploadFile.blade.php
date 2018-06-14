@extends('layouts.adminDashboard') 


@section('panelHeading', 'panelHeadingHere') 

@section('searchBar')
<form role="search" action="/admin/searchFile" method="get" role="search">
    <div class="form-group">
        <input type="text" class="form-control" name="search" placeholder="Search for file" required>
    </div>
</form>
@endsection

@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Upload File
                <span class="pull-right clickable panel-toggle panel-button-tab-left">
                    <em class="fa fa-toggle-up"></em>
                </span>
            </div>
            <div class="panel-body">
                <form class="form-horizontal confirm" method="POST" action="/admin/uploadFile" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <fieldset>
                        <!-- File Title-->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="fileTitle">File Title</label>
                            <div class="col-md-9">
                                <input id="fileTitle" name="fileTitle" type="text" class="form-control" required>
                            </div>
                        </div>

                        <!-- File Description-->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="description">Description</label>
                            <div class="col-md-9">
                                <input id="description" name="description" type="text" class="form-control" required>
                            </div>
                        </div>

                        <!-- File Upload -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="uploadFile">File</label>
                            <div class="col-md-9">
                                <input type="file" name="uploadFile" required>
                            </div>
                        </div>

                        <!-- Form actions -->
                        <div class="form-group">
                            <div class="col-md-12 widget-right">
                                <button type="submit" class="btn btn-default btn-md pull-right">Upload File</button>
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