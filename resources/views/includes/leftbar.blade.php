<!-- Loader -->
<div id="preloader">
    <div id="status">
        <div class="spinner"></div>
    </div>
</div>

<!-- Begin page -->
<div id="wrapper">

    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">

        <!-- LOGO -->
        <div class="topbar-left">
            <div class="">
                <!--<a href="index" class="logo text-center">Fonik</a>-->

                <a href="{{ URL::asset('index') }}" class="logo"><img
                        src="{{ URL::asset('assets/images/logo.jpeg') }}" height="100" alt="logo"></a>

            </div>
        </div>

        <div class="sidebar-inner slimscrollleft">
            <div id="sidebar-menu">
                <ul>



                    <li>
                        <a href="index" class="waves-effect"><i class="dripicons-device-desktop"></i><span>Dashboard
                            </span></a>
                    </li>

                    @if (\Illuminate\Support\Facades\Auth::user()->user_role_iduser_role == 2 || \Illuminate\Support\Facades\Auth::user()->user_role_iduser_role == 1)
                    <li class="menu-title">Order Management</li>
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user"
                                aria-hidden="true"></i><span>Order<span class="pull-right"><i
                                        class="mdi mdi-chevron-right"></i></span> </span></a>
                        <ul class="list-unstyled">
                            @if (\Illuminate\Support\Facades\Auth::user()->user_role_iduser_role == 1)
                            <li>
                                <a href="pending-orders" class="waves-effect"><span>Pending Order</span></a>
                            </li>
                            <li>
                                <a href="accepted-orders" class="waves-effect"><span>Accepted Order</span></a>
                            </li>
                            <li>
                                <a href="completed-orders" class="waves-effect"><span>Completed Order</span></a>
                            </li>  
                             <li>
                                <a href="canceled-orders" class="waves-effect"><span>Canceled Order</span></a>
                            </li>   
                            @endif
                            <li>
                                <a href="tasks" class="waves-effect"><span>Tasks</span></a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    @if (\Illuminate\Support\Facades\Auth::user()->user_role_iduser_role == 3 || \Illuminate\Support\Facades\Auth::user()->user_role_iduser_role == 1)
                    <li class="menu-title">Booking Management</li>
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user"
                                aria-hidden="true"></i><span>Booking<span class="pull-right"><i
                                        class="mdi mdi-chevron-right"></i></span> </span></a>
                        <ul class="list-unstyled">
                            <li>
                                <a href="delivery-orders" class="waves-effect"><span>Delivery Order</span></a>
                            </li>
                            <li>
                                <a href="catering-orders" class="waves-effect"><span>Catering Order</span></a>
                            </li>
                            <li>
                                <a href="reservation-orders" class="waves-effect"><span>Reservation Order</span></a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if (\Illuminate\Support\Facades\Auth::user()->user_role_iduser_role == 3)
                    <li class="menu-title">Order History</li>
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user"
                                aria-hidden="true"></i><span>Order History<span class="pull-right"><i
                                        class="mdi mdi-chevron-right"></i></span> </span></a>
                        <ul class="list-unstyled">
                            <li>
                                <a href="pending-order-customer" class="waves-effect"><span>Pending Orders</span></a>
                                <a href="accepted-order-customer" class="waves-effect"><span>Accepted Orders</span></a>
                                <a href="completed-order-customer" class="waves-effect"><span>Completed Orders</span></a>
                                <a href="canceled-order-customer" class="waves-effect"><span>Canceled Orders</span></a>
                            </li>
                        </ul>
                    </li>
                    @endif


                    @if (\Illuminate\Support\Facades\Auth::user()->user_role_iduser_role == 1)
                        <li class="menu-title">USER MANAGEMENT</li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user"
                                    aria-hidden="true"></i><span>Users<span class="pull-right"><i
                                            class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="add-user" class="waves-effect"><span>Add Driver</span></a>
                                </li>
                                 <li>
                                    <a href="view-users" class="waves-effect"><span>View Users</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-title">Order Category Management</li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cubes"></i><span>Delivery
                                    / Table
                                    Order<span class="pull-right"><i class="mdi mdi-chevron-right"></i></span>
                                </span></a>
                            <ul class="list-unstyled">

                                <li>
                                    <a href="delivery-order" class="waves-effect"><span>Make a Delivery/Table
                                            Order</span></a>
                                </li>
                                <li>
                                    <a href="delivery-order-lists" class="waves-effect"><span>Delivery Order
                                            Lists</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cubes"></i><span>Catering
                                    Order<span class="pull-right"><i class="mdi mdi-chevron-right"></i></span>
                                </span></a>
                            <ul class="list-unstyled">

                                <li>
                                    <a href="catering-order" class="waves-effect"><span>Make a Catering Order</span></a>
                                </li>
                                <li>
                                    <a href="catering-order-lists" class="waves-effect"><span>Catering Order
                                            Lists</span></a>
                                </li>
                            </ul>
                        </li>

                        <li class="menu-title">PRODUCT INVENTORY</li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i
                                    class="fa fa-cubes"></i><span>Products<span class="pull-right"><i
                                            class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="list-unstyled">

                                <li>
                                    <a href="products" class="waves-effect"><span>Products</span></a>
                                </li>
                            </ul>
                        </li>

                        <li class="menu-title">PURCHASING INVENTORY</li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i
                                    class="fa fa-cubes"></i><span>Purchase
                                    Order<span class="pull-right"><i class="mdi mdi-chevron-right"></i></span>
                                </span></a>
                            <ul class="list-unstyled">
                                <li><a href="add-po">Add Purchase Order</a></li>
                                <li><a href="pending-po">Pending Purchase Order</a></li>
                                <li><a href="approved-po">Approved Purchase Order</a></li>
                                <li><a href="completed-po">Completed Purchase Order</a></li>
                            </ul>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i
                                    class="fa fa-suitcase"></i><span>GRN<span class="pull-right"><i
                                            class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="list-unstyled">
                                <li><a href="add-grn">Add GRN</a></li>
                                <li><a href="grn-history">GRN History</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">SUPPLIER </li>
                        <li>
                            <a href="suppliers" class="waves-effect"><i
                                    class="fa fa-user"></i><span>Suppliers</span></a>
                        </li>
                    @endif

                    @if (\Illuminate\Support\Facades\Auth::user()->user_role_iduser_role == 1)
                    <li class="menu-title">Report Management</li>
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user"
                                aria-hidden="true"></i><span>Reports<span class="pull-right"><i
                                        class="mdi mdi-chevron-right"></i></span> </span></a>
                        <ul class="list-unstyled">
                            <li>
                                <a href="order-report" class="waves-effect"><span>Order Report</span></a>
                            </li>
                            <li>
                                <a href="customer-report" class="waves-effect"><span>Customer Report</span></a>
                            </li>
                            <li>
                                <a href="supplier-report" class="waves-effect"><span>Supplier Report</span></a>
                            </li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="clearfix"></div>
        </div> <!-- end sidebarinner -->
    </div>
    <!-- Left Sidebar End -->
