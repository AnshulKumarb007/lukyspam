@extends('layouts.admin')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category</h1>
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
                    <th>Parent Name</th>
                    <th>Isactive</th>
                   <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
				@foreach($datas as $data)
                  <tr>
                      <td>{{$data->name}}</td>
                      <td>
                          <img src="{{$data->image}}" height="80px" width="80px"/></td>

                      <td>@if($data->parent_id!=null){{$data->parentname->name}}@endif</td>
                       <td>
                        @if($data->isactive==1)
                               <span style="color:green">Yes</span>
                             @else
                               <span style="color:red">No</span>
                             @endif
                        </td>
                      <td>
                          @if($data->flag==0 && $data->parent_id!=null)
                              <a href="{{route('category.service.list',['id'=>$data->id])}}" class="btn btn-primary">Services</a>
                          @endif
                          <a href="{{route('category.edit',['id'=>$data->id])}}" class="btn btn-success">Edit</a>&nbsp;&nbsp;
                      </td>
                 </tr>
                 @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                      <th>Name</th>
                      <th>Image</th>
                      <th>Parent Name</th>
                      <th>Isactive</th>
                      <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
                <div class="card-header">
           {{-- {{$datas->appends(request()->query())->links()}}--}}
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

