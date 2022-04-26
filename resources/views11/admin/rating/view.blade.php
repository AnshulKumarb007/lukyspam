@extends('layouts.admin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Rating </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Rating</li>
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
                        <div class="card card-primary">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-3">
                                        <h3 class="card-title">Rating</h3>
                                    </div>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>OrderID</th>
                                        <th>Partner Name</th>
                                        <th>Rating</th>
                                        <th>Text</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($ratings as $rating)
                                        <tr>
                                            <td>{{$rating->customer->name??''}}</td>
                                            <td>{{$rating->order->refid??''}}</td>
                                            <td>{{$rating->partner->name??''}}</td>
                                            <td>{{$rating->rating}}</td>
                                            <td>{{$rating->text}}</td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        {{$ratings->appends(request()->query())->links()}}
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

