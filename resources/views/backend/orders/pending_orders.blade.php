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
                <h3 class="box-title">Pending Orders List <span class="badge badge-pill badge-danger">{{ count($orders) }}</span></h3>
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
                              <th class="text-center">Status</th>
                              <th class="text-center">Action</th>
                              <th class="text-center">Status Update</th>
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
                              <td width="1%"> <span class="badge badge-pill badge text-white" style="background: #800080;">{{ $item->status }}</span></td>

                              <td width="11%" >
                                  <div scope="row">
                                      <a href="{{ route('pending.order.details',$item->id) }}" class="btn btn-info btn-sm" title="View Data"><i class="fa fa-eye"></i></a>
                                      <a href="{{ route('prnding-orders.edit',$item->id) }}" class="btn btn-primary btn-sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                      <a href="{{ route('orders.cancel.admin',$item->id) }}" class="btn btn-danger btn-sm" id="order_cancel_admin" title="Cancel Order"><i class="fa fa-times"></i></a>
                                  </div>
                              </td>

                              <td width="1%" >
                                <div scope="row">
                                  {{-- @dd($item->status) --}}
                                    <form method="post" action="{{ route('prnding-orders.status.update', $item->id) }}">
                                      @csrf
                                        <select name="status" class="text-white text-center form-select form-select-sm badge badge-pill badge btn-sm" aria-label=".form-select-sm example" style="background-color: #800080;">
                                          <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                          <option value="confirm" {{ $item->status == 'confirm' ? 'selected' : '' }}>Confirm</option>
                                          <option value="processing" {{ $item->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                          <option value="picked" {{ $item->status == 'picked' ? 'selected' : '' }}>Picked</option>
                                          <option value="shipped" {{ $item->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                          {{-- <option value="delivered" {{ $item->status == 'delivered' ? 'selected' : '' }}>Delivered</option> --}}
                                        </select>
                                        <input type="submit" class="btn btn-rounded btn-success btn-sm text-center float-right" value="Update">
                                    </form>
                                </div>
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
