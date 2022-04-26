@extends('layouts.admin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @if($datas->count()>0)
                            <h1>{{$datas[0]->parentname->name??''}}</h1>
                        @else
                            <h1>Services Not Available</h1>
                        @endif
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
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Isactive</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($datas as $data)
                                        <tr>
                                            <td>{{$data->name}}</td>
                                            <td>@if($data->image)
                                                    <img src="{{$data->image}}" height="80px" width="80px"/>
                                                @endif
                                            </td>
                                            <td>
                                                @if($data->isactive==1)
                                                    <span style="color:green">Yes</span>
                                                @else
                                                    <span style="color:red">No</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($data->type=='select')
                                                    <a href="{{route('partner.visit',['id'=>$data->id,'partner_id'=>$partner_id])}}" class="btn btn-success">Select</a>
                                                    @elseif($data->type=='nos')
                                                    <a href="{{route('partner.visit',['id'=>$data->id,'partner_id'=>$partner_id])}}" class="btn btn-success">Nos</a>
                                                @else
                                                    <a href="{{route('partner.visit',['id'=>$data->id,'partner_id'=>$partner_id])}}" class="btn btn-success">Area</a>
                                                    @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
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

