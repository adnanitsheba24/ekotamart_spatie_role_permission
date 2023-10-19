<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Ekota-Mart Invoice</title>
        <style type="text/css">
            * {
                font-family: Verdana, Arial, sans-serif;
            }
            table{
                font-size: x-small;
            }
            tfoot tr td{
                font-weight: bold;
                font-size: x-small;
            }
            .gray {
                background-color: lightgray
            }
            .font{
            font-size: 15px;
            }
            .authority {
                /*text-align: center;*/
                float: right
            }
            .authority h5 {
                margin-top: -10px;
                color: green;
                /*text-align: center;*/
                margin-left: 35px;
            }
            .thanks p {
                color: green;;
                font-size: 16px;
                font-weight: normal;
                font-family: serif;
                margin-top: 20px;
            }
        </style>
    </head>

    <body>
        <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
            <tr>
                <td valign="top">
                    <br>
                    @if (@$site_setting->logo == '' || @$site_setting->logo == null)
                        <img src="{{ asset('upload/no_image.jpg') }}" style="height: auto; width: 200px;" alt="No Image">
                    @else
                        <img src="{{ URL::to('storage/logo/', @$site_setting->logo) }}" alt="" style="width: 200px; height: 50px;">
                    @endif
                </td>

                <td align="right">
                    <p class="font" >
                        Company Name: {{ @$site_setting['company_name'] }} <br>
                        Company Address: {{ @$site_setting['company_address'] }}<br>
                        Email: {{ @$site_setting['email'] }}<br>
                        Mobile: {{ @$site_setting['phone_one'] }}<br>
                    </p>
                </td>
            </tr>
        </table>

        <table width="100%" style="background:white; padding:2px;"></table>

        <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
            <tr>
                <td>
                    <p class="font" style="margin-left: 20px;">
                     <strong>Name:</strong> {{ @$order['name'] }}<br>
                     <strong>Email:</strong> {{ @$order['email'] }} <br>
                     <strong>Phone:</strong> {{ @$order['phone'] }} <br>
          
                     @php
                          $div = $order->division->division_name;
                          $dis = $order->district->district_name;
                          $upazi = $order->upazila->upazila_name;
                     @endphp
                      
                     <strong>Aria Location:</strong> {{ $div }}, {{ $dis }}, {{ $upazi }} <br>
                     <strong>Address:</strong> {{@$order['address'] }} <br>
                     <strong>Date of Birth:</strong> {{ @$order['date_of_birth'] }} <br>
                     <strong>Gender:</strong> {{ @$order['gender'] }} <br>
                   </p>
                </td>

                <td>
                    <p class="font">
                        <h3><span style="color: green;"><strong>Invoice:</strong></span> #{{ @$order['invoice_no']}}</h3>
                       <strong>Order Date:</strong> {{ @$order['order_date'] }} <br>
                       <strong>Delivery Date:</strong> {{ @$order['delivered_date'] }} <br>
                       <strong>Payment Method :</strong> {{ @$order['payment_method'] }} </span>
                     </p>
                </td>
            </tr>
        </table>
        <br/>
        <h3>Products</h3>

        <table width="100%">
            <thead style="background-color: green; color:#FFFFFF;">
                <tr class="font">
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Code</th>
                    <th>Quantity</th>
                    <th>Unit Price </th>
                    <th>Total </th>
                </tr>
            </thead>
            <tbody>
              
                @foreach($orderItem as $item)
                    <tr class="font">
                        
                        <td align="center">
                            @if (@$site_setting->logo == '' || @$site_setting->logo == null)
                                <img src="{{ asset('upload/no_image.jpg') }}" style="height: 60px; width: 60px;" alt="No Image">
                            @else
                                <img src="{{ URL::to('storage/products/thambnail/', @$item->product->product_thambnail) }}" alt="" style="width: 60px; height: 60px;">
                            @endif
                        </td>

                        <td align="center"> {{ $item->product->product_name_en }}</td>
                        <td align="center">{{ $item->product->product_code }}</td>
                        <td align="center">{{ $item->qty }}</td>
                        <td align="center">{{ $item->price }} Taka</td>
                        <td align="center">{{ $item->price * $item->qty }} Taka</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>

        <table width="100%" style=" padding:0 10px 0 10px;">
            <tr>
                <td align="right" >
                    <h2><span style="color: green;">Subtotal Due: </span>{{ $order['amount'] }} Taka</h2>
                    <h2><span style="color: green;">Total Due: {{ $order['amount'] }} Taka</h2>
                </td>
            </tr>
        </table>

        <div class="thanks mt-3">
            <p>Thanks For Buying Products..!!</p>
        </div>
        <div class="authority float-right mt-5">
            <p>-----------------------------------</p>
            <h5>Authority Signature:</h5>
        </div>
    </body>

</html>