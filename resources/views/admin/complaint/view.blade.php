@extends('layouts.admin')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Complaint</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">DataTables</li>
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
                                {{-- <a href="{{route('banners.create')}}" class="btn btn-primary">Add Banner</a>--}}

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Order</th>
                                        <th>Partner</th>
                                        <th>Title</th>
                                        <th>Message</th>
                                        <th>SendBy</th>
                                        <th>Date & Time</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($complaints as $complaint)
                                        <tr>
                                            <td>{{$complaint->customer->name??''}}</td>
                                            <td>
                                                <b>OrderID:-</b> {{$complaint->order->refid??''}}<br>
                                                <b>Date:-</b>
                                                {{date('jS M Y',strtotime($complaint->order->created_at??''))}}
                                            </td>
                                            <td>
                                                <b>Name:-</b> {{$complaint->partner->name??''}}<br>
                                                <b>Job Profile:-</b>
                                                {{$complaint->partner->jobprofile->name??''}}
                                            </td>
                                            <td>{{$complaint->title}}</td>
                                            <td>{{$complaint->message}}</td>
                                            <td>{{$complaint->type}}</td>
                                            <td>{{date('jS M Y',strtotime($complaint->created_at))}}</td>
                                            <td>
                                                @if($complaint->type=='USER')
                                                <a href="{{route('complaint.send',['id'=>$complaint->id])}}" class="btn btn-success">Send</a>
                                                @else
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-header">
                                 {{$complaints->appends(request()->query())->links()}}
                            </div>
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

