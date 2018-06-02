@extends('layouts.dashboard') @section('head') @endsection @section('style') @endsection @section('body')
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/index">
                <span>Lumino</span>Admin</a>
        </div>
    </div>
</nav>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar menuDisabled">
    <div class="profile-sidebar">
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">
                <span class="capitalWord">{{Auth::user()->name}}</span>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>

    <ul class="nav menu">
        <li class="active">
            <a>
                <em class="fa fa-dashboard">&nbsp;</em> Dashboard</a>
        </li>
        <li>
            <a>
                <em class="fa fa-cogs">&nbsp;</em> Account Details</a>
        </li>
        <li>
            <a>
                <em class="fa fa-truck">&nbsp;</em> Orders</a>
        </li>
        <li class="parent ">
            <a data-toggle="collapse" href="#products">
                <em class="fa fa-database">&nbsp;</em> Product Management
                <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right">
                    <em class="fa fa-plus"></em>
                </span>
            </a>
            <ul class="children collapse" id="products">
                <li>
                    <a>
                        <span class="fa fa-search">&nbsp;</span> View Products
                    </a>
                </li>
                <li>
                    <a>
                        <span class="fa fa-plus">&nbsp;</span> Add Products
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
<!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <em class="fa fa-home"></em>
                </a>
            </li>
            <li class="active">Dashboard</li>
        </ol>
    </div>
    <!--/.row-->

    {{-- <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">File Managment</h1>
        </div>
    </div> --}}
    <!--/.row-->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Product Storage Managment
                    <span class="pull-right clickable panel-toggle panel-button-tab-left">
                        <em class="fa fa-toggle-up"></em>
                    </span>
                </div>
                <div class="panel-body">
                  <div class="buttons container col-lg-9 col-lg-offset-2 col-md-9 col-md-offset-2 col-sm-9 col-sm-offset-3 col-xs-12">
                    <div class="row">
                    <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <a href="/pharmacist/storeProductsInTable" class="btn btn-md btn-default">Store Data on website Storage</a>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <button class="btn btn-md btn-default" id="showApiForm">Give access to your DataBase</button>
                  </div>
                </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="apiForm">
                  <hr>
                  				<div class="panel panel-default">
					<div class="panel-heading" style="text-align:center;">
            API Form <button class="btn btn-sm btn-info" id="showApiInfo"><i class="fa fa-question-circle-o"></i>
          </button>
          </div>
          
					<div class="panel-body">
            <div class="panel-body col-lg-12 col-md-12 col-sm-12 col-xs-12" id="apiInfo">
              <ol>
                <li>Enter your pharamacy API</li>
                <li>In the medicine fields enter the name of medicines availbale in your database</li>
                <li>Enter proper name of medicine as saved in your database</li>
                <li>the system will use these medicines to veriify if the api is valid</li>
                <li>if the system fails to find these medicines you will be given an error notification</li>
                <li>Contact Admin in case of problem. <a class="btn btn-md btn-success" href="/pharmacist/contactUsForm">
                <em class="fa fa-comment">&nbsp;</em> Contact Admin</a></li>
              </ol>
              
            </div>
            <div class="col-lg-9 col-lg-offset-2 col-md-9 col-md-offset-2 col-sm-9 col-sm-offset-3 col-xs-12">
						<form class="form-horizontal"method="POST" action="/pharmacist/savePharmacyApi">
            {{ csrf_field() }}
							<fieldset>
                
                <!-- Message body -->
								<div class="form-group">
									<label class="col-md-1 control-label" for="message">API</label>
									<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
										<textarea class="form-control" id="message" name="message" rows="5" required></textarea>
									</div>
                </div>
                

                <!-- Name input-->
								<div class="form-group">
									<label class="col-md-1 control-label" for="medicine">Medicine 1</label>
									<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
										<input id="medicine" name="medicine[]" type="text" class="form-control" required>
									</div>
                </div>
                
                <!-- Name input-->
								<div class="form-group">
									<label class="col-md-1 control-label" for="medicine">Medicine 2</label>
									<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
										<input id="medicine" name="medicine[]" type="text" class="form-control" required>
									</div>
								</div>
                
                <!-- Name input-->
								<div class="form-group">
									<label class="col-md-1 control-label" for="medicine">Medicine 3</label>
									<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
										<input id="medicine" name="medicine[]" type="text" class="form-control" required>
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
			</div><!--/.col-->
                </div>

            </div>
        </div>
    </div>
    <!--/.row-->


</div>
<!--/.row-->
</div>
<!--/.main-->
@endsection @section('script') 
<script>
  
  $(document).ready(function(){
    var apiForm = $('#apiForm');
    var apiInfo = $('#apiInfo');
    var menuDisabled = $('.menuDisabled');
    apiForm.hide();
    apiInfo.hide();
    var showApiForm = $('#showApiForm');
    var showApiInfo = $('#showApiInfo');
    showApiForm.click(function(){
      apiForm.toggle();
    });
    showApiInfo.click(function(){
      apiInfo.toggle();
    });
    menuDisabled.hover(function(){
      alert('Please fill form to proceed');
    });
  });
  
  </script>@endsection