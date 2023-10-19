@extends('admin.admin_master')
@section('admin')

    <!-- Content Wrapper. Contains page content -->
    <div class="container-full">



        <div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h2 class="page-title head-text">Quantity Edit</h2>
					<div class="d-inline-block align-items-cente head-textr">
						<nav>
							<ol class="breadcrumb head-text">
								<li class="breadcrumb-item"><a href="{{ route('prnding-orders') }}"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Quantity Edit</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>



      <!-- Content Header (Page header) -->
      <!-- Main content -->
      <section class="content">
        <div class="row">

            <div class="col-md-12 col-12">
				<div class="border-info">
                    <div class="box-header with-border">
                        
                    </div>

                    <table class="table table-striped box-bordered border-info box-body head-text">
                        
                            <tbody class="">   
                                <tr>
                                    <td width="10%">
                                        <label for=""><b>Image</b></label>
                                    </td>

                                    <td width="20%">
                                        <label for=""><b>Product Name</b></label>
                                    </td>

                                    <td width="10%">
                                        <label for=""> <b>Product Code</b></label>
                                    </td>

                                    {{-- <td width="10%">
                                        <label for=""><b>Color</b></label>
                                    </td>

                                    <td width="10%">
                                        <label for=""><b>Size</b></label>
                                    </td> --}}

                                    <td width="10%">
                                        <label for=""><b>Price</b></label>
                                    </td>

                                    <td width="10%">
                                        <label for=""><b>Quantity</b></label>
                                    </td>
                                    
                                </tr>

                                @foreach($order_items as $item)

                                        <tr>
                                            <td width="10%">
                                                <label for="">
                                                    @if ($item->product->product_thambnail == '' || $item->product->product_thambnail == null)
                                                        <img src="{{ asset('upload/no_image.jpg') }}" style="height: 50px; width:70px;" alt="No Image">
                                                    @else
                                                        <img src="{{ URL::to('storage/products/thambnail', $item->product->product_thambnail) }}" style="height: 50px; width:70px;">
                                                    @endif
                                                </label>
                                            </td>

                                            <td width="20%">
                                                <label for=""> {{ $item->product->product_name_en }}</label>
                                            </td>


                                            <td width="10%">
                                                <label for=""> {{ $item->product->product_code }}</label>
                                            </td>

                                            {{-- <td width="10%">
                                                <label for=""> {{ $item->color }}</label>
                                            </td>

                                            <td width="10%">
                                                <label for=""> {{ $item->size }}</label>
                                            </td> --}}

                                            <td width="10%">
                                                <label for=""> {{ $item->price }}Taka ( {{ $item->price * $item->qty }}Taka ) </label>
                                            </td>
                                            <form method="post" action="{{ route('prnding-orders.update', $item->id) }}">
                                                @csrf

                                                <td width="10%">
                                                    {{-- <label for=""> {{ $item->qty }}</label> --}}
                                                    <input class="text-white text-center" type="number" name="qty" value="{{ $item->qty }}" style="background-color: #000000">
                                                    <br>
                                                    <br>
                                                    <input type="submit" class="btn btn-rounded btn-success float-right mb-5 mt-5" value="Update" style="margin-right: 100px;">
                                                </td>
                                            </form>
                                        </tr>

                                @endforeach

                            </tbody>    
                                 
                    </table>

				</div>
			</div><!-- col md 12 -->



        </div><!-- end row -->
      </section><!-- /.content -->
    
    </div>

@endsection
