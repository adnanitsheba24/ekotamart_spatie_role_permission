@extends('admin.admin_master')
@section('admin')
    <!-- Content Wrapper. Contains page content -->
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-12">
                  <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Search Pending Orders</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body head-text">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead class="head-text">
                                    <tr>
                                        <th width="1%">SL.NO</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Invoice</th>
                                        <th>Amount</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                {{-- Search Data Show Order Pending --}}
                                <tbody class="head-text" id="pending_order_search">
                                    
                                    @if(isset($orders)) 
                                        @foreach ($orders as $key => $item)
                                            <tr>
                                                <td width="1%">{{ $key + 1 }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->order_date }}</td>
                                                <td>{{ $item->invoice_no }}</td>
                                                <td>{{ $item->amount }} Taka</td>
                    
                                                <td>{{ $item->payment_method }}</td>
                                                <td> <span class="badge badge-pill badge-primary">{{ $item->status }}</span>
                                                </td>
                        
                                                <td width="20%">
                                                    <a href="{{ route('pending.order.details',$item->id) }}" class="btn btn-info btn-sm" title="View Data"><i class="fa fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif 
                                      
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    </div>
                </div>

            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
@endsection
