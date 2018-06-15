@extends('layouts.adminDashboard') 

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
                <form class="form-horizontal confirm" method="POST" action="/admin/editFile/{{$file->id}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <fieldset>
                        <!-- File Title-->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="fileTitle">File Title</label>
                            <div class="col-md-9">
                                <input id="fileTitle" name="fileTitle" type="text" class="form-control" value="{{$file->title}}" required>
                            </div>
                        </div>

                        <!-- File Description-->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="description">Description</label>
                            <div class="col-md-9">
                                <textarea id="description" name="description" class="form-control" rows="3" required>{{$file->description}}</textarea>
                            </div>
                        </div>

                        <!-- File Upload -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="uploadFile">File</label>
                            <div class="col-md-5">
                                <input type="file" name="uploadFile" required>
                            </div>
                            <div class="col-md-3">
                                <a class="btn btn-sm btn-primary" href={{ asset( 'storage/myAssets/files/'.$file->filename) }} download= {{$file->title}} >Currently Uploaded File</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 widget-right">
                                <button type="submit" class="btn btn-default btn-md pull-right">Upload File</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
                <div class="form-group">
                    <div class="col-md-12 widget-left">
                        <form class="confirm" style="margin-top:15px;" action="{{'/admin/deleteFile/'.$file->id}}" method="post">
                            {{csrf_field()}} {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/.row-->
@endsection