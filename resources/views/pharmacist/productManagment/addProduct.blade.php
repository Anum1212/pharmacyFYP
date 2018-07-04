@extends('layouts.pharmacistDashboard')

@section('body')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">

        <span class="pull-right clickable panel-toggle panel-button-tab-left">
          <em class="fa fa-toggle-up"></em>
        </span>
      </div>
      <div class="panel-body">
        <form class="form-horizontal confirm" action="addProduct" method="POST">
          {{ csrf_field() }}
          <fieldset>
            
            <!-- Product Name-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="productName">Product Name</label>
              <div class="col-md-9">
                <input id="productName" name="productName" type="text" class="form-control" required>
              </div>
            </div>

            <!-- genericName-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="genericName">GenericName</label>
              <div class="col-md-9">
                <input id="genericName" name="genericName" type="text" class="form-control" required>
              </div>
            </div>

            <!-- manufacturer-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="manufacturer">Manufacturer</label>
              <div class="col-md-9">
                <input id="manufacturer" name="manufacturer" type="text" class="form-control" required>
              </div>
            </div>
            
            {{-- possible types of medicine 1) tablet 2) capsule 3) syrup 4) inhaler 5) drops 6) injection 7) cream --}}
            <!-- Product Dosage-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="dosage">Product Type:</label>
              <div class="col-md-9">
                <select class="form-control" id="drugType" name="drugType" required>
                  <option value="">----</option>
                  <option value="1">Tablet</option>
                  <option value="2">Capsule</option>
                  <option value="3">Syrup</option>
                  <option value="4">Inhaler</option>
                  <option value="5">Drops</option>
                  <option value="6">Injection</option>
                  <option value="7">Cream</option>
                  <option value="8">Others</option>
                </select>
              </div>
            </div>

                          {{-- possible category 1) Medicine 2) Supplements 3) Baby and Mom 4) Beauty 5) HouseHold 6) Others --}}
            <!-- Product Type-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="dosage">Product Category:</label>
              <div class="col-md-9">
                <select class="form-control" id="category" name="category" required>
                  <option value="1">Medicine</option>
                  <option value="2">Supplements</option>
                  <option value="3">Baby and Mom</option>
                  <option value="4">Beauty</option>
                  <option value="5">HouseHold</option>
                  <option value="6">Others</option>
                </select>
              </div>
            </div>

            <!-- tablets-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="tablets">Tablets</label>
              <div class="col-md-9">
                <input id="tablets" name="tablets" type="number" class="form-control" placeholder="leave empty if not a tablet">
              </div>
            </div>

            <!-- Product Dosage-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="dosage">Dosage/Weight</label>
              <div class="col-md-9">
                <input id="dosage" name="dosage" type="number" class="form-control" required>
              </div>
            </div>

            {{-- possible types of medicine 0) Not Required 1) Required--}}
            <!-- Product prescription-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="prescription">Prescription:</label>
              <div class="col-md-9">
                <select class="form-control" id="prescription" name="prescription" required>
                  <option value="">----</option>
                  <option value="0">Not Required</option>
                  <option value="1">Required</option>
                </select>
              </div>
            </div>

            <!-- Product Price-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="price">Price</label>
              <div class="col-md-9">
                <input id="price" name="price" type="number" class="form-control" required>
              </div>
            </div>

            <!-- Product Quantity-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="quantity">Quantity</label>
              <div class="col-md-9">
                <input id="quantity" name="quantity" type="number" class="form-control" required>
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