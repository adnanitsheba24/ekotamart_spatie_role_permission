    <!--sidebar start-->
    <style>
        hr {
            margin: 5px 0px 0px 0px;
            color: inherit;
            border: 0;
            border-top: var(--bs-border-width) solid;
            opacity: 0.25;
        }


    </style>
    @php
    $sidebar_top_menu = DB::table('top_sidebars')->where('status', '1' )->orderBy('priority', 'asc')->take(6)->get();
    @endphp
    <div class="sidebar" style="overflow-x: hidden;">
        <div class="row sidebarrow" id="sidebarrow">

            @foreach ($sidebar_top_menu as $top_menu)
            <div class="card" style="width: 90px;position: initial; height: 80px;text-align: center;">
                <a class="category" href="{{ route('productPage.topmenu', [ 'mainCategory_id'=> $top_menu->id, 'mainCategory_name'=>$top_menu->name_en] )}}" style="padding-left: 0px;">
                    <!--<img loading="lazy" width="30px" height="30px" src="{{ asset('storage/dopimg/top_img/'. $top_menu->icon) }}" alt="menu-icon" style="margin-top: 10px;margin-bottom: 10px;" />-->
                    @if ($top_menu->icon != '' || $top_menu->icon != null)
                    <img loading="lazy" width="30px" height="30px" src="{{ URL::to('storage/top_sidebar_icon', $top_menu->icon) }}" alt="menu-icon" style="margin-top: 10px;margin-bottom: 10px;">
                    @else
                    <img loading="lazy" width="30px" height="30px" src="{{ asset('upload/no_image.jpg') }}" alt="menu-icon" style="margin-top: 10px;margin-bottom: 10px;">
                    @endif
                    <div class="card-body" style="padding: 0px;">
                        <span style="font-size: 12px; font-weight: bold; position: inherit; margin: 10px 0 0px -10px;"> {{ session()->get('language')=='bangla'?   $top_menu->name_bn :  $top_menu->name_en }}</span>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <hr>
        <div class="d-flex justify-content-around">
            <a class="category" href="{{ route('productPage.special')}}" style="margin-top:10px">
                <img loading="lazy" width="30" height="30" src="{{asset('frontend/icons8_special_2.png')}}" alt="external-brand-modelling-agency-flaticons-flat-flat-icons" />
                <span style="font-size: 13px; font-weight: bold; position: inherit; margin-left: 15px;"> {{ session()->get('language')=='bangla'?  "স্পেশাল অফার" : "Special Offer" }}</span>
            </a>
        </div>
        <div class="d-flex justify-content-around">
            <a class="category" href="{{ route('wishlist') }}" style="margin-top:10px">
                <img loading="lazy" width="30" height="30" src="{{asset('frontend/Favourites.png')}}" alt="Favourites.png" />
                <span style="font-size: 13px; font-weight: bold; position: inherit; margin-left: 15px;"> {{ session()->get('language')=='bangla'?  "পছন্দের পণ্য" : "Favorite" }}</span>
            </a>
        </div>
        <div class="d-flex justify-content-around">
            <a class="category" href="{{ route('productPage.hotdeal') }}" style="margin-top:10px">
                <img loading="lazy" width="30" height="30" src="{{asset('frontend/icons8_special_3.png')}}" alt="external-brand-modelling-agency-flaticons-flat-flat-icons" />
                <span style="font-size: 13px; font-weight: bold; position: inherit; margin-left: 15px;"> {{ session()->get('language')=='bangla'?  "হট ডিল" : "Hot Deal" }}</span>
            </a>
        </div>
        <hr>
        <div class="d-flex justify-content-around">
            <a class="category" href="{{route('productPage.brand')}}" style="margin-top:10px">
                <img loading="lazy" width="30" height="30" src="https://img.icons8.com/external-flaticons-flat-flat-icons/64/external-brand-modelling-agency-flaticons-flat-flat-icons.png" alt="external-brand-modelling-agency-flaticons-flat-flat-icons" />
                <span style="font-size: 13px; font-weight: bold; position: inherit; margin-left: 15px;"> {{ session()->get('language')=='bangla'?  "ব্র্যান্ড" : "All Brand" }}</span>
            </a>
        </div>
        <hr>
        @foreach ($main_category as $main)
        <div class="d-flex justify-content-around">
            <a id="cate_{{ session()->get('language')=='bangla'? $main->category_name_bn : $main->category_name_en }}" class="category" href="{{ route('productPage.category', [ 'mainCategory_id'=>$main->id, 'mainCategory_name'=>$main->category_name_en] )}}" style="margin-top:10px">
                <img loading="lazy" src="{{ asset('storage/category_icon/'.$main->category_icon) }}" alt="" title="{{ $main->category_name_en }}" width="30px" height="30px">
                <span style="font-size: 13px; font-weight: bold; position: inherit; margin-left: 15px;"> {{ session()->get('language')=='bangla'? $main->category_name_bn : $main->category_name_en  }}</span>
            </a>
            <span>
                <input type="checkbox" id="hide_scat_check_{{$main->id}}" name="accept" style="display: none;">
                <label class="hide_label_{{$main->id}}" for="hide_scat_check" id="{{$main->id}}" onclick="hidediv(this.id)" style="margin-top: 10px;">
                    <i class="fa-sharp fa-solid fa-chevron-down  fa-lg" style="color: #000; margin-top: 8px; padding-right: 13px;"></i>
                </label>
            </span>
        </div>
        <ul class="sub_sub_category" id="sub_category_{{$main->id}}" style="display: none;">
            @foreach ($sub_category[$main->id] as $sub)

            <li>
                <div class="d-flex justify-content-around">
                    <a id="subc_{{ session()->get('language')=='bangla'?$sub->subcategory_name_bn : $sub->subcategory_name_en }}" href="{{ route('productPage.subcategory', ['subCategory_id'=>$sub->id, 'subCategory_name'=>$sub->subcategory_name_en] )}}">
                        <span style="font-size: 13px;">
                            {{ session()->get('language')=='bangla'?$sub->subcategory_name_bn : $sub->subcategory_name_en }}
                        </span>
                    </a>
                    <span>
                        <input type="checkbox" id="hide_sscat_check_{{$sub->id}}" checked name="accept" style="display: none;">
                        <label class="hide_slabel_{{$sub->id}}" for="hide_sscat_check" id="{{$sub->id}}" onclick="hidesdiv(this.id)">
                            <i class="fa-sharp fa-solid fa-chevron-right  fa-sm" style="color: #000; margin-top: 10px; padding-right: 10px;"></i>
                        </label>
                    </span>
                </div>
            </li>
            <li>
                <ul class="sub_sub_category" id="sub_sub_category_{{$sub->id}}">
                    @foreach ($sub_sub_category[$sub->id] as $sub_sub)

                    <li>
                        <a id="ssubc_{{ session()->get('language')=='bangla'? $sub_sub->subsubcategory_name_bn : $sub_sub->subsubcategory_name_en }}" href="{{ route('productPage.subsubcategory', ['subSubCategory_id'=>$sub_sub->id, 'subSubCategory_name'=>$sub_sub->subsubcategory_name_en] )}}"><span style="font-size: 12px;">{{ session()->get('language')=='bangla'? $sub_sub->subsubcategory_name_bn : $sub_sub->subsubcategory_name_en }}</span></a>
                    </li>

                    @endforeach
                </ul>
            </li>
            @endforeach
        </ul>
        @endforeach
        <ul style="margin-bottom: 100px;"></ul>
    </div>
    <!--sidebar end-->

    <!-- This script is for hide and showw sub cat sub sub cat -->
    <script>
        function hidediv(main_category_id) {
            var x = document.getElementById("sub_category_" + main_category_id);
            var label = document.getElementsByClassName('hide_label_' + main_category_id);
            var icon = label[0].querySelector('i');
            if (x.style.display == "block") {
                x.style.display = "none";
                icon.classList.remove('fa-sharp', 'fa-solid', 'fa-chevron-right', 'fa-lg');
                icon.classList.add('fa-sharp', 'fa-solid', 'fa-chevron-down', 'fa-lg');
            } else {
                x.style.display = "block";
                icon.classList.remove('fa-sharp', 'fa-solid', 'fa-chevron-down', 'fa-lg');
                icon.classList.add('fa-sharp', 'fa-solid', 'fa-chevron-right', 'fa-lg');
            }
        }

        function hidesdiv(sub_category_id) {
            var x = document.getElementById("sub_sub_category_" + sub_category_id);
            var label = document.getElementsByClassName('hide_slabel_' + sub_category_id);
            var icon = label[0].querySelector('i');
            if (x.style.display == "block") {
                x.style.display = "none";
                icon.classList.remove('fa-sharp', 'fa-solid', 'fa-chevron-right', 'fa-sm');
                icon.classList.add('fa-sharp', 'fa-solid', 'fa-chevron-down', 'fa-sm');
            } else {
                x.style.display = "block";
                icon.classList.remove('fa-sharp', 'fa-solid', 'fa-chevron-down', 'fa-sm');
                icon.classList.add('fa-sharp', 'fa-solid', 'fa-chevron-right', 'fa-sm');
            }
        }
    </script>

    <!-- This script is for hide and showw sub cat sub sub cat -->