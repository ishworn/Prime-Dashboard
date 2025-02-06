@extends('admin.admin_master')
@section('admin')


    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Invoice All</h4>



                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <a href="{{ route('invoice.add') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i class="fas fa-plus-circle"> Add Inovice </i></a> <br>  <br>

                            <h4 class="card-title">Invoice All Data </h4>


                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Customer Name</th>
                                    <th>Invoice No </th>
                                    <th>Date </th>
                                    <th>Description</th>
                                    <th>Amounts</th>

                                </thead>


                                <tbody>

                                @foreach($allData as $key => $item)


                                    <tr>
                                        <td> {{ $key+1}} </td>
                                        <td>
                                            @if(isset($item['payment']['customer']['name']))
                                                {{ $item['payment']['customer']['name'] }}
                                            @else
                                                N/A
                                            @endif
                                        </td>

                                        <td> #{{ $item->invoice_no }} </td>
                                        <td> {{ date('d-m-Y',strtotime($item->date))  }} </td>


                                        <td>  {{ $item->description }} </td>

                                        <td>
                                         $ {{ $item['payment']['total_amount'] }}
                                        </td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->
    </div>


@endsection
