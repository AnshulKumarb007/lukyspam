@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Vendors</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <div class="card-body">


        <div class="row">
<div class="col-md-10">
    <form role="form" method="get"  action="{{route('home')}}">
        @csrf
        <div class="row">

        <div class="col-md-6">
                    <div class="form-group">
                        <label>Type</label>
                            <select name="type" class="form-control">
                                <option value="1">Mobile</option>
                                <option value="2">Name</option>
                            </select>
                    </div>
                    <!-- /.form-group -->
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label>value</label>
                        <input type="text" name="value" class="form-control">
                    </div>
                    <!-- /.form-group -->
                </div>


            <div class="col-md-4">
                <div class="form-group"> 
                    <button type="submit" name="searchxx"  class="btn btn-danger">Search</button>
                    <a href="{{Route('partner-exports')}}" class="btn btn-success float-right">Download List</a>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                      <th>SR</th> 
                    <th>Name</th>
                    <th>Mobile</th>
                    <!--<th>Email</th>-->
                    <th>Company Name</th>
                    <th>Isactive</th>
                   <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php $sr=1;?>
				  @foreach($customers as $data)
                  <tr>
                       <td>{{$sr++}}</td> 
                      <td>{{$data->name}}</td>
                      <td>{{$data->mobile}}</td>
                      <!--<td>{{$data->email??''}}</td> -->
                      <td>{{$data->company_name??''}}</td> 
                       <td>
                        @if($data->isactive==1)
                               <span><a href="{{route('update-status',['id'=>$data->id,'status'=>$data->isactive])}}" class="btn btn-success">Active</a></span>
                             @else
                               <span style="color:red"><a href="{{route('update-status',['id'=>$data->id,'status'=>$data->isactive])}}" class="btn btn-danger">Inactive</a></span>
                             @endif
                       </td>
                        <td><a href="{{route('vendor-details',['id'=>$data->id])}}" class="btn btn-warning">View</a> 
                        <a href="{{route('srcustomers',['id'=>$data->id])}}" class="btn btn-primary">View Customer</a></td>                     
                  </tr>
                 @endforeach
                  </tbody>
                  {{$customers->appends(request()->input())->links()}}
                </table>
              </div>

    </div>

@endsection

@section('scripts')

    <script>
        /* Chart.js Charts */
        // Sales chart
        var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d');
        //$('#revenue-chart').get(0).getContext('2d');

        var salesChartData = {
            labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [
                {
                    label               : 'Therapy',
                    backgroundColor     : 'rgba(60,141,188,0.9)',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius          : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : [{{$sales['therapy'][1]??0}},{{$sales['therapy'][2]??0}},{{$sales['therapy'][3]??0}},{{$sales['therapy'][4]??0}},{{$sales['therapy'][5]??0}},{{$sales['therapy'][6]??0}},{{$sales['therapy'][7]??0}},{{$sales['therapy'][8]??0}},{{$sales['therapy'][9]??0}},{{$sales['therapy'][10]??0}},{{$sales['therapy'][11]??0}},{{$sales['therapy'][12]??0}}]
                },
                {
                    label               : 'Products',
                    backgroundColor     : 'rgba(210, 214, 222, 1)',
                    borderColor         : 'rgba(210, 214, 222, 1)',
                    pointRadius         : false,
                    pointColor          : 'rgba(210, 214, 222, 1)',
                    pointStrokeColor    : '#c1c7d1',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data                : [{{$sales['product'][1]??0}},{{$sales['product'][2]??0}},{{$sales['product'][3]??0}},{{$sales['product'][4]??0}},{{$sales['product'][5]??0}},{{$sales['product'][6]??0}},{{$sales['product'][7]??0}},{{$sales['product'][8]??0}},{{$sales['product'][9]??0}},{{$sales['product'][10]??0}},{{$sales['product'][11]??0}},{{$sales['product'][12]??0}}]
                },
            ]
        }

        var salesChartOptions = {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines : {
                        display : false,
                    }
                }],
                yAxes: [{
                    gridLines : {
                        display : false,
                    }
                }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        var salesChart = new Chart(salesChartCanvas, {
                type: 'line',
                data: salesChartData,
                options: salesChartOptions
            }
        )

        // Donut Chart
        var pieChartCanvas = $('#sales-chart-canvas').get(0).getContext('2d')
        var pieData        = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [
                {
                    data: [{{($sales['product'][1]??0)+($sales['therapy'][1]??0)}},{{($sales['product'][2]??0)+($sales['therapy'][2]??0)}},{{($sales['product'][3]??0)+($sales['therapy'][3]??0)}},{{($sales['product'][4]??0)+($sales['therapy'][4]??0)}},{{($sales['product'][5]??0)+($sales['therapy'][5]??0)}},{{($sales['product'][6]??0)+($sales['therapy'][6]??0)}},{{($sales['product'][7]??0)+($sales['therapy'][7]??0)}},{{($sales['product'][8]??0)+($sales['therapy'][8]??0)}},{{($sales['product'][9]??0)+($sales['therapy'][9]??0)}},{{($sales['product'][10]??0)+($sales['therapy'][10]??0)}},{{($sales['product'][11]??0)+($sales['therapy'][11]??0)}},{{($sales['product'][12]??0)+($sales['therapy'][12]??0)}},],
                    backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#0DB507', '#536953','#685369', '#AE12B4','#44E7B7','#07E32B', '#9A07E3', '#9A07E3','#D04D14'],
                }
            ]
        }
        var pieOptions = {
            legend: {
                display: false
            },
            maintainAspectRatio : false,
            responsive : true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        var pieChart = new Chart(pieChartCanvas, {
            type: 'doughnut',
            data: pieData,
            options: pieOptions
        });

    </script>

@endsection
