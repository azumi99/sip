@extends('main/admin')
@section('title', 'Dashboard')
@section ('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Sales Graph</div>
            </div>
            <div class="card-body">
                <canvas class="chart" id="sales-chart" style="height: 250px"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Lates Transaction</div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <th>no</th>
                        <th>Product</th>
                        <th>Date</th>
                    </thead>
                <tbody>
                    @foreach ($latest_transaction as $key=> $item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->product_name}}</td>
                            <td>{{$item->trx_date}}</td>
                        </tr> 
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-titile">
                    Chart
                </div>
            </div>
            <div class="card-body">
                <canvas class="chart" id="donut-chart" style="height: 10px"></canvas>
            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')
<script>
    var chart =document.getElementById('sales-chart').getContext("2d");
    var areaChart = new Chart(chart,{
        type: 'line',
        data: {
            labels: {!!json_encode($chart['months'])!!},
            datasets:[{
                label:"Overall sales",
                data:{{json_encode($chart['totals'])}},
                borderColor:'rgb(75,192,192)'

            }]

        }      
    })
</script>
<script>
    var productChart =document.getElementById("donut-chart").getContext("2d");
    var dougnutChart = new Chart(productChart,{
        type: 'doughnut',
        data:{
            labels:{!!json_encode($chart_product['product_name'])!!},
            datasets:[{
                label: "Jumlah penjualan product",
                data: {{json_encode($chart_product['product_total'])}},
                backgroundColor:{!!json_encode($chart_product['product_color'])!!},
            }]
        } 
    })
</script>
@endsection
    