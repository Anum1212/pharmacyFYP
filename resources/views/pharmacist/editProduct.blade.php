@extends('layouts.app')

@section('content')
    <div class="container">
          <form action="/pharmacist/editProduct/{{$product->id}}" method="POST">
            {{ csrf_field() }}  {{ method_field('PUT') }}
    <div class="form-group">
      <label for="productName">Product Name:</label>
      <input type="text" class="form-control" id="productName" placeholder="Enter productName" name="productName" value="{{$product->name}}"required>
    </div>
    <div class="form-group">
      <label for="dosage">Dosage(mg/ml):</label>
      <input type="number" class="form-control" id="dosage" placeholder="Enter dosage" name="dosage" value="{{$product->dosage}}"required>
    </div>
     {{--  possible types of medicine
             1) tablet
             2) capsule
             3) syrup
             4) inhaler
             5) drops
             6) injection
             7) cream  --}}
    <div class="form-group">
  <label for="drugType">Product Type:</label>
  <select class="form-control" id="drugType" name="drugType" required>
    <option value="">----</option>
    <option value="1"<?php if($product->type=="1") echo 'selected="selected"'; ?>>Tablet</option>
    <option value="2"<?php if($product->type=="2") echo 'selected="selected"'; ?>>Capsule</option>
    <option value="3"<?php if($product->type=="3") echo 'selected="selected"'; ?>>Syrup</option>
    <option value="4"<?php if($product->type=="4") echo 'selected="selected"'; ?>>Inhaler</option>
    <option value="5"<?php if($product->type=="5") echo 'selected="selected"'; ?>>Drops</option>
    <option value="6"<?php if($product->type=="6") echo 'selected="selected"'; ?>>Injection</option>
    <option value="7"<?php if($product->type=="7") echo 'selected="selected"'; ?>>Cream</option>
  </select>
</div>
    <div class="form-group">
      <label for="price">Price:</label>
      <input type="number" class="form-control" id="price" placeholder="Enter price" name="price" value="{{$product->price}}"required>
    </div>
    <div class="form-group">
      <label for="quantity">Quantity:</label>
      <input type="number" class="form-control" id="quantity" placeholder="Enter quantity" name="quantity" value="{{$product->quantity}}"required>
    </div>
    <button type="submit" class="btn btn-default">Add Product</button>
  </form>
    </div>
@endsection
