 
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>One Solutions</title>
    <style>
        .ownp{
            padding:5px;
            background:#e9e9e9;
            margin-bottom:10px;
        }
        body{
            background-color:white;
            margin: 0;
            padding: 0;
        }
        h1,h2,h3,h4,h5,h6{
            margin: 0;
            padding: 0;
        }
        p{
            margin: 0;
            padding: 0;
        }
        .container{
            width: 80%;
            margin-right: auto;
            margin-left: auto;
        }
        .brand-section{
            background-color: white;
            padding: 10px 10px;
        }
        .logo{
            width: 50%;
        }

        .row{
            display: flex;
            flex-wrap: wrap;
        }
        .col-6{
            width: 40%;
            flex: 0 0 auto;
        }
        .col-2{
            width: 20%;
            flex: 0 0 auto;
        }
        .text-white{
            color: #fff;
        }
        .company-details{
            float: right;
            text-align: right;
        }
        .body-section{
            padding: 16px;
            border: 1px solid gray;
        }
        .heading{
            font-size: 20px;
            margin-bottom: 08px;
        }
        .sub-heading{
            color: #262626;
            margin-bottom: 05px;
        }
        table{
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }
        table thead tr{
            border: 1px solid #111;
            background-color: #f2f2f2;
        }
        table td {
            vertical-align: middle !important;
          //  text-align: center;
        }
        table th, table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }
        .table-bordered{
            box-shadow: 0px 0px 5px 0.5px gray;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
            text-align:center;
        }
        .text-right{
            text-align: end;
        }
        .w-20{
            width: 20%;
        }
        .float-right{
            float: right;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="brand-section">
        <div class="row">
            <div class="col-6">
                <h3>{{$profile->name}}</h3>
                <p>{{$profile->address}}</p>
                <p>Phone no.:{{$profile->mobile}}</p>
                <!-- <p>GSTIN:09AAUPF8401A2ZU</p> -->
                <p>State: {{$profile->state}}</p>
            </div>

        </div>
    </div>
   <center><h2 style="color: #e51d18;"><?php echo $userdata->service_id==5 ? "Tax Invoice":'Estimate'?></h2></center>

   <div class="col-12">
       
            <div class="col-6">
                <h4>Bill To:</h4>
                <p style="font-weight: bold; text-transform: uppercase;">{{$userdata->name}}</p> 
				 <p>{{$userdata->address}}</p>
               {{-- <p>SECTOR-7, IIE, SIDCUL,</p>
                <p>HARIDWAR ,UK</p>--}}
                <p>Contact No.: {{$userdata->mobile}}</p>
                <p>GSTIN Number:{{$userdata->gst_no}}</p>
                 {{--<p>State 05-Uttarakhand</p>--}}
            </div>
            <div class="col-6"  style="position: fixed;left: 450px;top: 170px;"><br/>
			 {{-- <p>Place of Supply:05-Uttarakhand</p>--}}
                <p style="font-weight: bold">Invoice No:TF00{{$userdata->invoiceno}}</p>
                <p style="font-weight: bold">Date: {{date('d-m-Y',strtotime($userdata->service_date))}}</p>
            </div>
            <?php  $totalamount=0;$sr=1;$qtyy=0;$gstamount=0;?>
    </div>
        <br>
        <table class="table-bordered">
            <thead>
            <tr style="background-color: #e51d18;color: white">
                <th>#</th>
                <th>Item Name</th>
                <th>HSN/SAC</th>
                <th>Quantity</th>
                <th>Price/unit</th>
                <th>GST</th>
                <th>Amount</th>
				{{--  <th class="w-20">Quantity</th>--}}
            </tr>
            </thead>
            <tbody>
                
            @foreach($data as $datas)
                  <?php $amt=$datas->amt;?>
                  <?php  $qty=$datas->qty;?>
                  <?php  $gst=$datas->gst;
                   $qtyy+=$qty;
                  
                  ?>
             
        <?php $gstamount= (($amt *$qty) * $gst)/100;?>
        @if($data)            
           <?php  $totalamount += ($amt*$qty) + $gstamount;?> 
           <?php  $minamt = ($amt*$qty) + $gstamount;?>                
        @endif
        
            <tr>
                <td>{{$sr++}}</td>
                <td>{{$datas->pname}}</td>
                <td></td>
                <td>{{$qty}}</td>
                <td>{{$datas->amt}}</td>
                <td>{{$gstamount}}<br>({{$gst}}%)</td>
                <td>{{$minamt}}</td>
            </tr>
            @endforeach
            <tr style="font-weight: bold">
                <td></td>
                <td class="text-right">Total</td>
                <td></td>
                <td>{{$qtyy}}</td>
                <td></td>
                <td >{{$gstamount}}</td>
                <td>{{$totalamount}}</td>
            </tr>
 
           {{-- <tr>
                <td></td>
                <td colspan="3" class="text-right">Sub Total</td>
                <td> 10.XX</td>
            </tr>
            <tr>
                <td colspan="3" class="text-right">Tax Total %1X</td>
                <td> 2</td>
            </tr>
            <tr>
                <td colspan="3" class="text-right">Grand Total</td>
                <td> 12.XX</td>
            </tr>--}}
            </tbody>
        </table>
        <br><br/>
        <br><br/><br><br/>     
    <table style="width:100%;text-align:left;">
        <td>
          <b>INVOICE AMOUNT IN WORDS</b>
          <p class="ownp">
              
          <?php
          $number=$totalamount+$gstamount; 
  /**
   * Created by PhpStorm.
   * User: sakthikarthi
   * Date: 9/22/14
   * Time: 11:26 AM
   * Converting Currency Numbers to words currency format
   */
//$number = 190908100.25;
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  echo $result . "Rupees  " . $points . " ";
 ?>                           
              </P>
          <b>TERM AND CONDITIONS </b>
          <p class="ownp">Thank you For doing bussiness with <br/>{{$profile->name}}</p>
      </td>
         <td></td>
        <td>
         <b>Sub Total</b><b style="float:right;">    <i class="fa fa-inr" aria-hidden="true"></i> {{$totalamount}}</b> <br/>
         <b>IGST@  {{$gst}}</b ><b style="float:right;">  <i class="fa fa-inr" aria-hidden="true"></i> {{$gstamount}} </b><br/>
         <div style="padding:5px;background:red;color:#fff;"><b>Total </b><b style="float:right;"><i class="fa fa-inr" aria-hidden="true"></i> {{$totalamount+$gstamount}}</b></div>   
         <b>Received</b><b style="float:right;">    <i class="fa fa-inr" aria-hidden="true"></i> 0.00</b> <br/>
         <b>balance</b><b style="float:right;">    <i class="fa fa-inr" aria-hidden="true"></i> {{$totalamount+$gstamount}}</b> <br/>
         <b>Payment Mode</b><b style="float:right;">   Credit</b> 
    </td>
    </table>
       <br/> 
    <div class="row">
        <div class="col-6">
            <b>Pay To -</b>
            <p>Bank Name : {{$profile->bank_name}}</p>
            <p>Bank Account NO.: {{$profile->account_no}}</p>
            <p>Bank IFSC Code: {{$profile->ifsc_code}}</p>
        </div>
    </div>

    <br/> 



       {{-- <h3 class="heading">Payment Status: Paid</h3>
        <h3 class="heading">Payment Mode: Cash on Delivery</h3>


    <div class="body-section">
        <p>&copy; Copyright 2021 - Fabcart. All rights reserved.
            <a href="https://www.fundaofwebit.com/" class="float-right">www.fundaofwebit.com</a>
        </p>
    </div>--}}
</div>

</body>
</html>
