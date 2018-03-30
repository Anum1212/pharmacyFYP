@extends('layouts.app')

@section('content')
    <div class="container">
          <form action="addProduct" method="POST">
            {{ csrf_field() }}
    <div class="form-group">
      <label for="productName">Product Name:</label>
      <input type="text" class="form-control" id="productName" placeholder="Enter productName" name="productName" required>
    </div>
    <div class="form-group">
      <label for="dosage">Dosage(mg/ml):</label>
      <input type="number" class="form-control" id="dosage" placeholder="Enter dosage" name="dosage" required>
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
    <option value="1">Tablet</option>
    <option value="2">Capsule</option>
    <option value="3">Syrup</option>
    <option value="4">Inhaler</option>
    <option value="5">Drops</option>
    <option value="6">Injection</option>
    <option value="7">Cream</option>
  </select>
</div>
    <div class="form-group">
      <label for="price">Price:</label>
      <input type="number" class="form-control" id="price" placeholder="Enter price" name="price" required>
    </div>
    <div class="form-group">
      <label for="quantity">Quantity:</label>
      <input type="number" class="form-control" id="quantity" placeholder="Enter quantity" name="quantity" required>
    </div>
    <button type="submit" class="btn btn-default">Add Product</button>
  </form>
    </div>
@endsection
