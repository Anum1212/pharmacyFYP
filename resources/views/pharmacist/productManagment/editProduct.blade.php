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
        <form class="form-horizontal confirm" action="/pharmacist/editProduct/{{$product->id}}" method="POST">
          {{ csrf_field() }} {{ method_field('PUT') }}
          <fieldset>

            <!-- Product Name-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="productName">Product Name</label>
              <div class="col-md-9">
                <input id="productName" name="productName" type="text" class="form-control" value="{{$product->name}}" required>
              </div>
            </div>

            <!-- genericName-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="genericName">GenericName</label>
              <div class="col-md-9">
                <input id="genericName" name="genericName" type="text" class="form-control" value="{{$product->genericName}}" required>
              </div>
            </div>

            <!-- manufacturer-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="manufacturer">Manufacturer</label>
              <div class="col-md-9">
                <input id="manufacturer" name="manufacturer" type="text" class="form-control" value="{{$product->manufacturer}}" required>
              </div>
            </div>

                        {{-- possible types of medicine 1) tablet 2) capsule 3) syrup 4) inhaler 5) drops 6) injection 7) cream --}}
            <!-- Product Type-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="dosage">Product Type:</label>
              <div class="col-md-9">
                <select class="form-control" id="drugType" name="drugType" required>
                  <option value="1" <?php if($product->type=="1") echo 'selected="selected"'; ?>>Tablet</option>
                  <option value="2" <?php if($product->type=="2") echo 'selected="selected"'; ?>>Capsule</option>
                  <option value="3" <?php if($product->type=="3") echo 'selected="selected"'; ?>>Syrup</option>
                  <option value="4" <?php if($product->type=="4") echo 'selected="selected"'; ?>>Inhaler</option>
                  <option value="5" <?php if($product->type=="5") echo 'selected="selected"'; ?>>Drops</option>
                  <option value="6" <?php if($product->type=="6") echo 'selected="selected"'; ?>>Injection</option>
                  <option value="7" <?php if($product->type=="7") echo 'selected="selected"'; ?>>Cream</option>
                  <option value="8" <?php if($product->type=="8") echo 'selected="selected"'; ?>>Others</option>
                </select>
              </div>
            </div>

              {{-- possible category 1) Medicine 2) Supplements 3) Baby and Mom 4) Beauty 5) HouseHold 6) Others --}}
            <!-- Product Type-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="dosage">Product Category:</label>
              <div class="col-md-9">
                <select class="form-control" id="category" name="category" required>
                  <option value="1" <?php if($product->category=="category1") echo 'selected="selected"'; ?>>Medicine</option>
                  <option value="2" <?php if($product->category=="category2") echo 'selected="selected"'; ?>>Supplements</option>
                  <option value="3" <?php if($product->category=="category3") echo 'selected="selected"'; ?>>Baby and Mom</option>
                  <option value="4" <?php if($product->category=="category4") echo 'selected="selected"'; ?>>Beauty</option>
                  <option value="5" <?php if($product->category=="category5") echo 'selected="selected"'; ?>>HouseHold</option>
                  <option value="6" <?php if($product->category=="category6") echo 'selected="selected"'; ?>>Others</option>
                </select>
              </div>
            </div>

            <!-- tablets-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="tablets">Tablets</label>
              <div class="col-md-9">
                <input id="tablets" name="tablets" type="number" class="form-control" value="{{$product->tablets}}" placeholder="leave empty if not a tablet">
              </div>
            </div>

            <!-- Product Dosage-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="dosage">Dosage</label>
              <div class="col-md-9">
                <input id="dosage" name="dosage" type="number" class="form-control" value="{{$product->dosage}}" required>
              </div>
            </div>

            {{-- possible types of medicine 0) Not Required 1) Required--}}
            <!-- Product prescription-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="prescription">Prescription:</label>
              <div class="col-md-9">
                <select class="form-control" id="prescription" name="prescription" required>
                  <option value="">----</option>
                  <option value="0" <?php if($product->prescription=="0") echo 'selected="selected"'; ?>>Not Required</option>
                  <option value="1" <?php if($product->prescription=="1") echo 'selected="selected"'; ?>>Required</option>
                </select>
              </div>
            </div>

            <!-- Product Price-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="price">Price</label>
              <div class="col-md-9">
                <input id="price" name="price" type="number" class="form-control" value="{{$product->price}}" required>
              </div>
            </div>

            <!-- Product Quantity-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="quantity">Quantity</label>
              <div class="col-md-9">
                <input id="quantity" name="quantity" type="number" class="form-control" value="{{$product->quantity}}" required>
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
        <div class="form-group">
          <div class="col-md-12 widget-left">
            <form class="confirm" style="margin-top:15px;" action="{{'/pharmacist/deleteProduct/'.$product->id}}" method="post">
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