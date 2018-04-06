<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>

.inv-container {
  font-family: 'Lato', sans-serif;
  margin: 20px auto;
  max-width: 650px
}

.inv-note {
  font-weight: 400;
  font-style: italic;
  color: #333;
  line-height: 140%;
  padding: 0 5px 20px 5px;
  border-bottom: 1px solid #eee;
  margin-bottom: 10px
}

.inv-header {
  margin: 30px 5px;
  vertical-align: top
}

.inv-header div {
  display: inline-block;
  width: 45%
}

.inv-date {
  margin-right: 5%
}

.inv-date span {
  display: block;
  margin-bottom: 8px
}

.inv-date span b {
  display: inline-block;
  min-width: 120px
}

.inv-title {
  text-align: right
}

.inv-title h1 {
  margin: 0; padding: 0
}

.inv-title span {
  font-size: 0.8em;
  margin-top: 5px
}

.inv-table {
  width: 100%;
  border-spacing: 0;
  border-collapse: collapse;
}

.inv-table thead {
  background-color: #EFEFEF
}

.inv-table th, td {
  padding: 5px
}

.inv-table tfoot td {
  text-align: right
}

.inv-table td.total {
  border-top: 1px solid #eee
}

.inv-pay {
  margin: 20px;
  text-align: center
}

/* utility */

.u-left {
  text-align: left
}

.u-mid {
  text-align: center
}

.u-right {
  text-align: right
}

/* responsive table 🎷 */

@media only screen and (max-width: 650px) {

  .inv-note {
    padding: 10px 20px 30px 20px
  }
  
  .inv-header div {
    display: block;
    width: auto;
    margin-left: 15px
  }
  
  .inv-title { text-align: left }
  .inv-title h1 { display: none }
  
  table.inv-table,
  .inv-table thead,
  .inv-table tbody,
  .inv-table tfoot,
  .inv-table th,
  .inv-table tr,
  .inv-table td {
    display: block
  }

  .inv-table thead tr {
    position: absolute;
    top: -9999px;
    left: -9999px
  }

  .inv-table td {
    position: relative;
    padding-left: 35%;
    text-align: left
  }

  .inv-table td:before {
    position: absolute;
    top: 5px;
    left: 18px;
    width: 30%;
    padding-right: 10px;
    white-space: nowrap;
    font-weight: bold;
    color: #777;
    text-align: left
  }
  
  .inv-table tbody tr { margin-bottom: 10px; padding-top: 10px; }
  
  .inv-table tbody tr:nth-child(even) {
    border-top: 1px solid #eee
  }

  .inv-table tbody td:nth-of-type(1)::before { content: 'Item' }
  .inv-table tbody td:nth-of-type(2)::before { content: 'Type' }
  .inv-table tbody td:nth-of-type(3)::before { content: 'Price' }
  .inv-table tbody td:nth-of-type(4)::before { content: 'Quantity' }
  .inv-table tbody td:nth-of-type(5)::before { content: 'Subtotal' }
  
  
  .inv-table tfoot {
    background-color: #eee;
    padding-bottom: 10px;
    margin-top: 10px
  }
    
  .inv-table tfoot td {
    text-align: left
  }
  
  .inv-table td.total { border: 0 }
}
    
/* template placeholder style */

.fillme {
  background-color: #eee;
  padding: 0 5px;
  color: #777
}

.fillme::before {
  content: '['
}

.fillme::after {
  content: ']'
}

</style>
   

</head>
<body>
    
  <div class="inv-container">
    <div class="inv-note">
      Hi <span class="fillme">{{$recipientData->name}}</span>, the following is an invoice for <span class="fillme">Order# {{$order->id}}</span>. It's been a pleasure working with you.
    </div>
    <div class="inv-header">
      <div class="inv-date">
        <b>Delivery Address </b>{{$recipientData->address}} {{$recipientData->society}}, {{$recipientData->city}}
        <br>
        <b>Order Date </b>{{date_format($order->created_at,"d/m/Y")}}
        <br>
      </div>
    </div>
    <table class="inv-table">
      <thead>
        <tr>
          <th class="u-left">Item</th>
          <th class="u-left">Type</th>
          <th class="u-right">Price</th>
          <th class="u-mid">Quantity</th>
          <th class="u-right">Subtotal</th>
        </tr>
      </thead>
      <tbody>
        @for($i=0; $i<count($product); $i++)
        <tr>
          <td class="u-left">{{$product[$i]->name}}</td>
          @if($product[$i]->type=='1') <!-- 1 = Tablet -->
          <td class="left">Tablet</td>
                  @elseif($product[$i]->type=='2') <!-- 2 = Capsule -->
          <td class="left">Capsule </td>
                  @elseif($product[$i]->type=='3') <!-- 3 = Syrup -->
          <td class="left">Syrup</td>
                  @elseif($product[$i]->type=='4') <!-- 4 = Inhaler -->
          <td class="left">Inhaler</td>
                  @elseif($product[$i]->type=='5') <!-- 5 = Drops -->
          <td class="left">Drops</>
                  @elseif($product[$i]->type=='6') <!-- 6 = Injection -->
          <td class="left">Injection</>
                  @elseif($product[$i]->type=='7') <!-- 7 = Cream -->
          <td class="left">Cream</td>
          @endif
          <td class="u-right">{{$product[$i]->price}}</td>
          <td class="u-mid">{{$orderItems[$i]->quantity}}</td>
          <td class="u-right">{{$product[$i]->price*$orderItems[$i]->quantity}}</td>
        </tr>
        @endfor
      </tbody>
      <tfoot>
        <tr>
          <td/>
          <td colspan="2" class="total">Subtotal</td>
          <td class="total">{{$order->cost}}</td>
        </tr>
        {{-- <tr>
          <td/>
          <td colspan="2">Tax @ 13%</td>
          <td>61.56</td>
        </tr> --}}
        <tr>
          <td/>
          <td colspan="2" class="total">Total</td>
          <td class="total">{{$order->cost}} rs</td>
        </tr>
      </tfoot>

    <div class="inv-notefinal u-mid">Thank you 🙂</div>
  </div>
</body>
</html>