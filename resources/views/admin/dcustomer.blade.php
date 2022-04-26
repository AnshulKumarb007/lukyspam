@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Vendor Details</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <div class="card-body">  
           <div class="row"> 
           <table id="example2" class="table table-bordered table-hover">
                  <tr>
                      <td>Name : -</td>
                      <td>{{$details->name}}</td>
                     
                  </tr>
                    <tr>
                         <td>Mobile : -</td>
                      <td>{{$details->mobile}}</td>
                    </tr>
                  <tr>
                      <td>Email : -</td>
                      <td>{{$details->email}}</td>
                     
                  </tr>
                     <tr>
                      <td>Company Name : -</td>
                      <td>{{$details->company_name}}</td>
                     
                  </tr>

                 <tr>
                       <td>Address : -</td>
                      <td>{{$details->address}}</td>
                     
                  </tr>
                  
                <!--<tr>-->
                <!--     <td>Address : -</td>-->
                <!--      <td>{{$details->address}}</td>-->
                <!--</tr>-->
                

                 

                  <!--<tr>-->
                  <!--    <td>Bank Address : -</td>-->
                  <!--    <td>{{$details->bank_address}}</td>-->
                  <!--    <td>IFSC Code : -</td>-->
                  <!--    <td>{{$details->ifsc_code}}</td>-->
                  <!--</tr>-->


                  <!--<tr>-->
                  <!--    <td>Account No. : -</td>-->
                  <!--    <td>{{$details->account_no}}</td>-->
                  <!--    <td>State : -</td>-->
                  <!--    <td>{{$details->state}}</td>-->
                  <!--</tr>-->
 

                  <!--<tr>-->
                  <!--    <td>GST : -</td>-->
                  <!--    <td>{{$details->gst}}</td>-->
                      <!-- <td>Invoice No</td>
                  <!--    <td>{{$details->invoiceno}}</td> -->
                  <!--</tr>-->


                   
 


            </table>
            </div> 
          </div>
        </div>

@endsection 
@section('scripts') 
@endsection
