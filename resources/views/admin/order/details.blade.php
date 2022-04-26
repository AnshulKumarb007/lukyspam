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
                                    <th>Name</th>
                                   {{-- <th>Nos</th>
                                    <th>Window</th>
                                    <th>Split</th>
                                    <th>Ton</th>--}}

                                    <th>Installation</th>
                                    <th>UnInstallation</th>
                                    <th>Repair</th>
                                    {{--<th>Replacement</th>--}}
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orderdetails as $detail)
                                    <tr>
                                        <td>{{$detail->name}}</td>
                                      {{--  <td>{{$detail->nos}}</td>
                                        <td>{{$detail->window}}</td>
                                        <td>{{$detail->split}}</td>
                                        <td>{{$detail->ton}}</td>--}}

                                        <td>{{$detail->installation}}</td>
                                        <td>{{$detail->uninstallation}}</td>
                                        <td>{{$detail->repair}}</td>
                                        {{--<td>{{$detail->Replacement}}</td>--}}
                                        <td>
                                            <a href="{{route('orders.image',['id'=>$detail->id])}}" class="btn btn-warning">View Image</a>

                                        </td>

                                    </tr>
                                @endforeach
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
