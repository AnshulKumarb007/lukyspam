@extends('layouts.admin')
@section('content')

    <link rel="stylesheet" href="{{asset('admin-theme/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('../admin-theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Partner</h1>
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
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Partner Add</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" enctype="multipart/form-data" action="{{route('partner.store')}}">
                 @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mobile</label>
                                <input type="text" name="mobile" class="form-control" id="exampleInputEmail1" placeholder="Enter Mobile" required >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Experience</label>
                                <input type="text" name="experience" class="form-control" id="exampleInputEmail1" placeholder="Enter Experience" required >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Partner Type</label>
                                <select name="partner_type" class="form-control" required >
                                    <option value="">Select Type</option>
                                    <option value="own">Own</option>
                                    <option value="special">Special</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="exampleInputFile">Profile Image</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" name="image" class="form-control" id="exampleInputFile" accept="image/*" >
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputFile">Work Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="work_image" class="form-control" id="exampleInputFile" accept="image/*" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1"> Job Profile</label>
                                <select name="job_profile_id" class="form-control"  required >
                                    <option value="">Please Select Job Profile</option>
                                    @foreach($category as $cat)
                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Rating</label>
                                <input type="number" name="rating" class="form-control" id="exampleInputEmail1" placeholder="Enter Rating" step="any" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Only For Carpenter</label>
                                <select name="carpenter_id[]"  class="form-control select2" id="exampleInputistop" data-placeholder="Select a Carpenter" multiple>
                                    <option value="">Please Select Job Profile</option>
                                    @foreach($carpenters as $carpenter)
                                        <option value="{{$carpenter->id}}">
                                            {{$carpenter->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1"> Status</label>
                                <select name="status" class="form-control"  required >
                                    <option value="">Please Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Residance</label>
                                <input type="text" name="residance" class="form-control" id="exampleInputEmail1" placeholder="Enter Residance" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Lat</label>
                                <input type="number" name="lat" class="form-control" id="exampleInputEmail1" placeholder="Enter Lat" step="any" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Lang</label>
                                <input type="number" name="lang" class="form-control" id="exampleInputEmail1" placeholder="Enter Lang" step="any" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="text" name="password" class="form-control" id="exampleInputEmail1" placeholder="Enter Password">
                            </div>
                        </div>
                    </div>
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

@section('scripts')
    <script src="{{asset('admin-theme/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('admin-theme/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
            $('#category_id_sel').select2();
        });
    </script>

@endsection


