<!doctype html>
<html lang="en">
  <head>
    <title>Customer Pdf</title>
    <style>
      /* #user_details_data tr{text-align: center;}
      #user_details_data tbody tr td{
        padding: 10px;
      }
      h3{
        text-align: center
      } */
      h3{
        text-align: center;
        color:royalblue;
      }
      #user_details_data tbody tr td{
        padding: 10px;
      }

      #invoice_details tbody tr td{
        padding: 10px;
      }

      #product_details tbody tr td{
        padding: 20px;
        border: 1px solid black;
        text-align: center;

      }

      .table1{
        float: left;
      }

      .table2{
        float: right;
      }

      #cef{
        clear: both;
      }
    </style>
  </head>
  <body>
    <div>
      <h2 style="color:royalblue;text-align:center"><u>ECOM</u></h2>
      <h4 style="float: right;color:rgb(226, 14, 95)">
        <div>Date :  <?php echo date('Y/m/d H:i A'); ?></div>
        <div>Vendor Name :  Piyush Shyam</div>
      </h4>
    </div>
    <div id="cef">
      <div class="table1">
        <table  cellspacing="0" cellpadding="0" id="user_details_data">
          <thead>
            <tr>
              <th colspan="2"><h3><u>User Details</u><h3></th>
            </tr>
          </thead>
          <tbody>
            <tr><td><strong>Name : </strong></td><td>{{ $orders[0]->name }}</td></tr>
            <tr><td><strong>Email :</strong></td><td>{{ $orders[0]->email }}</td></tr>
            <tr><td><strong>Mobile No : </strong></td><td>{{ $orders[0]->mobile }}</td></tr>
            <tr><td><strong>Address : </strong></td><td>{{ $orders[0]->address }}</td></tr>
            <tr><td><strong>City : </strong></td><td>{{ $orders[0]->city }}</td></tr>
            <tr><td><strong>State : </strong></td><td>{{ $orders[0]->state }}</td></tr>
            <tr><td><strong>zip : </strong></td><td>{{ $orders[0]->zip }}</td></tr>
          </tbody>
        </table>
      </div>

      <div class="table2">
        <table  cellspacing="0" cellpadding="0" id="invoice_details">
          <thead>
            <tr>
              <th colspan="2"><h3><u>Invoice/transaction details</u></h3></th>
            </tr>
          </thead>
          <tbody>
            <tr><td><strong>Invoice No : </strong></td><td>{{ $orders[0]->sale_code }}</td></tr>
            <tr><td><strong>Payment Type : </strong></td>
              <td>
                <?php
                  if($orders[0]->payment_type == 'Gateway'){ 
                    echo "Instamojo";
                  } else { 
                    echo "Cash On Delivery";
                  } 
                ?>
              </td>
            </tr>
            <tr><td><strong>Order Status : </strong></td><td>{{  $orders[0]->order_status}}</td></tr>
            <tr><td><strong>Payment Status : </strong></td><td>{{ $orders[0]->payment_status }}</td></tr>
            <tr><td><strong>Txn-ID : </strong></td>
              <td>
                <?php 
                  if($orders[0]->txn_id != ""){
                    echo $orders[0]->txn_id;
                  } else {
                    echo 0;
                  }
                ?>
              </td>
            </tr>
            <tr><td><strong>Payment Id : </strong></td>
              <td>
                <?php 
                  if($orders[0]->payment_id != ""){
                    echo $orders[0]->payment_id;
                  } else {
                    echo 0;
                  }
                ?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div style="clear: both;"></div>

    <div id="new_cart_id">
      <h3 class="text-center"><u>Products</u></h3>
      <table border="1" style="padding: 20px" cellspacing="0" cellpadding="0" id="product_details">
        <thead>
          <tr>
            <th>Sr.no</th>
            <th>Product Name</th>
            <th>Placed At</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Sub Total</th>
          </tr>
        </thead>
        <tbody>
          @if(isset($orders[0]))
            @php
              $i = 1;
              $sub_total = 0;
            @endphp
            @foreach($orders as $key => $value)
              <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $value->product_name }}</td>
                <td>{{ date('Y/m/d',strtotime($value->added_on)) }}</td>
                <td>INR {{ $value->price }}</td>
                <td>{{ $value->qty }}</td>
                <td>INR {{ $value->price * $value->qty }}</td>
                <?php $sub_total += $value->price * $value->qty;?>
              </tr>
            @endforeach
            <?php  
              if($orders[0]->coupon_type == "Percent"){
                $coupon_val = $orders[0]->coupon_value.'%';
                        
              } else if($orders[0]->coupon_type == "Amount"){
                $coupon_val = 'INR '.$orders[0]->coupon_value;
              } else {
                $coupon_val =  0;
              }

              if($orders[0]->coupon_code != ''){
                $coupon_code = $orders[0]->coupon_code;
              } else {
                $coupon_code = 'no-coupon applied';
              }
            ?>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td><strong>Total</strong></td>
              <td>INR {{  $sub_total }}</td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td><strong>Coupon Code</strong></td>
              <td>{{ $coupon_code }}</td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td><strong>Coupon value</strong></td>
              <td>{{ $coupon_val }}</td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td><strong>Grand Total</strong></td>
              <td>INR {{ $orders[0]->grand_total }}</td>
            </tr>
          @else
            <h2>No Details Found</h2>
          @endif
          </tbody>
      </table>
    </div>
  </body>
</html>
