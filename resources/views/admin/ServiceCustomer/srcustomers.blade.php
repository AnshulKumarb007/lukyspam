@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Service Customers</h1>
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

     <div class="col-md-6">
            <form role="form" method="get"  action="{{route('srcustomers',['id'=>$id])}}">
            @csrf
            <div class="row">
            <div class="col-md-12">
                    <div class="form-group">
                        <label>Type</label>
                            <select name="type" class="form-control">
                                <option value="1">Mobile</option>
                                <option value="2">Name</option>
                            </select>
                    </div>                                   
                    <div class="form-group">
                        <label>value</label>
                        <input type="text" name="value" class="form-control">
                    </div>
                    <div class="form-group"> 
                        <button type="submit" name="searchxx"  class="btn btn-danger">Search</button>                 
                    </div> 
            </div>


            </div>
            </form>
    </div> 
    <div class="col-md-6">
        <br/>    
    <h1>Total Customers - {{$count}}</h1></div> 

                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>SR</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Service</th>
                    <th>Vendor Name</th>                    
                   <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php $sr=1; ?>
				  @foreach($srcustomerss as $data)
                  <tr>
                      <td>{{$sr++}}</td>
                      <td>{{$data->name}}</td>
                      <td>{{$data->mobile}}</td>
                      <td>{{$data->service->title ??''}}</td> 
                      <td>{{$data->vendors->name ??''}}</td>  
                      <td><a href="{{route('service-customers-details',['id'=>$data->id])}}" class="btn btn-warning">View</a></td>                      
                 </tr>
                 @endforeach
                  </tbody>
                  <tfoot>
                      <tr>
                        <td colspan="6"> {{$srcustomerss->appends(request()->input())->links()}}</td>
                    </tr>
                  </tfoot>
                </table>
              </div>

    </div>

@endsection

@section('scripts')

     

@endsection
