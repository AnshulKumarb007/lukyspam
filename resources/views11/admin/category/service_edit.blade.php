@extends('layouts.admin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Service Update</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Service Update</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Service Update</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" enctype="multipart/form-data" action="{{route('category.service.update',['id'=>$data->id])}}">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Enter Name" value="{{$data->title}}">
                                    </div>

                                    <div class="form-group">
                                        <label>Is Active</label>
                                        <select class="form-control" name="isactive" required>
                                            <option  selected="selected" value="1" {{$data->isactive==1?'selected':''}}>Yes</option>
                                            <option value="0" {{$data->isactive==0?'selected':''}}>No</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <input type="file" name="image" class="form-control" id="exampleInputFile" accept="image/*" >
                                    </div>
                                    <img src="{{$data->image}}" height="100" width="200">

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->


    </div>
    <!-- ./wrapper -->
@endsection

