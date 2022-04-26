@extends('layouts.admin')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('orders.list')}}">Order </a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Order Detail</h3>
                        </div>

                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>First Image</th>
                                    <th>Second Image</th>
                                    <th>Third Image</th>
                                    <th>Fourth Image</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="{{$orderimage->image1}}" height="100px" width="200px"/>
                                        </td>
                                        <td>
                                            <img src="{{$orderimage->image2}}" height="100px" width="200px"/>
                                        </td>
                                        <td>
                                            <img src="{{$orderimage->image3}}" height="100px" width="200px"/>
                                        </td>
                                        <td>
                                            <img src="{{$orderimage->image4}}" height="100px" width="200px"/>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->

    </div>



@endsection
