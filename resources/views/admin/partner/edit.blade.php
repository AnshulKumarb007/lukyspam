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
                <h3 class="card-title">Partner Update</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" enctype="multipart/form-data" action="{{route('partner.update',['id'=>$partner->id])}}">
                 @csrf
                  <div class="card-body">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Name</label>
                                  <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Name" value="{{$partner->name}}" required>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Mobile</label>
                                  <input type="text" name="mobile" class="form-control" id="exampleInputEmail1" placeholder="Enter Mobile" value="{{$partner->mobile}}" >
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Experience</label>
                                  <input type="text" name="experience" class="form-control" id="exampleInputEmail1" placeholder="Enter Experience" value="{{$partner->experience}}" required>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Partner Type</label>
                                  <select name="partner_type" class="form-control" required >
                                      <option value="">Select Type</option>
                                      <option value="own" {{$partner->partner_type=='own'?'selected':''}}>Own</option>
                                      <option value="special" {{$partner->partner_type=='special'?'selected':''}}>Special</option>

                                  </select>
                              </div>
                          </div>

                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Job Profile</label>
                                  <select name="job_profile_id" class="form-control"  required >
                                      <option value="">Please Select Job Profile</option>
                                      @foreach($category as $cat)
                                          <option value="{{$cat->id}}"{{$partner->job_profile_id==$cat->id?'selected':''}}>{{$cat->name}}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Only For Carpenter</label>
                                  <select name="carpenter_id[]"  class="form-control select2" id="exampleInputistop" data-placeholder="Select a Carpenter" multiple>
                                      <option value="">Please Select Job Profile</option>
                                      @foreach($carpenters as $carpenter)
                                          <option value="{{$carpenter->id}}" @foreach($partner->partnerJob as $s) @if($s->id==$carpenter->id){{'selected'}}@endif @endforeach >
                                              {{$carpenter->name}}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Rating</label>
                                  <input type="number" name="rating" class="form-control" id="exampleInputEmail1" placeholder="Enter Rating" step="any" min="0" value="{{$partner->rating}}">
                              </div>
                          </div>

                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Status</label>
                                  <select class="form-control" name="status" required>
                                      <option  selected="selected" value="1" {{$partner->status==1?'selected':''}}>Active</option>
                                      <option value="0" {{$partner->status==0?'selected':''}}>Inactive</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Lat</label>
                                  <input type="number" name="lat" class="form-control" id="exampleInputEmail1" placeholder="Enter Lat" step="any" min="0" value="{{$partner->lat}}">
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Lang</label>
                                  <input type="number" name="lang" class="form-control" id="exampleInputEmail1" placeholder="Enter Lang" step="any" min="0" value="{{$partner->lang}}">
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputFile">Profile Image</label>
                                  <div class="input-group">
                                      <div class="custom-file">
                                          <input type="file" name="image" class="form-control" id="exampleInputFile" accept="image/*">
                                      </div>
                                  </div>
                              </div>
                              <img src="{{$partner->image}}" height="100px" width="100px" >
                          </div>

                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputFile">Work image</label>
                                  <div class="input-group">
                                      <div class="custom-file">
                                          <input type="file" name="work_image" class="form-control" id="exampleInputFile" accept="image/*">
                                      </div>
                                  </div>
                              </div>
                              <img src="{{$partner->work_image}}" height="100px" width="100px" >
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Residance</label>
                                  <input type="text" name="residance" class="form-control" id="exampleInputEmail1" placeholder="Enter Residance" value="{{$partner->residance}}">
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Password</label>
                                  <input type="text" name="password" class="form-control" id="exampleInputEmail1" placeholder="Enter New Password">
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
      <section class="content">
          <div class="container-fluid">
              <div class="row">
                  <!-- left column -->
                  <div class="col-md-12">
                      <!-- general form elements -->
                      <div class="card card-primary">
                          <div class="card-header">
                              <h3 class="card-title">Add Document Images</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          <form role="form" method="post" enctype="multipart/form-data" action="{{route('partner.document',['id'=>$partner->id])}}">
                              @csrf
                              <div class="card-body">
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="exampleInputFile">File input</label>
                                              <div class="input-group">
                                                  <div class="custom-file">
                                                      <input type="file" name="document[]" class="form-control" id="exampleInputFile" multiple>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- /.card-body -->
                                  <div class="form-group">
                                      <button type="submit" class="btn btn-primary">Submit</button>
                                  </div><br>

                                  <div class="card-footer">
                                      <div class="row">
                                      @foreach($partner->gallery as $d)
                                          <div class="form-group">
                                              <img src="{{$d->file_path}}" height="100" width="200"> &nbsp; &nbsp; <a href="{{route('partner.document.delete',['id'=>$d->id])}}">X</a>
                                              &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;          &nbsp; &nbsp; &nbsp; &nbsp;
                                          </div>
                                      @endforeach
                                  </div>
                                  </div>
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

