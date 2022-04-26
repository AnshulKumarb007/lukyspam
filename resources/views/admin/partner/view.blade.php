@extends('layouts.admin')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Partner </h1>
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
            <div class="card">
              <div class="card-header">
               <div class="row">
						 <div class="col-3">
                         <a href="{{route('partner.create')}}" class="btn btn-primary">Add Partner</a>
                         </div>
               </div>
            </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Experience</th>
                    <th>Partner Type</th>
                    <th>Image</th>
                   <th>Job Profile</th>
                    <th>Rating</th>
                    <th>Status</th>
                   <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
				@foreach($partners as $partner)
                  <tr>
					  <td>{{$partner->name}}</td>
					  <td>{{$partner->mobile}}</td>
					  <td>{{$partner->experience}}</td>
					  <td>{{$partner->partner_type}}</td>
                      <td><img src="{{$partner->image}}" height="80px" width="80px"/></td>
                      <td>{{$partner->jobprofile->name??''}}</td>
                      <td>{{$partner->rating}}</td>
                      <td>@if($partner->status==1){{'Active'}}@else{{'Inactive'}}@endif</td>
                      <td>
                          <a href="{{route('partner.edit',['id'=>$partner->id])}}" class="btn btn-success">Edit</a>
                          <a href="{{route('partner.details',['id'=>$partner->id])}}" class="btn btn-info">Details</a>
                          <a href="{{route('partner.services',['id'=>$partner->job_profile_id,'partner_id'=>$partner->id])}}" class="btn btn-primary">services</a>
                      </td>
                 </tr>
                 @endforeach
                  </tbody>
                </table>
              </div>
              {{$partners->appends(request()->query())->links()}}
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

