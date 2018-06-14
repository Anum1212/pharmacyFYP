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
                Enabled Files ({{$totalEnabledFiles}})
                <span class="pull-right clickable panel-toggle panel-button-tab-left">
                    <em class="fa fa-toggle-up"></em>
                </span>
            </div>
            <div class="panel-body">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">View</th>
                            <th scope="col">Disable</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enabledFiles as $enabledFile)
                        <tr>
                            <td data-label="#">{{ (($enabledFiles->currentPage() - 1 ) * $enabledFiles->perPage() ) + $loop->iteration }}</td>
                            <td data-label="Name">{{$enabledFile->title}}</td>
                            <td data-label="View">
                                <a href="{{'/admin/editFileForm/'.$enabledFile->id}}">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td data-label="Mark as read">
                                <form style="margin-top:15px;" action="{{'/admin/disableFile/'.$enabledFile->id}}" method="post">
                                    {{csrf_field()}} {{method_field('PUT')}}
                                    <button type="submit" class="btn btn-warning">Disable</button>
                                </form>
                            </td>
                            <td data-label="Delete">
                                <form class="confirm" style="margin-top:15px;" action="{{'/admin/deleteFile/'.$enabledFile->id}}" method="post">
                                    {{csrf_field()}} {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $enabledFiles->appends(['disabledTable' => $disabledFiles->currentPage()])->links() }}
                <div class="divider">

                </div>
            </div>
        </div>
    </div>
</div>
<!--/.row-->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Disabled Files ({{$totaldisabledFiles}})
                <span class="pull-right clickable panel-toggle panel-button-tab-left">
                    <em class="fa fa-toggle-up"></em>
                </span>
            </div>
            <div class="panel-body">
                {{-- |---------------------------------- Disabled Files Table ----------------------------------|--}}
                <table>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">View</th>
                            <th scope="col">Enable</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($disabledFiles as $disabledFile)
                        <tr>
                            <td data-label="#">{{ (($disabledFiles->currentPage() - 1 ) * $disabledFiles->perPage() ) + $loop->iteration }}</td>
                            <td data-label="Name">{{$disabledFile->title}}
                            </td>
                            <td data-label="View">
                                <a href="{{'/admin/editFileForm/'.$disabledFile->id}}">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td data-label="Enable File">
                                <form style="margin-top:15px;" action="{{'/admin/enableFile/'.$disabledFile->id}}" method="post">
                                    {{csrf_field()}} {{method_field('PUT')}}
                                    <button type="submit" class="btn btn-warning">Enable</button>
                                </form>
                            </td>
                            <td data-label="Delete">
                                <form class="confirm" style="margin-top:15px;" action="{{'/admin/deleteFile/'.$disabledFile->id}}" method="post">
                                    {{csrf_field()}} {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $disabledFiles->appends(['enabledTable' => $enabledFiles->currentPage()])->links() }}

            </div>
        </div>
    </div>
</div>
<!--/.row-->
@endsection