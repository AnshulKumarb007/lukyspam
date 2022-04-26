@extends('layouts.admin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Partner KYC Details </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Partner</li>
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
                                        <h3 class="card-title">Partner KYC Details</h3>
                                    </div>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>KYC Details</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>First Name</td>
                                            <td>{{$partner->first_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Last Name</td>
                                            <td>{{$partner->last_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Image</td>
                                            <td><img src="{{$partner->image}}" height="80px" width="80px"/></td>
                                        </tr>
                                        <tr>
                                            <td>Aadhar Number</td>
                                            <td>{{$partner->aadhar_number}}</td>
                                        </tr>
                                        <tr>
                                            <td>Aadhar Contact</td>
                                            <td>{{$partner->aadhar_contact}}</td>
                                        </tr>
                                        <tr>
                                            <td>Aadhar Front</td>
                                            <td>
                                                @if($partner->aadhar_front != null)
                                                <a href="{{$partner->aadhar_front}}" class="btn btn-warning">View</a>
                                                @else{{'No Image'}}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Aadhar Back</td>
                                            <td>
                                                @if($partner->aadhar_back != null)
                                                <a href="{{$partner->aadhar_back}}" class="btn btn-warning">View</a>
                                                @else{{'No Image'}}
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>

    </div>
    <!-- ./wrapper -->
@endsection

