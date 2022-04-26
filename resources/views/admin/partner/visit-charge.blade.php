@extends('layouts.admin')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('../admin-theme/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('../admin-theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{$datas->name}}</h1>
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
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card">
{{--                            <div class="card-header">--}}
{{--                                <h3 class="card-title">Payment Add</h3>--}}
{{--                            </div>--}}
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" enctype="multipart/form-data"
                                  action="{{route('partner.visit.store',['id'=>$datas->id??''])}}">
                                @csrf
                                <div class="card-body">
                                    <input type="hidden" name="partner_id" value="{{$partner_id}}">
                                    @if($datas->type=='select')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Visit Charge</label>
                                                    <input type="number" name="visit_charge" class="form-control"
                                                           id="exampleInputEmail1" placeholder="Enter Visit Charge"
                                                           min="0" value="{{$visitcharge->visit_charge??0}}">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    @elseif($datas->type=='area')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Area Charge</label>
                                                    <input type="number" name="area_charge" class="form-control"
                                                           id="exampleInputEmail1" placeholder="Enter Area Charge"
                                                           min="0" value="{{$visitcharge->area_charge??0}}">
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                @else
                                    <div class="card-body">
                                        <table id="example2" class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>Service Name</th>
                                                <th>Unit Charge/Installation</th>
                                                <th>Uninstallation</th>
                                                <th>Repair</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($services as $key=>$service)

                                                <tr id="row{{$service->id}}">
                                                    <td id="name{{$service->id}}">{{$service->name}}</td>
                                                    <td id="installation{{$service->id}}">{{$services[$key]->servicecharge[0]->installation??0}}</td>
                                                    <td id="uninstallation{{$service->id}}">{{$services[$key]->servicecharge[0]->uninstallation??0}}</td>
                                                    <td id="repair{{$service->id}}">{{$services[$key]->servicecharge[0]->repair??0}}</td>
                                                    <td>
                                                        <input type="button" id="edit_button{{$service->id}}"
                                                               value="Edit"
                                                               class="btn btn-success"
                                                               onclick="edit_row({{$service->id}})"><br><br>
                                                        <input type="button" id="save_button{{$service->id}}"
                                                               value="Save"
                                                               class="btn btn-success"
                                                               onclick="save_row({{$service->id}},{{$partner_id}},{{$datas->id}})">
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                @endif
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
    {{--  <script src="{{asset('admin-theme/plugins/select2/js/select2.full.min.js')}}"></script>
      <script src="{{asset('admin-theme/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>--}}

    {{--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        function edit_row(no) {
            document.getElementById("edit_button" + no).style.display = "none";
            document.getElementById("save_button" + no).style.display = "block";

            var installation = document.getElementById("installation" + no);
            var uninstallation = document.getElementById("uninstallation" + no);
            var repair = document.getElementById("repair" + no);

            var installation_data = installation.innerHTML;
            var uninstallation_data = uninstallation.innerHTML;
            var repair_data = repair.innerHTML;

            installation.innerHTML = "<input type='text' style='width:70px;' id='installation_text" + no + "' value='" + installation_data + "'>";

            uninstallation.innerHTML = "<input type='text' style='width:70px;' id='uninstallation_text" + no + "' value='" + uninstallation_data + "'>";

            repair.innerHTML = "<input type='text' style='width:70px;' id='repair_text" + no + "' value='" + repair_data + "'>";

        }

        function save_row(no,partnerId,categoryId) {

            var installation_val = document.getElementById("installation_text" + no).value;
            var uninstallation_val = document.getElementById("uninstallation_text" + no).value;
            var repair_val = document.getElementById("repair_text" + no).value;

            $.ajax({
                url: "{{route('partner.update.charges')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "service_id": no,
                    "partner_id": partnerId,
                    "cat_id": categoryId,
                    "instcharg": installation_val,
                    "uninstallation": uninstallation_val,
                    "repair": repair_val,
                },
                cache: false,
                success: function (data) {
                    // alert(data)
                    window.location.reload();
                    $('#message').html("<h2>Service Charge has been updated!</h2>")
                }

            });
        }
    </script>
@endsection


