@extends('layouts.admin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Orders </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Orders</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
{{--                                    <div class="col-3">--}}
{{--                                        <h3 class="card-title">Orders</h3>--}}
{{--                                    </div>--}}

                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Order no</th>
                                        <th>OrderID</th>
                                        <th>Customer Name</th>
                                        <th>Type</th>
                                        <th>Category Name</th>
                                        <th>Status</th>
                                        <th>Partner Name</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->refid}}</td>
                                            <td>{{$order->customer->name??''}}</td>
                                            <td>{{$order->type}}</td>
                                            <td>{{$order->category->name??''}}</td>
                                            <td>{{$order->status}}</td>
                                            <td>{{$order->partner->name??''}}</td>
                                            <td>
                                                <a href="{{route('orders.details',['id'=>$order->id])}}" class="btn btn-primary">Details</a>

                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        {{$orders->appends(request()->query())->links()}}
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
@endsection

