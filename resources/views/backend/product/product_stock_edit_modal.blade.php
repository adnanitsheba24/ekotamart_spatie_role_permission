

@push('css')
    <style>
        .input-container{
            position:relative;
            /* margin-bottom:25px; */
        }
        .input-container label{
            position:absolute;
            top:0px;
            left:0px;
            /* font-size:16px; */
            color:#fff;	
            pointer-event:none;
            transition: all 0.5s ease-in-out;
        }
        .input-container input{ 
        border:0;
        border-bottom:1px solid #555;  
        background:transparent;
        width:100%;
        /* padding:8px 0 5px 0; */
        /* font-size:16px; */
        color:#040404;
        }
        .input-container input:focus{ 
        border:none;	
        outline:none;
        border-bottom:1px solid #e74c3c;	
        }
        .btn{
            color:#fff;
            background-color:#e74c3c;
            outline: none;
            border: 0;
            color: #fff;
            /* padding:10px 20px; */
            text-transform:uppercase;
            /* margin-top:50px; */
            border-radius:2px;
            cursor:pointer;
            position:relative;
        }
        .input-container input:focus ~ label,
        .input-container input:valid ~ label{
            top:-12px;
            /* font-size:12px; */
        }
    </style>
@endpush

    {{-- <input type="hidden" id="stock_qty_input_fild_Id"  name="stock_quantity_Id" value=""> --}}

    <div class="modal fade text-left" id="StockUpdate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Stock Quantity Update') }}</h4>
                    <a href="" class="close text-white" data-dismiss="modal" aria-label="Close">X</a>
                </div>
                    <div class="modal-body">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <form action="{{ route('product.stock_qty.update') }}" method="POST" id="formSubmit">
                            <div class="input-container">
                                    @csrf
                                    <input type="hidden" name="stock_qty_id" id="stock_qty_input_fild_Id">
                                    <input id="stock_qty_input_fild" type="number" name="stock_quantity" value="" required>
                                    <a href="#" id="submit" class="btn btn-success btn-sm float-right mt-3">Update</a>
                                    <label>Quantity</label>		
                                </div>
                            </form>
                        </div>
                        {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                            {{-- <a href="" class="btn grey btn-outline-secondary" data-dismiss="modal">Back</a> 
                            <a id="stock_qty_input_update_Id" class="btn btn-success btn-sm float-right mt-3" onclick="stock_qty_update()">Update</button></a>
                        </div> --}}
                    </div>
            </div>
        </div>
    </div> 


@push('js')

        <script>

           function stock_qty(id, product_qty){
              document.getElementById("stock_qty_input_fild").value = product_qty;
              document.getElementById("stock_qty_input_fild_Id").value = id;
            }

            function stock_qty_update(){
              var product_qty = document.getElementById("stock_qty_input_fild").value;
              var id = document.getElementById("stock_qty_input_fild_Id").value;
              document.getElementById(`product_qty_`+id).value = product_qty;
              $.ajax({
                  type: "POST",
                  dataType: 'json',
                  data: {
                      id: id,
                      product_qty: product_qty,
                  },
                  url: `{{ route('product.stock_qty.update') }}`,
                  success: function (response) {
                    $('#StockUpdate').modal('hide');
                   document.getElementById(`product_qty_`+id).innerHTML = product_qty;
                   window.location.reload();                   
                  }
              });
             
            }

            $('#submit').click(function(){
                $('#formSubmit').submit();
            });

        </script>
        
    @endpush