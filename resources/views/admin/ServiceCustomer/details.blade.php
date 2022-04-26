@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Service Customer Details</h1>
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
                      <td>Name</td>
                      <td>{{$details->name}}</td>
                     
                  </tr>
                  
                  <tr>
                       <td>Mobile</td>
                      <td>{{$details->mobile}}</td>
                  </tr>
                  <tr>
                      @if(@$details->service->title=='Sale'??'-')
                       <td>Type</td>
                      <td>{{$details->type}}</td>
                      @else
                       <td>Type</td>
                      <td>{{$details->product_name}}</td>
                      @endif
                  </tr>
                  
                  <tr>
                       <td>Address</td>
                      <td>{{$details->address}}</td>
                  </tr>
                  
                  <tr>
                      <td>Amount</td>
                      <td>{{$details->amount}}</td>
                  </tr>
                  
                  <tr>
                      <td>Notify date</td>
                      <td>{{$details->service_date}}</td>
                  </tr>
                  
                   <tr>
                      <td>Date</td>
                      <td>{{date('d-m-Y', strtotime($details->created_at))}}</td>
                  </tr>
                  
                    
                  <!--<tr>-->
                  <!--    <td>Type</td>-->
                  <!--    <td>{{$details->type}}</td>-->
                  <!--    <td>Description</td>-->
                  <!--    <td>{{$details->description}}</td>-->
                  <!--</tr>-->

                  <!--<tr>-->
                  <!--    <td>Service</td>-->
                  <!--    <td>{{$details->service->title ?? ''}}</td>-->
                  <!--    <td>Date</td>-->
                  <!--    <td>{{$details->created_at}}</td>-->
                  <!--</tr>-->

                  <!--<tr>-->
                  <!--    <td>GST</td>-->
                  <!--    <td>{{$details->gst_no}}</td>-->
                  <!--    <td>Address</td>-->
                  <!--    <td>{{$details->address}}</td>-->
                  <!--</tr>-->


                  <!--<tr>-->
                  <!--    <td>GST</td>-->
                  <!--    <td>{{$details->gst_no}}</td>-->
                  <!--    <td>Address</td>-->
                  <!--    <td>{{$details->address}}</td>-->
                  <!--</tr>-->


                  <!--<tr>-->
                  <!--    <td>Amount</td>-->
                  <!--    <td>{{$details->amount}}</td>-->
                  <!--    <td>QTY</td>-->
                  <!--    <td>{{$details->quantity}}</td>-->
                  <!--</tr>-->


                  <!--<tr>-->
                  <!--    <td>GST Percentage</td>-->
                  <!--    <td>{{$details->gst_per}}</td>-->
                  <!--    <td>Product Name</td>-->
                  <!--    <td>{{$details->product_name}}</td>-->
                  <!--</tr>-->



                  <!--<tr>-->
                  <!--    <td>Notify date</td>-->
                  <!--    <td>{{$details->notifydate}}</td>-->
                  <!--    <td>Invoice No</td>-->
                  <!--    <td>{{$details->invoiceno}}</td>-->
                  <!--</tr>-->


                  <!--<tr>-->
                  <!--    <td>Contact Person</td>-->
                  <!--    <td>{{$details->contact_person}}</td>-->
                  <!--    <td>Remarks</td>-->
                  <!--    <td>{{$details->remarks}}</td>-->
                  <!--</tr>-->


                  <!--<tr>-->
                  <!--    <td>No Of Member</td>-->
                  <!--    <td>{{$details->numberofmembrane}}</td>-->
                  <!--    <td>Invoice No</td>-->
                  <!--    <td>{{$details->outletwaterconditon}}</td>-->
                  <!--</tr>-->


                  <!--<tr>-->
                  <!--    <td>Condition</td>-->
                  <!--    <td>{{$details->rawwatercondition}}</td>-->
                  <!--    <td>Machine No</td>-->
                  <!--    <td>{{$details->NumberOfMachine}}</td>-->
                  <!--</tr>-->


                  <!--<tr>-->
                  <!--    <td>Model</td>-->
                  <!--    <td>{{$details->model}}</td>-->
                  <!--    <td>Company Name</td>-->
                  <!--    <td>{{$details->company_namea}}</td>-->
                  <!--</tr>-->


                  


                  












            </table>
            </div> 
          </div>
        </div>

@endsection 
@section('scripts') 
@endsection
