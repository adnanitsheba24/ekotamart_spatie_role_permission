@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
@endphp

{{-- linear-gradient(45deg, #0ff769, #7a15f7)
linear-gradient(45deg, #0ff769, #1544f7) --}}


{{-- @push('css') --}}
    <style>
        .theme-primary.dark-skin .sidebar-menu > li.active {
            background: linear-gradient(45deg, #0ff769, #1544f7);
            /* color: white; */
            -webkit-box-shadow: 0px 0px 12px 0px #0ff769;
            box-shadow: 0px 0px 12px 0px #1544f7;
        }
        .theme-primary.dark-skin .sidebar-menu > li.active.treeview.treeview > a {
            background: linear-gradient(45deg, #0ff769, #1544f7);
        }

    </style>
{{-- @endpush --}}

<aside class="main-sidebar" style="background-color: #1B9C85">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">

            <div class="ulogo">
                <a href="{{ url('admin/dashboard') }}">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">

                        @php
                            $admin_image = DB::table('site_settings')->first();
                        @endphp

                        @if (@$admin_image->logo == '' || @$admin_image->logo == null)
                            <img loading="lazy" src="{{ asset('upload/no_image.jpg') }}" style="height: auto; width:150px;" alt="No Image">
                        @else
                            <img loading="lazy" src="{{ URL::to('storage/logo', @$admin_image->logo) }}" style="height: auto; width:150px;">
                        @endif
                    </div>
                </a>
            </div>
        </div>



        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree" style="background-color: #98EECC">



            <li class="{{ ($route == 'dashboard') ? 'active' : '' }}">
                <a href="{{ url('admin/dashboard') }}">
                    <i data-feather="pie-chart" style="color: black;"></i>
                    <span class="head-text">Dashboard</span>
                </a>
            </li>
            
            <li id="selectedItem" class="" style="display: none;">
            </li>

            <li class="treeview {{ ($prefix == '/rolepermission') ? 'active' : '' }}">
                <a href="#">
                    <img loading="lazy" width="20" height="20" src="https://img.icons8.com/nolan/64/gear.png" alt="gear" />
                    <span class="head-text">Roles & Permission</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'roles.index') ? 'active' : '' }}"><a href="{{ route('roles.index') }}"><i class="ti-more"></i>Roles Setting</a></li>
                    <li class="{{ ($route == 'permission.index') ? 'active' : '' }}"><a href="{{ route('permission.index') }}"><i class="ti-more"></i>Permissions Setting</a></li>
                </ul>
            </li>
            


            <li class="treeview {{ ($prefix == '/brand') ? 'active' : '' }}">
                <a href="#">
                    <img loading="lazy" width="20" height="20" src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/external-brand-public-relations-agency-flaticons-lineal-color-flat-icons.png" alt="external-brand-public-relations-agency-flaticons-lineal-color-flat-icons" />
                    <span class="head-text"> Brands</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'all.brand') ? 'active' : '' }}"><a href="{{ route('all.brand') }}"><i class="ti-more"></i>All Brand</a></li>
                </ul>
            </li>
            


            <li class="treeview {{ ($prefix == '/category') ? 'active' : '' }}">
                <a href="">
                    <img loading="lazy" width="20" height="20" src="https://img.icons8.com/dusk/64/diversity.png" alt="diversity" />
                    <span class="head-text">Category</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'all.category') ? 'active' : '' }}"><a href="{{ route('all.category') }}"><i class="ti-more"></i>All Category</a></li>
                    <li class="{{ ($route == 'all.subcategory') ? 'active' : '' }}"><a href="{{ route('all.subcategory') }}"><i class="ti-more"></i>All SubCategory</a></li>
                    <li class="{{ ($route == 'all.subsubcategory') ? 'active' : '' }}"><a href="{{ route('all.subsubcategory') }}"><i class="ti-more"></i>All Sub->SubCategory</a></li>
                </ul>
            </li>



            <li class="treeview {{ ($prefix == '/author') ? 'active' : '' }}">
                <a href=""> 
                    <img loading="lazy" width="20" height="20" src="https://img.icons8.com/emoji/48/open-book-emoji.png" alt="open-book-emoji"/>
                    <span class="head-text">Author</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" > 
                    <li class="{{ ($route == 'add.author') ? 'active' : '' }}"><a href="{{ route('add.author') }}"><i class="ti-more"></i>Author Add</a></li>
                    <li class="{{ ($route == 'all.author') ? 'active' : '' }}"><a href="{{ route('all.author') }}"><i class="ti-more"></i>All Author List</a></li>
                </ul>
            </li>

            

            <li class="treeview {{ ($prefix == '/product') ? 'active' : '' }}">
                <a href="">
                    <img loading="lazy" width="20" height="20" src="https://img.icons8.com/nolan/64/product.png" alt="product"/>
                    <span class="head-text">Products</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'add-product') ? 'active' : '' }}"><a href="{{ route('add-product') }}"><i class="ti-more"></i>Add Products</a></li>
                    <li class="{{ ($route == 'manage-product') ? 'active' : '' }}"><a href="{{ route('manage-product') }}"><i class="ti-more"></i>Manage Products</a></li>
                </ul>
            </li>


            <li class="treeview {{ ($prefix == '/stock') ? 'active' : '' }}">
                <a href="">
                    <img loading="lazy" width="20" height="20" src="https://img.icons8.com/color/48/business-report.png" alt="business-report"/>
                    <span class="head-text">Manage Stock</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'product.stock') ? 'active' : '' }}"><a href="{{ route('product.stock') }}"><i class="ti-more"></i>Product Stock</a></li>
                    <li class="{{ ($route == 'stock.request') ? 'active' : '' }}"><a href="{{ route('stock.request') }}"><i class="ti-more"></i>Request Stock</a></li>
                </ul>
            </li>



            <li class="treeview {{ ($prefix == '/coupons') ? 'active' : '' }}">
                <a href="">
                    <img loading="lazy" width="20" height="20" src="https://img.icons8.com/external-wanicon-flat-wanicon/64/external-coupon-cyber-monday-wanicon-flat-wanicon.png" alt="external-coupon-cyber-monday-wanicon-flat-wanicon"/>
                    <span class="head-text">Coupons</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'manage-coupon') ? 'active' : '' }}"><a href="{{ route('manage-coupon') }}"><i class="ti-more"></i>Manage Coupons</a></li>
                </ul>
            </li>



            <li class="treeview {{ ($prefix == '/slider') ? 'active' : '' }}">
                <a href="">
                    <img loading="lazy" width="20" height="20" src="https://img.icons8.com/water-color/50/sorting-options.png" alt="sorting-options"/>
                    <span class="head-text">Manage Slider</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'manage-slider') ? 'active' : '' }}"><a href="{{ route('manage-slider') }}"><i class="ti-more"></i>Slider</a></li>
                    <li class="{{ ($route == 'manage.category-slider') ? 'active' : '' }}"><a href="{{ route('manage.category-slider') }}"><i class="ti-more"></i>Category Slider</a></li>
                    <li class="{{ ($route == 'manage.top-sidebar-menu-slider') ? 'active' : '' }}"><a href="{{ route('manage.top-sidebar-menu-slider') }}"><i class="ti-more"></i>Top-Sidebar Menu Slider</a></li>
                </ul>
            </li>


            <li class="header nav-small-cap head-text">User Interface</li>

            <li class="treeview {{ ($prefix == '/alluser') ? 'active' : '' }}">
                <a href="">
                    <img loading="lazy" width="20" height="20" src="https://img.icons8.com/neon/96/user.png" alt="user"/>
                    <span class="head-text">All Users</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'all-users') ? 'active' : '' }}"><a href="{{ route('all-users') }}"><i class="ti-more"></i>All Users</a></li>
                </ul>
            </li>



            <li class="treeview {{ ($prefix == '/orders') ? 'active' : '' }}">
                <a href="">
                    <img loading="lazy" width="20" height="20" src="https://img.icons8.com/external-itim2101-blue-itim2101/64/external-delivery-box-shopping-and-ecommerce-itim2101-blue-itim2101.png" alt="external-delivery-box-shopping-and-ecommerce-itim2101-blue-itim2101"/>
                    <span class="head-text">Orders</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'prnding-orders') ? 'active' : '' }}"><a href="{{ route('prnding-orders') }}"><i class="ti-more"></i>Pending Orders</a></li>
                    <li class="{{ ($route == 'confirmed-orders') ? 'active' : '' }}"><a href="{{ route('confirmed-orders') }}"><i class="ti-more"></i>Confirmed Orders</a></li>
                    <li class="{{ ($route == 'processing-orders') ? 'active' : '' }}"><a href="{{ route('processing-orders') }}"><i class="ti-more"></i>Processing Orders</a></li>
                    <li class="{{ ($route == 'picked-orders') ? 'active' : '' }}"><a href="{{ route('picked-orders') }}"><i class="ti-more"></i>Picked Orders</a></li>
                    <li class="{{ ($route == 'shipped-orders') ? 'active' : '' }}"><a href="{{ route('shipped-orders') }}"><i class="ti-more"></i>Shipped Orders</a></li>
                    <li class="{{ ($route == 'delivered-orders') ? 'active' : '' }}"><a href="{{ route('delivered-orders') }}"><i class="ti-more"></i>Delivered Orders</a></li>
                    <li class="{{ ($route == 'cancel-orders') ? 'active' : '' }}"><a href="{{ route('cancel-orders') }}"><i class="ti-more"></i>Cancel Orders</a></li>
                </ul>
            </li>



            <li class="treeview {{ ($prefix == '/return') ? 'active' : '' }}">
                <a href="">
                    <img loading="lazy" width="20" height="20" src="https://img.icons8.com/nolan/64/return.png" alt="return"/>
                    <span class="head-text">Return Order</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'return.request') ? 'active' : '' }}"><a href="{{ route('return.request') }}"><i class="ti-more"></i>Return Request</a></li>
                    <li class="{{ ($route == 'all.request.approve') ? 'active' : '' }}"><a href="{{ route('all.request.approve') }}"><i class="ti-more"></i>All Request Approve</a></li>
                    <li class="{{ ($route == 'all.request.cancel') ? 'active' : '' }}"><a href="{{ route('all.request.cancel') }}"><i class="ti-more"></i>All Request Cancel</a></li>
                </ul>
            </li>



            <li class="treeview {{ ($prefix == '/reports') ? 'active' : '' }}">
                <a href="">
                    <img loading="lazy" width="20" height="20" src="https://img.icons8.com/color/48/business-report.png" alt="business-report"/>
                    <span class="head-text">All Reports</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'all-reports') ? 'active' : '' }}"><a href="{{ route('all-reports') }}"><i class="ti-more"></i>All Reports</a></li>
                </ul>
            </li>



            <li class="treeview {{ ($prefix == '/shipping') ? 'active' : '' }}">
                <a href="">
                    <img loading="lazy" width="20" height="20" src="https://img.icons8.com/color/48/in-transit--v1.png" alt="in-transit--v1"/>
                    <span class="head-text">Shipping Area</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'manage-division') ? 'active' : '' }}"><a href="{{ route('manage-division') }}"><i class="ti-more"></i>Ship Division</a></li>
                    <li class="{{ ($route == 'manage-district') ? 'active' : '' }}"><a href="{{ route('manage-district') }}"><i class="ti-more"></i>Ship District</a></li>
                    <li class="{{ ($route == 'manage-upazila') ? 'active' : '' }}"><a href="{{ route('manage-upazila') }}"><i class="ti-more"></i>Ship Upazila</a></li>
                </ul>
            </li>



            <li class="header nav-small-cap head-text">Setting</li>


            <li class="treeview {{ ($prefix == '/product_units') ? 'active' : '' }}">
                <a href="">
                    <img loading="lazy" width="20" height="20" src="https://img.icons8.com/color/48/blog.png" alt="blog"/>
                    <span class="head-text">Manage Product Units</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'all.product_units') ? 'active' : '' }}"><a href="{{ route('all.product_units') }}"><i class="ti-more"></i>Manage Units</a></li>
                </ul>
            </li>


            <li class="treeview {{ ($prefix == '/blog') ? 'active' : '' }}">
                <a href="">
                    <img loading="lazy" width="20" height="20" src="https://img.icons8.com/color/48/blog.png" alt="blog"/>
                    <span class="head-text">Manage Blog</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'blog.category') ? 'active' : '' }}"><a href="{{ route('blog.category') }}"><i class="ti-more"></i>Blog Category</a></li>
                    <li class="{{ ($route == 'list.post') ? 'active' : '' }}"><a href="{{ route('list.post') }}"><i class="ti-more"></i>List Blog Post</a></li>
                    <li class="{{ ($route == 'add.post') ? 'active' : '' }}"><a href="{{ route('add.post') }}"><i class="ti-more"></i>Add Blog Post</a></li>
                </ul>
            </li>



            <li class="treeview {{ ($prefix == '/sidebar') ? 'active' : '' }}">
                <a href="">
                    <img loading="lazy" width="20" height="20" src="https://img.icons8.com/dotty/80/sidebar-menu.png" alt="sidebar-menu"/>
                    <span class="head-text">Manage Sidebar</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'top_sidebar.view') ? 'active' : '' }}"><a href="{{ route('top_sidebar.view') }}"><i class="ti-more"></i>Top Sidebar Menu List</a></li>
                    <li class="{{ ($route == 'top_sidebar.add') ? 'active' : '' }}"><a href="{{ route('top_sidebar.add') }}"><i class="ti-more"></i>Top Sidebar Menu Add</a></li>
                </ul>
            </li>
            


            <li class="treeview {{ ($prefix == '/book_type') ? 'active' : '' }}">
                <a href="">
                    <img loading="lazy" width="20" height="20" src="https://img.icons8.com/emoji/48/books-emoji.png" alt="books-emoji" />
                    <span class="head-text">Manage Book-Type</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'all.book-type') ? 'active' : '' }}"><a href="{{ route('all.book-type') }}"><i class="ti-more"></i>All Book-Type</a></li>
                </ul>
            </li>
        


            <li class="treeview {{ ($prefix == '/publication') ? 'active' : '' }}">
                <a href="">
                    <img loading="lazy" width="20" height="20" src="https://img.icons8.com/color-glass/48/publication.png" alt="publication" />
                    <span class="head-text">Manage Publication</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'all.publication') ? 'active' : '' }}"><a href="{{ route('all.publication') }}"><i class="ti-more"></i>All Publication</a></li>
                </ul>
            </li>


        
            <li class="treeview {{ ($prefix == '/setting') ? 'active' : '' }}">
                <a href="#">
                    <img loading="lazy" width="20" height="20" src="https://img.icons8.com/nolan/64/gear.png" alt="gear" />
                    <span class="head-text">Manage Setting</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'seo.setting') ? 'active' : '' }}"><a href="{{ route('seo.setting') }}"><i class="ti-more"></i>Seo Setting</a></li>
                    <li class="{{ ($route == 'site.setting') ? 'active' : '' }}"><a href="{{ route('site.setting') }}"><i class="ti-more"></i>Site Setting</a></li>
                </ul>
            </li>


        </ul>
    </section>

    <div class="sidebar-footer">
        <!-- item-->
        <a href="{{ route('site.setting') }}" class="link" data-toggle="tooltip" title="Settings"
            data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        {{-- <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title=""
            data-original-title="Email"><i class="ti-email"></i></a> --}}
        <!-- item-->
        <a href="{{ route('admin.logout') }}" class="link" data-toggle="tooltip" title="Logout"
            data-original-title="Logout"><i class="ti-lock"></i></a>
    </div>
