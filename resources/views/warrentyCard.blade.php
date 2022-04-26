 
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>One Solutions</title>
    <style>
        .text-center{
            text-align:center;
        }
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
            padding-bottom:10px;
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
        /* div.b {
        text-decoration-line: underline;
        text-decoration-style: wavy;
        } */
    </style>
</head>
<body>

<div class="container">
    <br/><br/>
   <center><h1 style="color: #e51d18;font-size:5em">{{$data->company_namea}}</h1></center>
        <br/>

        <div class="row">
        <div class="col-6"> <h2 style="color: #e51d18;"> Warranty Card</h1></div>
                      
        </div>
        
        <div class="row">
        <div class="col-12">
                <p style="text-align:right"><b>Customer Reference No. ....{{$data->id}}......</b></p>
            </div> 
        </div>
        <br/>
        <div class="row">
            <div class="col-12"><h4>Name  <b>........{{$data->name}} ....................</b></h4> </div>
        </div>
        <div class="row"> 
            <div class="col-12"><h4>Address <b>..{{$data->address}}.......... </b></h4> </div>
        </div>

        <div class="row">
            <div class="col-12"><h4>Phone  <b>..{{$data->mobile}}.........................</b></h4> </div>
        </div>

        <div class="row">
            <div class="col-12"><h4>Contact Person .........<b>{{$data->contact_person}}..........</b></h4> </div>
             
        </div>
        
         <div class="row"> 
            <div class="col-12" style="text-align:right"><h4><b>Dealar's Stamp </b></h4> </div>
        </div>
        
        
            <br/><br/> 
            <div class="row">
            
            <div class="col-12"  style="text-align:right"><h4><b>& Signature </b></h4> </div>
            <br/><br/> 
        </div>

        <div class="row">
            <div class="col-12">
             <h4>Model:-  <b>.....{{$data->model}}....</b> InvoiceNo :-    <b>......{{$data->invoiceno}}...... </b> Date Of Installation :-  ..... <b>{{$data->created_at}}..........</b> SL. No of Machine :-  ...... <b>{{$data->NumberOfMachine}}..........</b> Raw Water condition :-  ....... <b>{{$data->rawwatercondition}}..........</b> SL. No of Pump :-  ......<b>{{$data->NumberOfMachine}}.......</b></h4>  
            </div>
           
        </div>
       
          
    <br/><br/>
        <div class="row">
            <div class="col-12">
             <h4>Remarks  ................... <b>{{$data->remarks}}..........</b></h4>  
            </div></div>
            <br/><br/>
            <div class="row">
            <div class="col-12">
            <h4>No Of membrane  ................... <b>{{$data->numberofmembrane}}..........</b></h4>  
            </div>
        </div>


       
       
</div>

</body>
</html>
