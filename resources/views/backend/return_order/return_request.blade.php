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
                <h3 class="box-title">Return Orders List</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body head-text">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead class="head-text">
                          <tr>
                              <th>Date</th>
                              <th>Invoice</th>
                              <th>Amount</th>
                              <th>Payment</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody class="head-text">
                        @foreach ($orders as $item)
                          <tr>
                              <td>{{ $item->order_date }}</td>
                              <td>{{ $item->invoice_no }}</td>
                              <td>{{ $item->amount }} Taka</td>
                              <td>{{ $item->payment_method }}</td>
                              <td> 
                                  @if ($item->return_order == 1)
                                      <span class="badge badge-pill badge-primary">Pending</span>
                                  @elseif ($item->return_order == 2)
                                      <span class="badge badge-pill badge-success">Success</span>
                                  @endif
                              </td>
                              <td width="20%">
                                  <a href="{{ route('return.approve', $item->id) }}" class="btn btn-warning btn-sm" id="approve" title="Approve">Return Approve</a>
                                  <a href="{{ route('return.cancel', $item->id) }}" class="btn btn-danger btn-sm" id="cancel" title="Cancel">Return Cancel</a>
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
