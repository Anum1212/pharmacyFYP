
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <style>

    #header {
      background: #D41B29;
      color: white;
      text-align: center;
    }

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
      margin: 0;
      padding: 0
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

    .inv-table th,
    td {
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

      .inv-title {
        text-align: left
      }
      .inv-title h1 {
        display: none
      }

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

      .inv-table tbody tr {
        margin-bottom: 10px;
        padding-top: 10px;
      }

      .inv-table tbody tr:nth-child(even) {
        border-top: 1px solid #eee
      }

      .inv-table tbody td:nth-of-type(1)::before {
        content: 'Item'
      }
      .inv-table tbody td:nth-of-type(2)::before {
        content: 'Type'
      }
      .inv-table tbody td:nth-of-type(3)::before {
        content: 'Price'
      }
      .inv-table tbody td:nth-of-type(4)::before {
        content: 'Quantity'
      }
      .inv-table tbody td:nth-of-type(5)::before {
        content: 'Subtotal'
      }


      .inv-table tfoot {
        background-color: #eee;
        padding-bottom: 10px;
        margin-top: 10px
      }

      .inv-table tfoot td {
        text-align: left
      }

      .inv-table td.total {
        border: 0
      }
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
  <div id="emailBody">
    <div id="header" style="background: #D41B29;color: white;text-align: center;">
      <h1>LifeLine</h1>
    </div>
    <div class="inv-container" style="font-family: 'Lato', sans-serif;margin: 20px auto;max-width: 650px;">
      <div class="inv-note" style="font-weight: 400;font-style: italic;color: #333;line-height: 140%;padding: 0 5px 20px 5px;border-bottom: 1px solid #eee;margin-bottom: 10px;">
        Hi
        <b>{{$recipientData->name}}</b>, the following is an invoice for
        <b>Order# {{$order->id}}</b>. It's been a pleasure working with you.
      </div>
      <div class="inv-header" style="margin: 30px 5px;vertical-align: top;">
        <div class="inv-date" style="margin-right: 5%;display: inline-block;width: 45%;">
          <b>Delivery Address </b>{{$recipientData->address}} {{$recipientData->society}}, {{$recipientData->city}}
          <br>
          <b>Order Date </b>{{date_format($order->created_at,"d/m/Y")}}
          <br>
        </div>
      </div>
      <table class="inv-table" style="width: 100%;border-spacing: 0;border-collapse: collapse;">
        <thead style="background-color: #EFEFEF;">
          <tr>
            <th class="u-left" style="text-align: left;padding: 5px;">Item</th>
            <th class="u-left" style="text-align: left;padding: 5px;">Type</th>
            <th class="u-right" style="text-align: right;padding: 5px;">Price</th>
            <th class="u-mid" style="text-align: center;padding: 5px;">Quantity</th>
            <th class="u-right" style="text-align: right;padding: 5px;">Subtotal</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($products as $product)
          <tr>
            <td class="u-left" style="padding: 5px;text-align: left;">{{ $product->name }}</td>
            @if($product->options->type=='1')
            <!-- 1 = Tablet -->
            <td class="left" style="padding: 5px;">Tablet</td>
            @elseif($product->options->type=='2')
            <!-- 2 = Capsule -->
            <td class="left" style="padding: 5px;">Capsule </td>
            @elseif($product->options->type=='3')
            <!-- 3 = Syrup -->
            <td class="left" style="padding: 5px;">Syrup</td>
            @elseif($product->options->type=='4')
            <!-- 4 = Inhaler -->
            <td class="left" style="padding: 5px;">Inhaler</td>
            @elseif($product->options->type=='5')
            <!-- 5 = Drops -->
            <td class="left" style="padding: 5px;">Drops</td>
             @elseif($product->options->type=='6')
              <!-- 6 = Injection -->
              <td class="left" style="padding: 5px;">Injection</td>
              @elseif($product->options->type=='7')
                <!-- 7 = Cream -->
                <td class="left" style="padding: 5px;">Cream</td>
              @elseif($product->options->type=='8')
                <!-- 7 = Cream -->
                <td class="left" style="padding: 5px;">Others</td>
                @endif
                <td class="u-right">{{ $product->price }}</td>
                <td class="u-mid">{{ $product->qty }}</td>
                <td class="u-right">{{ $product->price*$product->qty }}</td>
                </tr>
                @endforeach
        <tfoot>
          <tr>
            <td style="padding: 5px;text-align: right;"></td>
            <td colspan="2" class="total" style="padding: 5px;text-align: right;border-top: 1px solid #eee;">Subtotal</td>
            <td class="total" style="padding: 5px;text-align: right;border-top: 1px solid #eee;">{{$order->cost}}</td>
          </tr>
          {{--
          <tr>
            <td style="padding: 5px;text-align: right;"></td>
            <td colspan="2" style="padding: 5px;text-align: right;">Tax @ 13%</td>
            <td style="padding: 5px;text-align: right;">61.56</td>
          </tr> --}}
          <tr>
            <td style="padding: 5px;text-align: right;"></td>
            <td colspan="2" class="total" style="padding: 5px;text-align: right;border-top: 1px solid #eee;">Total</td>
            <td class="total" style="padding: 5px;text-align: right;border-top: 1px solid #eee;">{{$order->cost}} rs</td>
          </tr>
        </tfoot>

      </table></div>
      <br>
      <br>
      <br>
      <br>
      <div class="inv-notefinal u-mid" style="text-align: center;">Thank you 🙂</div>
  </div>
</body>

</html>