{{-- @include('admin_panel.layout.header') --}}

{{-- @yield('content')
@include('admin_panel.layout.footer') --}}



<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* ERP Mega Menu & Normal Submenu Compact Styling */
        /* Sophisticated Executive Top Bar & Theme Overrides */
        .rt_nav_header.horizontal-layout .top_nav {
            background: #0f172a !important;
            height: 50px !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
        }
        .rt_nav_header.horizontal-layout .top_nav .rt_nav_wrapper .nav_logo {
            color: #ffffff !important;
            font-size: 1.15rem !important;
            font-weight: 700 !important;
            letter-spacing: -0.3px !important;
        }
        .rt_nav_header.horizontal-layout .top_nav .nav_wrapper_main {
            height: 50px !important;
        }

        .nav-item .submenu,
        .mega-menu .submenu {
            background: #fff;
            padding: 12px;
            /* compact padding */
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .mega-menu .category-heading {
            font-size: 13px;
            font-weight: 600;
            color: #34495e;
            margin-bottom: 8px;
            padding-bottom: 4px;
            border-bottom: 1px solid #eaeaea;
        }

        .nav-item .submenu-item li,
        .mega-menu .submenu-item li {
            margin-bottom: 4px;
            /* less spacing */
        }

        .nav-item .submenu-item li a,
        .mega-menu .submenu-item li a {
            display: flex;
            align-items: center;
            font-size: 15px;
            /* smaller font */
            color: #555;
            padding: 4px 8px;
            /* compact padding */
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .nav-item .submenu-item li a i,
        .mega-menu .submenu-item li a i {
            font-size: 14px;
            margin-right: 6px;
            color: #2980b9;
            min-width: 18px;
            text-align: center;
        }

        .nav-item .submenu-item li a:hover,
        .mega-menu .submenu-item li a:hover {
            background: #f1f7fd;
            color: #2980b9;
            font-weight: 500;
        }

        /* Dynamic Mega Menu Styling */
        @media (min-width: 768px) {
            .rt_nav_header.horizontal-layout .nav-bottom .page-navigation {
                position: relative !important;
            }

            .rt_nav_header.horizontal-layout .nav-bottom .page-navigation > .nav-item.mega-menu,
            li.mega-menu,
            .mega-menu {
                position: static !important;
            }

            .rt_nav_header.horizontal-layout .nav-bottom .page-navigation > .nav-item.mega-menu .submenu,
            li.mega-menu .submenu,
            .mega-menu .submenu {
                position: absolute !important;
                width: 100% !important;
                left: 0 !important;
                right: 0 !important;
            }

            .rt_nav_header.horizontal-layout .nav-bottom .page-navigation > .nav-item.mega-menu .submenu .col-group-wrapper,
            li.mega-menu .submenu .col-group-wrapper {
                display: flex !important;
                flex-wrap: nowrap !important;
                margin: 0 -8px !important;
                /* Offset padding */
            }

            .rt_nav_header.horizontal-layout .nav-bottom .page-navigation > .nav-item.mega-menu .submenu .col-group-wrapper .col-group,
            li.mega-menu .submenu .col-group-wrapper .col-group {
                flex: 0 1 auto !important;
                width: 220px !important;
                /* Consistent column width */
                border-right: 1px solid #f0f0f0 !important;
                padding: 0 16px !important;
            }

            .rt_nav_header.horizontal-layout .nav-bottom .page-navigation > .nav-item.mega-menu .submenu .col-group-wrapper .col-group:last-child,
            li.mega-menu .submenu .col-group-wrapper .col-group:last-child {
                border-right: none !important;
            }

            /* Override Bootstrap col widths inside mega menu */
            .rt_nav_header.horizontal-layout .nav-bottom .page-navigation > .nav-item.mega-menu .submenu .col-group-wrapper .col-md-3,
            li.mega-menu .submenu .col-group-wrapper .col-md-3 {
                flex: none !important;
                max-width: none !important;
            }
        }

        /* ── GLOBAL PRINT STYLES ─────────────────────────────────────────── */
        @media print {

            /* 1. Hide Chrome elements */
            nav.rt_nav_header,
            .nav-bottom,
            footer,
            .navbar-toggler,
            .top_nav,
            .filter-card,
            .filter-bar,
            .topbar-actions,
            .rpt-actions,
            .kpi-row,
            .kpi-strip,
            .led-filters,
            .btn-search,
            .btn-reset,
            .btn-csv,
            .btn-print,
            .btn-inv,
            .btn-exp,
            .btn-expand,
            .btn-srp,
            .total-strip,
            .loader-overlay,
            .led-loader,
            .dataTables_filter,
            .dataTables_length,
            .dataTables_info,
            .dataTables_paginate,
            .empty-state,
            .container-scroller>nav {
                display: none !important;
            }

            /* 2. Page layout resets */
            body,
            html {
                background: #fff !important;
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
            }

            .container-scroller,
            .main-content,
            .main-content-inner,
            .container-fluid {
                display: block !important;
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
            }

            /* 3. Reveal table and details */
            .items-row,
            .detail-row,
            .wh-row {
                display: table-row !important;
            }

            #ledgerResult,
            #tableWrap,
            #stockTableWrap,
            .print-header {
                display: block !important;
            }

            /* 4. Table visual cleanup */
            table {
                border-collapse: collapse !important;
                width: 100% !important;
                font-size: 11px !important;
            }

            th,
            td {
                border: 1px solid #999 !important;
                padding: 4px 8px !important;
            }

            thead th {
                background-color: #f0f0f0 !important;
                color: #000 !important;
                font-weight: 700 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .table-card,
            .tbl-card {
                box-shadow: none !important;
                border-radius: 0 !important;
                border: none !important;
                margin: 0 !important;
            }

            /* 5. Header formatting */
            .print-header {
                display: block !important;
                margin-bottom: 20px;
                border-bottom: 2px solid #000;
                padding-bottom: 10px;
            }

            tr {
                page-break-inside: avoid;
            }
        }
    </style>
    <!--=========================*
                Met Data
    *===========================-->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Zare Bootstrap 4 Admin Template">

    <!--=========================*
              Page Title
    *===========================-->
    <title>@yield('title', 'Prowaves ERP')</title>

    <!--=========================*
                Favicon
    *===========================-->

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/ionicons.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/et-line.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/feather.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/flag-icon.min.css') }}">
    <script src="{{ asset('assets/js/modernizr-2.8.3.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/metisMenu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slicknav.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/am-charts/css/am-charts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/charts/morris-bundle/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/charts/c3charts/c3.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/data-table/css/jquery.dataTables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/data-table/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/data-table/css/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/data-table/css/responsive.jqueryui.min.css') }}">
    {{-- Removed Duplicate External CDN Scripts (BS5/jQuery) to prevent conflicts with Template BS4 --}}
    {{-- Online Links --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/brands.min.css"
        integrity="sha512-58P9Hy7II0YeXLv+iFiLCv1rtLW47xmiRpC1oFafeKNShp8V5bKV/ciVtYqbk2YfxXQMt58DjNfkXFOn62xE+g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/brands.min.css"
        integrity="sha512-58P9Hy7II0YeXLv+iFiLCv1rtLW47xmiRpC1oFafeKNShp8V5bKV/ciVtYqbk2YfxXQMt58DjNfkXFOn62xE+g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Flatpickr CSS for dd/mm/yyyy Date Picker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    @vite(['resources/js/app.js'])
    @yield('style')
</head>

<body>
    <!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

    <!--=========================*
         Page Container
*===========================-->
    <div class="container-scroller">
        <!--=========================*
              Navigation
    *===========================-->
        <nav class="rt_nav_header horizontal-layout col-lg-12 col-12 p-0">
            <div class="top_nav flex-grow-1">
                <div class="container d-flex flex-row h-100 align-items-center">
                    <!--=========================*
                              Logo
                *===========================-->
                    <div class="text-center rt_nav_wrapper d-flex align-items-center">
                        {{-- <a class="nav_logo rt_logo" href="index.html"><img  src="{{asset('assets/images/WIJDAN-removebg-preview.png')}}" alt="logo" /></a> --}}
                        <a class="nav_logo rt_logo text-success" href="index.html">Prowaves</a>
                        {{-- <a class="nav_logo nav_logo_mob" href="index.html"><img src="{{asset('assets/images/WIJDAN-removebg-preview.png')}}" alt="logo"/></a> --}}
                    </div>
                    <!--=========================*
                           End Logo
               *===========================-->
                    <div class="nav_wrapper_main d-flex align-items-center justify-content-between flex-grow-1">
                        <ul class="navbar-nav navbar-nav-right mr-0 ml-auto d-flex align-items-center">
                            @auth
                                {{-- Hidden branch switch form & script to preserve compatibility --}}
                                <form method="POST" action="{{ route('branch.switch') }}" id="branchSwitchForm" style="display:none;">
                                    @csrf
                                    <input type="hidden" name="branch_id" id="branchSwitchInput" value="">
                                </form>
                                <script>
                                    function switchBranch(branchId) {
                                        var input = document.getElementById('branchSwitchInput');
                                        var form = document.getElementById('branchSwitchForm');
                                        if (input && form) {
                                            input.value = branchId;
                                            form.submit();
                                        }
                                    }
                                </script>

                                <li class="nav-item d-flex align-items-center">
                                    <span class="mr-3 d-inline-flex align-items-center" style="font-size: 13px; gap: 7px;">
                                        <i class="fas fa-user-circle" style="font-size: 16px; color: #d4af37;"></i>
                                        <span style="color: #f1ede4; font-weight: 600; letter-spacing: 0.2px;">{{ Auth::user()->name }}</span>
                                    </span>
                                    <form method="POST" action="{{ route('logout') }}" class="d-inline mb-0">
                                        @csrf
                                        <button type="submit" class="btn btn-sm d-inline-flex align-items-center shadow-sm"
                                            style="background: rgba(220, 38, 38, 0.18); border: 1px solid rgba(220, 38, 38, 0.4); color: #fca5a5; padding: 4px 12px; border-radius: 6px; font-weight: 600; font-size: 11.5px; gap: 6px; transition: all 0.2s;"
                                            onmouseover="this.style.background='#dc2626'; this.style.color='#fff';"
                                            onmouseout="this.style.background='rgba(220, 38, 38, 0.18)'; this.style.color='#fca5a5';"
                                            title="Logout">
                                            <i class="fas fa-power-off"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            @endauth
                        </ul>
                        <!--=========================*
                               Mobile Menu
                   *===========================-->
                        <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
                            <span class="fas fa-bars text-white"></span>
                        </button>
                        <!--=========================*
                           End Mobile Menu
                   *===========================-->
                    </div>
                </div>
            </div>
            <div class="nav-bottom">
                <div class="container">
                    <ul class="nav page-navigation">
                        <!--=========================*
                              Home
                    *===========================-->
                        <li class="nav-item">
                            <a href="{{ url('/home') }}" class="nav-link"><i
                                    class="menu_icon fas fa-home"></i><span class="menu-title">Dashboard</span></a>
                        </li>
                        <!--=========================*
                              UI Features
                    *===========================-->
                        <li class="nav-item mega-menu">
                            @canany(['products.view', 'discount.products.view', 'categories.view', 'subcategories.view',
                                'brands.view', 'units.view', 'vendors.view', 'warehouse.view', 'warehouse.stock.view',
                                'stock.transfer.view', 'sales.view', 'customers.view', 'sales.officers.view'])
                                <a href="#" class="nav-link">
                                    <i class="menu_icon fas fa-cogs"></i>
                                    <span class="menu-title">Management</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="submenu">
                                    <div class="col-group-wrapper row">
                                        <!-- Products & Categories -->
                                        @canany(['products.view', 'discount.products.view', 'categories.view',
                                            'subcategories.view', 'brands.view'])
                                            <div class="col-group col-md-3">
                                                <p class="category-heading">Products & Categories</p>
                                                <ul class="submenu-item">

                                                    @can('products.view')
                                                        <li><a href="{{ route('product') }}"><i class="fas fa-box"></i>
                                                                Products</a></li>
                                                        <li><a href="{{ route('batches.opening') }}"><i
                                                                    class="fas fa-boxes-stacked"></i>
                                                                Opening Stock Batches</a></li>
                                                    @endcan


                                                    @can('categories.view')
                                                        <li><a href="{{ route('Category.home') }}"><i class="fas fa-list"></i>
                                                                Category</a></li>
                                                    @endcan

                                                    @can('subcategories.view')
                                                        <li><a href="{{ route('subcategory.home') }}"><i
                                                                    class="fas fa-th-list"></i> Sub Category</a></li>
                                                    @endcan

                                                    @can('brands.view')
                                                        <li><a href="{{ route('Brand.home') }}"><i class="fas fa-trademark"></i>
                                                                Company</a></li>
                                                    @endcan


                                                </ul>
                                            </div>
                                        @endcanany
                                        <!-- Purchase & Inventory -->
                                        @canany(['vendors.view', 'purchases.view'])
                                            <div class="col-group col-md-3">
                                                <p class="category-heading">Purchase & Inventory</p>
                                                <ul class="submenu-item">
                                                    @can('vendors.view')
                                                        <li><a href="{{ route('vendors.index') }}"><i class="fas fa-truck"></i>
                                                                Vendor</a>
                                                        </li>
                                                    @endcan
                                                    @can('purchases.view')
                                                        <li><a
                                                                href="{{ route('Purchase.home', ['status' => 'draft', 'mode' => 'po']) }}"><i
                                                                    class="fas fa-file-invoice"></i> Purchase Order</a></li>
                                                        <li><a href="{{ route('Purchase.home') }}"><i
                                                                    class="fas fa-shopping-cart"></i> Goods Receipt Note</a>
                                                        </li>
                                                        <li><a href="{{ route('purchase.return.index') }}"><i
                                                                    class="fas fa-undo-alt"></i> Purchase Return Note</a>
                                                        </li>
                                                    @endcan
                                                </ul>
                                            </div>
                                        @endcanany
                                        <!-- Accounts -->
                                        @canany(['warehouse.view', 'warehouse.stock.view', 'stock.transfer.view'])
                                            <div class="col-group col-md-3">
                                                <p class="category-heading">Warehouse</p>
                                                <ul class="submenu-item">
                                                    @can('warehouse.view')
                                                        <li><a href="{{ url('warehouse') }}"><i class="fas fa-warehouse"></i>
                                                                Warehouse</a></li>
                                                    @endcan
                                                    @can('warehouse.stock.view')
                                                        <li><a href="{{ url('warehouse_stocks') }}"><i class="fas fa-boxes"></i>
                                                                Warehouse Stock</a></li>
                                                    @endcan
                                                    @can('stock.transfer.view')
                                                        <li><a href="{{ url('stock_transfers') }}"><i
                                                                    class="fas fa-exchange-alt"></i> Stock Transfer</a></li>
                                                    @endcan
                                                </ul>
                                            </div>
                                        @endcanany
                                        <!-- Customers & Sales -->
                                        @canany(['sales.view', 'customers.view', 'sales.officers.view',
                                            'receipts.voucher.view'])
                                            <div class="col-group col-md-3">
                                                <p class="category-heading"> Tender & Customers</p>
                                                <ul class="submenu-item">
                                                    @can('sales.view')
                                                        <li><a href="{{ url('sale') }}"><i class="fas fa-receipt"></i>
                                                                Sales</a></li>
                                                    @endcan
                                                    @can('customers.view')
                                                        <li><a href="{{ url('customers') }}"><i class="fas fa-user"></i>
                                                                Customer</a></li>
                                                    @endcan
                                                    <li><a href="{{ route('cdrs.index') }}"><i
                                                                class="fas fa-file-invoice-dollar"></i>
                                                            Tender / CDR</a></li>
                                                    <li><a href="{{ url('zone') }}"><i class="fas fa-map-marker-alt"></i>
                                                            Zone</a></li>
                                                </ul>
                                            </div>
                                        @endcanany

                                        @can('sales.view')
                                            <div class="col-group col-md-3">
                                                <p class="category-heading">Sale Notes</p>
                                                <ul class="submenu-item">
                                                    <li><a href="{{ route('sale.order.index') }}"><i
                                                                class="fas fa-file-invoice"></i> Sale Order</a></li>
                                                    <li><a href="{{ route('delivery.note.index') }}"><i
                                                                class="fas fa-truck"></i> Delivery Note</a></li>
                                                    <li><a href="{{ route('sale.receipt.index') }}"><i
                                                                class="fas fa-receipt"></i> Sale Invoice Note</a></li>
                                                    <li><a href="{{ route('sale.return.index') }}"><i
                                                                class="fas fa-undo"></i> Sale Return Note</a></li>
                                                    <li><a href="{{ route('delivery.return.index') }}"><i
                                                                class="fas fa-undo-alt"></i> Sale Delivery Return Note</a></li>
                                                </ul>
                                            </div>
                                        @endcan

                                    </div>
                                </div>
                            @endcanany
                        </li>


                        <!-- Vouchers Menu -->
                        <li class="nav-item">
                            @canany(['chart.of.accounts.view', 'expense.voucher.view', 'receipts.voucher.view',
                                'journal.voucher.view', 'payment.voucher.view', 'income.voucher.view'])
                                <a href="#" class="nav-link">
                                    <i class="menu_icon fas fa-clipboard-list"></i>
                                    <span class="menu-title">Vouchers</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="submenu">
                                    <ul class="submenu-item">
                                        @can('chart.of.accounts.view')
                                            <li><a href="{{ route('view_all') }}"><i class="fa-solid fa-list-ol"></i>
                                                    Chart Of Accounts</a></li>
                                        @endcan
                                        @can('receipts.voucher.view')
                                            <li><a href="{{ route('vouchers.list', 'crv') }}"><i
                                                        class="fa-solid fa-hand-holding-usd text-success"></i> Cash Receiving (CRV)</a></li>
                                            <li><a href="{{ route('vouchers.list', 'brv') }}"><i
                                                        class="fa-solid fa-university text-primary"></i> Bank Receiving (BRV)</a></li>
                                        @endcan
                                        @can('payment.voucher.view')
                                            <li><a href="{{ route('vouchers.list', 'cpv') }}"><i
                                                        class="fa-solid fa-money-bill-wave text-warning"></i> Cash Payment (CPV)</a></li>
                                            <li><a href="{{ route('vouchers.list', 'bpv') }}"><i
                                                        class="fa-solid fa-file-invoice-dollar text-purple"></i> Bank Payment (BPV)</a></li>
                                        @endcan
                                        @can('journal.voucher.view')
                                            <li><a href="{{ route('vouchers.list', 'jv') }}"><i
                                                        class="fa-solid fa-book text-secondary"></i> Journal Voucher (JV)</a></li>
                                        @endcan
                                        @can('receipts.voucher.view')
                                            <li><a href="{{ route('cheques.index') }}"><i
                                                        class="fa-solid fa-money-check"></i> Cheque Management</a></li>
                                        @endcan
                                    </ul>
                                </div>
                            @endcanany
                        </li>
                        <li class="nav-item">
                            @canany(['item.stock.report.view', 'purchase.report.view', 'sale.report.view',
                                'customer.ledger.view', 'inventory.onhand.view'])
                                <a href="#" class="nav-link">
                                    <i class="menu_icon fas fa-clipboard-list"></i>
                                    <span class="menu-title">Reports</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="submenu">
                                    <ul class="submenu-item">
                                        @can('item.stock.report.view')
                                            <li><a href="{{ route('report.item_stock') }}"><i class="fa-solid fa-users"></i>
                                                    Item Stock Report</a></li>
                                        @endcan
                                        @can('purchase.report.view')
                                            <li><a href="{{ route('report.purchase') }}"><i class="fa-solid fa-users"></i>
                                                    Purchase Report</a></li>
                                        @endcan
                                        @can('sale.report.view')
                                            <li><a href="{{ route('report.sale') }}"><i class="fa-solid fa-users"></i> Sale
                                                    Report</a></li>
                                        @endcan
                                        <li><a href="{{ route('reports.expiry') }}"><i
                                                    class="fa-solid fa-clock-rotate-left"></i> Batch Expiry Report</a></li>
                                        @can('customer.ledger.view')
                                            <li><a href="{{ route('report.customer.ledger') }}"><i
                                                        class="fa-solid fa-users"></i> Customer Ledger</a></li>
                                            <li><a href="{{ route('report.vendor.ledger') }}"><i
                                                        class="fa-solid fa-truck-field"></i> Vendor Ledger</a></li>
                                        @endcan


                                        @can('inventory.onhand.view')
                                            <li><a href="{{ route('reports.onhand') }}"><i class="fas fa-warehouse"></i>
                                                    Inventory On-Hand</a></li>
                                        @endcan
                                        @can('warehouse.stock.view')
                                            <li><a href="{{ route('report.warehouse') }}"><i class="fas fa-boxes"></i>
                                                    Warehouse Report</a></li>
                                        @endcan
                                        <li><a href="{{ route('reports.profit_loss') }}"><i
                                                    class="fas fa-chart-line"></i> Profit &amp; Loss</a></li>
                                        <li><a href="{{ route('report.cdr') }}"><i
                                                    class="fa-solid fa-file-invoice-dollar"></i> CDR Report</a></li>
                                        <li><a href="{{ route('report.price_adjustment') }}"><i
                                                    class="fa-solid fa-tags"></i> Price Adjustment Report</a></li>
                                        <li><a href="{{ route('report.dc') }}"><i
                                                    class="fa-solid fa-truck"></i> DC Report</a></li>
                                        <li><a href="{{ route('report.product.ledger') }}"><i
                                                    class="fa-solid fa-book-open"></i> Product Ledger</a></li>
                                        <li><a href="{{ route('report.voucher') }}"><i
                                                    class="fa-solid fa-file-invoice-dollar"></i> Voucher Report</a></li>
                                    </ul>
                                </div>
                            @endcanany
                        </li>
                        <!-- HR Management Menu -->
                        <li class="nav-item">
                            @canany(['hr.departments.view', 'hr.designations.view', 'hr.employees.view',
                                'hr.attendance.view', 'hr.payroll.view', 'hr.leaves.view', 'hr.salary.structure.view',
                                'hr.shifts.view', 'hr.holidays.view', 'hr.loans.view', 'hr.biometric.devices.view'])
                                <a href="#" class="nav-link">
                                    <i class="menu_icon fas fa-users-cog"></i>
                                    <span class="menu-title">HR Management</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="submenu">
                                    <ul class="submenu-item">
                                        @can('hr.departments.view')
                                            <li><a href="{{ route('hr.departments.index') }}"><i
                                                        class="fa-solid fa-building"></i> Departments</a></li>
                                        @endcan
                                        @can('hr.designations.view')
                                            <li><a href="{{ route('hr.designations.index') }}"><i
                                                        class="fa-solid fa-id-badge"></i> Designations</a></li>
                                        @endcan
                                        @can('hr.employees.view')
                                            <li><a href="{{ route('hr.employees.index') }}"><i
                                                        class="fa-solid fa-user-tie"></i> Employees</a></li>
                                        @endcan
                                        @can('hr.attendance.view')
                                            <li><a href="{{ route('hr.attendance.index') }}"><i
                                                        class="fa-solid fa-clock"></i> Attendance</a></li>
                                        @endcan
                                        @can('hr.payroll.view')
                                            <li><a href="{{ route('hr.payroll.index') }}"><i
                                                        class="fa-solid fa-money-check-alt"></i> Payroll</a></li>
                                        @endcan
                                        <li><a href="{{ route('hr.payroll.my-commission') }}"><i
                                                    class="fa-solid fa-percent text-warning"></i> My Commission</a></li>
                                        @can('hr.leaves.view')
                                            <li><a href="{{ route('hr.leaves.index') }}"><i
                                                        class="fa-solid fa-calendar-minus"></i> Leaves</a></li>
                                        @endcan
                                        @can('hr.salary.structure.view')
                                            <li><a href="{{ route('hr.salary-structure.index') }}"><i
                                                        class="fa-solid fa-coins"></i> Salary Structure</a></li>
                                        @endcan
                                        @can('hr.shifts.view')
                                            <li><a href="{{ route('hr.shifts.index') }}"><i class="fa-solid fa-clock"></i>
                                                    Shifts</a></li>
                                        @endcan
                                        @can('hr.holidays.view')
                                            <li><a href="{{ route('hr.holidays.index') }}"><i
                                                        class="fa-solid fa-calendar-alt"></i> Holidays</a></li>
                                        @endcan
                                        @can('hr.loans.view')
                                            <li><a href="{{ route('hr.loans.index') }}"><i
                                                        class="fa-solid fa-hand-holding-dollar"></i> Loans</a></li>
                                        @endcan
                                        @can('hr.biometric.devices.view')
                                            <li><a href="{{ route('hr.biometric-devices.index') }}"><i
                                                        class="fa-solid fa-fingerprint"></i> Biometric Devices</a></li>
                                        @endcan
                                    </ul>
                                </div>
                            @endcanany
                        </li>
                        <!-- User Management Menu -->
                        <li class="nav-item">
                            @canany(['users.view', 'roles.view', 'permissions.view', 'branches.view'])
                                <a href="#" class="nav-link">
                                    <i class="menu_icon fas fa-clipboard-list"></i>
                                    <span class="menu-title">User Management</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="submenu">
                                    <ul class="submenu-item">
                                        @can('users.view')
                                            <li><a href="{{ route('users.index') }}"><i class="fa-solid fa-users"></i>
                                                    Users</a></li>
                                        @endcan
                                        @can('roles.view')
                                            <li><a href="{{ route('roles.index') }}"><i class="fa-solid fa-user-lock"></i>
                                                    Roles</a></li>
                                        @endcan
                                        @can('permissions.view')
                                            <li><a href="{{ route('permissions.index') }}"><i
                                                        class="fa-solid fa-user-lock"></i> Permissions</a></li>
                                        @endcan
                                        @can('branches.view')
                                            @if (auth()->user()->isSuperAdmin())
                                                <li><a href="{{ route('branch.index') }}"><i
                                                            class="fa-solid fa-code-branch"></i>
                                                        Branches</a></li>
                                            @endif
                                        @endcan
                                    </ul>
                                </div>
                            @endcanany
                        </li>

                        <!-- Settings -->
                        @if (auth()->check() && (auth()->user()->email === 'admin@admin.com' || auth()->user()->hasRole('Super Admin')))
                            <li class="nav-item">
                                <a href="{{ route('settings.index') }}" class="nav-link">
                                    <i class="menu_icon fas fa-cog"></i>
                                    <span class="menu-title">Settings</span>
                                </a>
                            </li>
                        @endif

                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

        <footer>
            <div class="footer-area">
                <p>&copy; Copyright 2025. All right reserved. Three Star  Company.</p>
            </div>
        </footer>
    </div>
    <!-- Jquery Js -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <!-- bootstrap 4 js -->
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <!-- Owl Carousel Js -->
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <!-- Metis Menu Js -->
    <script src="{{ asset('assets/js/metisMenu.min.js') }}"></script>
    <!-- SlimScroll Js -->
    <script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>
    <!-- Slick Nav -->
    <script src="{{ asset('assets/js/jquery.slicknav.min.js') }}"></script>

    <!-- start amchart js -->
    <script src="{{ asset('assets/vendors/am-charts/js/ammap.js') }}"></script>
    <script src="{{ asset('assets/vendors/am-charts/js/worldLow.js') }}"></script>
    <script src="{{ asset('assets/vendors/am-charts/js/continentsLow.js') }}"></script>
    <script src="{{ asset('assets/vendors/am-charts/js/light.js') }}"></script>
    <!-- maps js -->
    <script src="{{ asset('assets/js/am-maps.js') }}"></script>

    <!-- Morris Chart -->
    <script src="{{ asset('assets/vendors/charts/morris-bundle/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/charts/morris-bundle/morris.js') }}"></script>

    <!-- Chart Js -->
    <script src="{{ asset('assets/vendors/charts/charts-bundle/Chart.bundle.js') }}"></script>

    <!-- C3 Chart -->
    <script src="{{ asset('assets/vendors/charts/c3charts/c3.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/charts/c3charts/d3-5.4.0.min.js') }}"></script>

    <!-- Data Table js -->
    <script src="{{ asset('assets/vendors/data-table/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/vendors/data-table/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/data-table/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/data-table/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/data-table/js/responsive.bootstrap.min.js') }}"></script>

    <!-- Sparkline Chart -->
    <script src="{{ asset('assets/vendors/charts/sparkline/jquery.sparkline.js') }}"></script>

    <!-- Home Script -->
    <script src="{{ asset('assets/js/home.js') }}"></script>

    <!-- Main Js -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('js')

    <!-- Global SweetAlert Toast/Popup -->
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: "{{ session('error') }}",
            });
        @endif
    </script>

    {{-- Disable BrowserSync Ghost Mode (stops cross-tab navigation/scroll/click sync) --}}
    <script>
        // Kill Ghost Mode before BrowserSync has a chance to attach
        (function() {
            // 1. Disconnect immediately if already connected
            if (window.___browserSync___) {
                try {
                    window.___browserSync___.socket.disconnect();
                    window.___browserSync___.ghostMode = false;
                } catch (e) {}
            }

            // 2. Override the BrowserSync init to disable ghost mode on load
            var _bsOrigDef = Object.getOwnPropertyDescriptor(window, '___browserSync___');
            Object.defineProperty(window, '___browserSync___', {
                set: function(bs) {
                    try {
                        if (bs && bs.socket) {
                            bs.socket.disconnect();
                        }
                        if (bs && bs.options && bs.options.ghostMode) {
                            bs.options.ghostMode = {
                                clicks: false,
                                scroll: false,
                                forms: {
                                    submit: false,
                                    inputs: false,
                                    toggles: false
                                }
                            };
                        }
                    } catch (e) {}
                    // Store but neutralized
                    if (_bsOrigDef && _bsOrigDef.set) {
                        _bsOrigDef.set.call(this, bs);
                    } else {
                        Object.defineProperty(window, '___browserSync___', {
                            value: bs,
                            writable: true,
                            configurable: true
                        });
                    }
                },
                get: function() {
                    return _bsOrigDef && _bsOrigDef.get ? _bsOrigDef.get.call(this) : undefined;
                },
                configurable: true
            });
        })();
    </script>
    <!-- ==============================================
         GLOBAL ERP IMPORT LOADING SCREEN 
         ============================================== -->
    <style>
        .erp-import-overlay {
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            background: rgba(0, 0, 0, 0.85);
            z-index: 999999;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(5px);
        }
        .erp-import-modal {
            background: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
            width: 400px;
            max-width: 90vw;
            font-family: inherit;
        }
        .erp-import-modal .loader-spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 40px; height: 40px;
            animation: erp-spin 1s linear infinite;
            margin: 0 auto 15px auto;
        }
        @keyframes erp-spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        .erp-import-modal .loader-title {
            text-align: center;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 25px;
            color: #333;
        }
        .erp-import-modal .loader-steps {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .erp-import-modal .loader-step {
            font-size: 0.95rem;
            color: #666;
            display: flex;
            align-items: center;
            transition: all 0.2s ease;
        }
        .erp-import-modal .loader-step .step-icon {
            width: 20px;
            margin-right: 10px;
            text-align: center;
            font-size: 1rem;
        }
        .erp-import-modal .loader-step.completed { color: #10ac84; font-weight: 500; }
        .erp-import-modal .loader-step.completed .step-icon { color: #10ac84; }
        .erp-import-modal .loader-step.active { color: #3498db; font-weight: 600; }
        .erp-import-modal .loader-step.active .step-icon { color: #3498db; }
        .erp-import-modal .loader-step.error { color: #ee5253; font-weight: 600; }
        .erp-import-modal .loader-step.error .step-icon { color: #ee5253; }
    </style>

    <div id="erp-import-loader" class="erp-import-overlay" style="display: none;">
        <div class="erp-import-modal">
            <div class="loader-spinner"></div>
            <h4 class="loader-title" id="erp-loader-title">Importing data, please wait...</h4>
            <div class="loader-steps" id="erp-loader-steps">
                <div class="loader-step" data-step="1"><i class="fas fa-circle step-icon text-muted"></i> Validating selected document</div>
                <div class="loader-step" data-step="2"><i class="fas fa-circle step-icon text-muted"></i> Fetching data</div>
                <div class="loader-step" data-step="3"><i class="fas fa-circle step-icon text-muted"></i> Mapping fields</div>
                <div class="loader-step" data-step="4"><i class="fas fa-circle step-icon text-muted"></i> Processing items</div>
                <div class="loader-step" data-step="5"><i class="fas fa-circle step-icon text-muted"></i> Calculating totals & taxes</div>
                <div class="loader-step" data-step="6"><i class="fas fa-circle step-icon text-muted"></i> Creating documents</div>
                <div class="loader-step" data-step="7"><i class="fas fa-circle step-icon text-muted"></i> Updating stock</div>
                <div class="loader-step" data-step="8"><i class="fas fa-circle step-icon text-muted"></i> Finalizing</div>
            </div>
            <div class="loader-actions" id="erp-loader-actions" style="display: none; margin-top: 25px; text-align: center;">
                <button type="button" class="btn btn-danger px-4 rounded-pill" onclick="ERPImportLoader.hide()">Close</button>
            </div>
        </div>
    </div>

    <script>
        window.ERPImportLoader = {
            timer: null,
            currentStep: 1,
            isError: false,
            // Event listener functions bound to this
            preventInteraction: function(e) {
                // Allow interaction if it's within the close button so the user can acknowledge error
                if ($(e.target).closest('#erp-loader-actions').length) return true;
                e.preventDefault();
                e.stopPropagation();
                return false;
            },
            preventKeyboard: function(e) {
                if (['Tab', 'Enter', 'Space', 'Escape'].includes(e.code) || e.keyCode === 9 || e.keyCode === 13 || e.keyCode === 32 || e.keyCode === 27) {
                    e.preventDefault();
                    e.stopPropagation();
                    return false;
                }
            },
            start: function() {
                this.isError = false;
                this.currentStep = 1;
                $('#erp-import-loader').fadeIn('fast');
                $('#erp-loader-title').text('Importing data, please wait...').css('color', '#333');
                $('#erp-import-loader .loader-spinner').show();
                $('#erp-loader-actions').hide();
                
                // Reset steps
                $('.loader-step').removeClass('completed active error').css('color', '#666');
                $('.loader-step .step-icon').removeClass('fa-check fa-times fa-spin fa-circle-notch text-muted').addClass('fa-circle text-muted');
                
                // Block interaction strictly
                document.addEventListener('keydown', this.preventKeyboard, { capture: true });
                document.addEventListener('click', this.preventInteraction, { capture: true });
                
                this.updateStep(1);
                
                // Simulate progress through first 5 steps while waiting
                let self = this;
                let stepDelay = 800;
                
                let simulateSteps = function() {
                    if (self.isError || self.currentStep >= 5) return;
                    self.completeStep(self.currentStep);
                    self.currentStep++;
                    self.updateStep(self.currentStep);
                    if (self.currentStep < 5) {
                        self.timer = setTimeout(simulateSteps, stepDelay);
                    }
                };
                
                this.timer = setTimeout(simulateSteps, stepDelay);
            },
            updateStep: function(step) {
                let $step = $('.loader-step[data-step="' + step + '"]');
                $step.addClass('active');
                $step.find('.step-icon').removeClass('fa-circle text-muted').addClass('fa-circle-notch fa-spin');
            },
            completeStep: function(step) {
                let $step = $('.loader-step[data-step="' + step + '"]');
                $step.removeClass('active').addClass('completed');
                $step.find('.step-icon').removeClass('fa-circle-notch fa-spin').addClass('fa-check');
            },
            errorStep: function(step) {
                let $step = $('.loader-step[data-step="' + step + '"]');
                $step.removeClass('active').addClass('error');
                $step.find('.step-icon').removeClass('fa-circle-notch fa-spin').addClass('fa-times');
            },
            success: function() {
                clearTimeout(this.timer);
                if (this.isError) return;
                
                let self = this;
                // Rapidly complete remaining steps
                let completeRemaining = function(step) {
                    if (step <= 8) {
                        if (step > self.currentStep) {
                            self.updateStep(step);
                        }
                        setTimeout(() => {
                            self.completeStep(step);
                            setTimeout(() => completeRemaining(step + 1), 150);
                        }, 50);
                    } else {
                        $('#erp-loader-title').text('Import completed successfully').css('color', '#10ac84');
                        $('#erp-import-loader .loader-spinner').hide();
                        setTimeout(() => self.hide(), 1200);
                    }
                };
                
                // Finish current pending step immediately
                if(this.currentStep < 8) {
                    this.completeStep(this.currentStep);
                    completeRemaining(this.currentStep + 1);
                } else {
                    completeRemaining(8);
                }
            },
            error: function(message) {
                clearTimeout(this.timer);
                if (this.isError) return;
                this.isError = true;
                
                this.errorStep(this.currentStep);
                $('#erp-loader-title').text(message || 'Import failed. Please try again.').css('color', '#ee5253');
                $('#erp-import-loader .loader-spinner').hide();
                $('#erp-loader-actions').fadeIn();
                
                // Unblock keyboard so user can navigate if needed, but keep click block (except on close button)
                document.removeEventListener('keydown', this.preventKeyboard, { capture: true });
            },
            hide: function() {
                $('#erp-import-loader').fadeOut('fast');
                document.removeEventListener('keydown', this.preventKeyboard, { capture: true });
                document.removeEventListener('click', this.preventInteraction, { capture: true });
            }
        };
        // Ensure function contexts are bound correctly
        window.ERPImportLoader.preventInteraction = window.ERPImportLoader.preventInteraction.bind(window.ERPImportLoader);
        window.ERPImportLoader.preventKeyboard = window.ERPImportLoader.preventKeyboard.bind(window.ERPImportLoader);
    </script>

    <!-- Flatpickr JS for dd/mm/yyyy Date Format -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initGlobalDatepickers();
        });

        function initGlobalDatepickers(container = document) {
            if (typeof flatpickr === 'undefined') return;
            const dateInputs = container.querySelectorAll('input[type="date"], input.datepicker-ddmmyyyy');
            dateInputs.forEach(input => {
                if (input._flatpickr) return;
                input.type = 'text';
                
                if (!input.placeholder) {
                    input.placeholder = 'dd/mm/yyyy';
                }

                flatpickr(input, {
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "d/m/Y",
                    allowInput: true
                });
            });
        }

        if (typeof $ !== 'undefined') {
            $(document).on('shown.bs.modal shown.bs.tab', function(e) {
                initGlobalDatepickers(e.target);
            });
        }
    </script>
    <!-- ============================================== -->
</body>

</html>
