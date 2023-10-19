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
                <h3 class="box-title">Delivered Orders List</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body head-text">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead class="head-text">
                          <tr>
                              <th width="1%">SL.NO</th>
                              <th>Date</th>
                              <th>Invoice</th>
                              <th>Amount</th>
                              <th>Payment</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody class="head-text">
                        @foreach ($orders as $key => $item)
                          <tr>
                              <td width="1%">{{ $key + 1 }}</td>
                              <td>{{ $item->order_date }}</td>
                              <td>{{ $item->invoice_no }}</td>
                              <td>{{ $item->amount }} Taka</td>

                              <td>{{ $item->payment_method }}</td>
                              <td> <span class="badge badge-pill badge text-white" style="background: #008000;">{{ $item->status }}</span></td>

                              <td width="30%">
                                  <a href="{{ route('pending.order.details',$item->id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-eye"></i></a>
                                  <a target="_blank" href="{{ route('invoice.download',$item->id) }}" class="btn btn-danger btn-sm" title="Invoice Download"><i class="fa fa-download"></i></a>
                              </td>
                              </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->         
          </div>
          <!-- /.col -->
            
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>

@endsection