</aside>





{{-- Sidebar active li Js Start --}}
    {{-- @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const sidebar = document.querySelector('.sidebar');
                const listItems = document.querySelectorAll('.sidebar li');

                listItems.forEach(function (item, index) {
                    item.addEventListener('click', function () {
                        // Add the 'active' class to the clicked item
                        listItems.forEach(function (li) {
                            li.classList.remove('active');
                        });
                        item.classList.add('active');
                        
                        // Scroll the clicked item into view within the sidebar
                        item.scrollIntoView();
                    });
                });
            });
        </script>
    @endpush --}}
{{-- Sidebar active li Js End --}}



{{-- Sidebar active li Js Start --}}
@push('js')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar');
            const listItems = document.querySelectorAll('.sidebar li');

            listItems.forEach(function(item, index) {
                item.addEventListener('click', function() {
                    // Add the 'active' class to the clicked item
                    listItems.forEach(function(li) {
                        li.classList.remove('active');
                    });
                    item.classList.add('active');
                    item.scrollIntoView();
                    testSleep();
                });
            });
        });

        var testSleep = function() {
            setTimeout(function() {
                var elementsWithDisplayNone = document.querySelectorAll('[style*="display: none;"]');
                elementsWithDisplayNone.forEach(function(element) {
                    // Change style.display to "block"
                    element.style.display = "block";
                });
                const listItems = document.querySelector('li.active.treeview.menu-open');
                const toReplaceItems = document.getElementById('selectedItem');
                toReplaceItems.style.display = "block";
                toReplaceItems.classList.add('active');
                toReplaceItems.classList.add('treeview');
                toReplaceItems.classList.add('menu-open');
                toReplaceItems.innerHTML = listItems.innerHTML;
                listItems.style.display = "none";

            }, 800);
        }
        testSleep();
    </script>
@endpush
{{-- Sidebar active li Js End --}}
