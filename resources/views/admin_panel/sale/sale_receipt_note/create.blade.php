@extends('admin_panel.layout.app')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        /* ========================================================
           MODERN SAAS / ERP PALETTE: CRISP SLATE & VIBRANT EMERALD
           ======================================================== */
        :root {
            --theme-bg: #f8fafc;              /* Crisp clean porcelain canvas */
            --theme-card-bg: #ffffff;         /* Pure crisp white */
            --theme-surface-subtle: #f1f5f9;  /* Cool soft slate */
            --theme-border: #e2e8f0;          /* Clean modern slate border */
            --theme-border-strong: #cbd5e1;   /* Defined slate border */
            --theme-text-dark: #0f172a;       /* Deep executive slate */
            --theme-text-muted: #64748b;      /* Clean muted slate */
            --theme-accent-emerald: #059669;  /* Vibrant executive emerald */
            --theme-accent-emerald-hover: #047857;
            --theme-accent-navy: #0f172a;     /* Obsidian executive slate */
            --theme-accent-amber: #d97706;    /* Warm amber */
            --theme-danger: #dc2626;          /* Crisp red */
        }

        body, .main-content {
            background-color: var(--theme-bg) !important;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
            color: var(--theme-text-dark) !important;
            font-size: 12px;
        }

        /* Zero-Scroll Page Overrides */
        .main-content-inner,
        .content-wrapper {
            padding: 3px 0 0 0 !important;
        }

        .container-fluid {
            padding: 2px 12px 6px 12px !important;
            max-width: 100% !important;
        }

        footer {
            display: none !important;
        }

        /* Top Bar */
        .qb-topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 2px 4px;
            margin-bottom: 3px;
        }

        .qb-page-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--theme-text-dark);
            letter-spacing: -0.3px;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .qb-btn-import {
            background: #ffffff;
            color: var(--theme-accent-emerald);
            border: 1px solid var(--theme-border-strong);
            font-size: 11.5px;
            font-weight: 600;
            padding: 3px 12px;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.15s ease;
            height: 28px;
        }
        .qb-btn-import:hover:not(:disabled) {
            background: #f8fafc;
            border-color: var(--theme-accent-emerald);
        }
        .qb-btn-import:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .qb-btn-back {
            background: #ffffff;
            color: #475569;
            border: 1px solid var(--theme-border-strong);
            font-size: 11.5px;
            font-weight: 600;
            padding: 3px 12px;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
            height: 28px;
            transition: all 0.15s;
        }
        .qb-btn-back:hover {
            background: #f8fafc;
            color: #0f172a;
        }

        /* Cards */
        .qb-card {
            background: var(--theme-card-bg);
            border: 1px solid var(--theme-border);
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04), 0 1px 2px rgba(0, 0, 0, 0.02);
            margin-bottom: 3px;
        }

        .qb-section-title {
            font-size: 11px;
            font-weight: 700;
            color: var(--theme-text-dark);
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Labels & Inputs */
        .qb-lbl {
            font-size: 9.5px;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-bottom: 1px;
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .qb-input {
            height: 26px !important;
            padding: 2px 8px !important;
            font-size: 11.5px !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 4px !important;
            background-color: #ffffff !important;
            color: var(--theme-text-dark) !important;
            transition: border-color .15s, box-shadow .15s;
        }
        .qb-input:focus {
            border-color: var(--theme-accent-emerald) !important;
            box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.12) !important;
            outline: none !important;
        }
        .qb-input:read-only {
            background-color: #f8fafc !important;
            color: #334155 !important;
            border-color: #e2e8f0 !important;
            font-weight: 600;
        }

        .btn-select-modal {
            height: 26px !important;
            padding: 0 9px !important;
            background: #f8fafc !important;
            border: 1px solid #cbd5e1 !important;
            border-right: none !important;
            border-top-left-radius: 4px !important;
            border-bottom-left-radius: 4px !important;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .qb-input-name {
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
            cursor: pointer;
        }

        .qb-select {
            height: 26px !important;
            padding: 1px 6px !important;
            font-size: 11.5px !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 4px !important;
            background-color: #ffffff !important;
            color: var(--theme-text-dark) !important;
        }
        .qb-select:focus {
            border-color: var(--theme-accent-emerald) !important;
            box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.12) !important;
            outline: none !important;
        }

        /* Pill Toggles */
        .qb-check-pill {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 10.5px;
            font-weight: 600;
            color: var(--theme-text-dark);
            background: #f8fafc;
            border: 1px solid var(--theme-border-strong);
            border-radius: 4px;
            padding: 2px 7px;
            cursor: pointer;
            user-select: none;
            margin-bottom: 0;
            white-space: nowrap;
        }
        .qb-check-pill input {
            accent-color: var(--theme-accent-emerald);
            cursor: pointer;
            margin: 0;
        }
        .qb-status-pill {
            font-size: 9.5px;
            font-weight: 700;
            letter-spacing: 0.3px;
            padding: 2px 7px;
            border-radius: 4px;
            background: #fffbeb;
            color: #92400e;
            border: 1px solid #fde68a;
            white-space: nowrap;
        }

        /* Table Grid */
        .qb-table-scroll {
            max-height: clamp(140px, calc(100vh - 440px), 240px);
            min-height: 140px;
            overflow-y: auto;
            overflow-x: auto;
            border: 1px solid var(--theme-border);
            border-radius: 4px;
            background: #ffffff;
        }
        .qb-table {
            width: 100%;
            margin-bottom: 0;
            border-collapse: collapse;
        }
        .qb-table thead th {
            position: sticky;
            top: 0;
            z-index: 5;
            background: #f1f5f9 !important;
            color: #1e293b !important;
            font-size: 10px !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.3px !important;
            border-bottom: 2px solid #cbd5e1 !important;
            padding: 5px 5px !important;
            white-space: nowrap !important;
            vertical-align: middle !important;
        }
        .qb-table tbody td {
            padding: 2px 3px;
            font-size: 11.5px;
            color: #1e293b;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
            background: #ffffff;
            height: 27px;
        }
        .qb-table tbody tr:hover td {
            background-color: #f8fafc;
        }
        .qb-table input.form-control,
        .qb-table select.form-select {
            height: 24px !important;
            padding: 1px 5px !important;
            font-size: 11px !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 3px !important;
            background-color: #ffffff;
            box-shadow: none;
        }
        .qb-table input.form-control:focus,
        .qb-table select.form-select:focus {
            border-color: var(--theme-accent-emerald) !important;
            box-shadow: 0 0 0 1px var(--theme-accent-emerald) !important;
            outline: none;
        }
        .qb-table .quantity,
        .qb-table .loose_pieces {
            background-color: #ffffff !important;
            border-color: #94a3b8 !important;
            font-weight: 700 !important;
            color: #0f172a !important;
        }
        .qb-table .product-select-btn {
            height: 24px;
            line-height: 22px;
            padding: 0 7px;
            font-size: 11px;
            border: 1px solid #cbd5e1;
            border-radius: 3px;
            background: #fff;
            color: #475569;
            width: 100%;
            text-align: left;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .qb-table .product-select-btn:hover {
            border-color: var(--theme-accent-emerald);
        }
        .qb-table .product-select-btn.has-value {
            font-weight: 600;
            color: #0f172a;
            background: #f8fafc;
            border-color: #94a3b8;
        }

        .qb-table .input-group-sm {
            height: 24px;
            display: flex;
            align-items: stretch;
        }
        .qb-table .input-group-sm .form-control {
            height: 24px !important;
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }
        .qb-table .input-group-sm .btn,
        .qb-table .input-group-sm .input-group-text {
            height: 24px !important;
            padding: 0 5px !important;
            font-size: 9.5px !important;
            line-height: 22px !important;
            background: #f1f5f9 !important;
            border: 1px solid #cbd5e1 !important;
            border-left: none !important;
            color: #475569 !important;
            font-weight: 600 !important;
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
        }

        .qb-btn-add-line {
            background: var(--theme-accent-emerald);
            color: #ffffff;
            border: none;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 10px;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            cursor: pointer;
            height: 24px;
            transition: background .15s;
        }
        .qb-btn-add-line:hover {
            background: var(--theme-accent-emerald-hover);
            color: #fff;
        }

        /* Financial Ledger Rows */
        .qb-ledger-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 23px;
            border-bottom: 1px dashed #e2e8f0;
            padding: 0 3px;
            font-size: 11px;
        }
        .qb-ledger-lbl {
            font-size: 11px;
            color: #475569;
            font-weight: 500;
            white-space: nowrap;
        }
        .qb-ledger-val {
            background: transparent;
            border: none;
            font-size: 11.5px;
            font-weight: 700;
            color: #0f172a;
            text-align: right;
            width: 80px;
            outline: none;
            padding: 0;
        }
        .qb-ledger-input {
            height: 20px !important;
            font-size: 11px !important;
            padding: 0 4px !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 3px !important;
            background: #ffffff !important;
        }

        /* Obsidian Slate Net Payable Box */
        .qb-net-box {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important;
            color: #ffffff !important;
            border-radius: 5px !important;
            padding: 6px 12px !important;
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            margin-top: 5px !important;
            margin-bottom: 3px !important;
            box-shadow: 0 2px 5px rgba(15, 23, 42, 0.15) !important;
            border: 1px solid #334155 !important;
        }
        .qb-net-title {
            font-size: 10px !important;
            font-weight: 700 !important;
            letter-spacing: 0.6px !important;
            color: #94a3b8 !important;
        }
        .qb-currency {
            font-size: 11px !important;
            font-weight: 700 !important;
            color: #10b981 !important;
        }
        .qb-net-amount {
            background: transparent !important;
            border: none !important;
            color: #ffffff !important;
            font-size: 1.35rem !important;
            font-weight: 800 !important;
            text-align: right !important;
            width: 140px !important;
            outline: none !important;
            padding: 0 !important;
            line-height: 1 !important;
            letter-spacing: -0.5px !important;
        }

        /* Action Buttons */
        .qb-btn-post {
            background: var(--theme-accent-emerald) !important;
            color: #ffffff !important;
            font-size: 12px !important;
            font-weight: 700 !important;
            height: 32px !important;
            border: 1px solid var(--theme-accent-emerald-hover) !important;
            border-radius: 4px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 6px !important;
            letter-spacing: 0.3px !important;
            cursor: pointer;
            transition: all 0.15s ease !important;
            box-shadow: 0 2px 4px rgba(5, 150, 105, 0.25) !important;
        }
        .qb-btn-post:hover {
            background: var(--theme-accent-emerald-hover) !important;
            color: #fff !important;
        }
        .qb-btn-draft {
            background: #ffffff !important;
            color: #334155 !important;
            border: 1px solid #cbd5e1 !important;
            font-size: 12px !important;
            font-weight: 600 !important;
            height: 32px !important;
            border-radius: 4px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 6px !important;
            cursor: pointer;
            transition: all 0.15s ease !important;
        }
        .qb-btn-draft:hover {
            background: #f8fafc !important;
            color: #0f172a !important;
            border-color: #94a3b8 !important;
        }
        .qb-btn-fbr {
            background: #0284c7 !important;
            color: #ffffff !important;
            font-size: 11px !important;
            font-weight: 700 !important;
            height: 32px !important;
            border: none !important;
            border-radius: 4px !important;
            padding: 0 10px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 4px !important;
            cursor: pointer;
        }
        .qb-btn-fbr:disabled {
            background: #f1f5f9 !important;
            color: #94a3b8 !important;
            border: 1px dashed #cbd5e1 !important;
            cursor: not-allowed !important;
        }

        .btn-erp-danger-ghost {
            background: transparent;
            color: #ef4444;
            padding: 1px 4px;
            border: none;
            cursor: pointer;
        }
        .btn-erp-danger-ghost:hover {
            color: #dc2626;
        }

        /* Select2 Compact Override */
        .select2-container--default .select2-selection--single {
            height: 25px !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 4px !important;
            font-size: 11px !important;
            line-height: 23px !important;
            display: flex !important;
            align-items: center !important;
            background-color: transparent !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 23px !important;
            padding-left: 6px !important;
            font-size: 11px !important;
            color: #0f172a !important;
            font-weight: 600 !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 23px !important;
        }

        /* Responsive Zero-Scroll Adaptations */
        @media (max-height: 800px) {
            .qb-table-scroll {
                max-height: calc(100vh - 410px);
                min-height: 120px;
            }
            .qb-card {
                margin-bottom: 2px;
            }
        }

        /* Scrollbars */
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }
        ::-webkit-scrollbar-track {
            background: #f8fafc;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>

    <div class="main-content">
        <div class="main-content-inner">
            <div class="container-fluid">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

                <form id="saleForm" action="{{ route('sales.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="action" id="action" value="post">
                    <input type="hidden" name="draft_id" id="draft_id_input" value="">
                    <input type="hidden" name="dc_id" id="dc_id_input" value="">
                    <input type="hidden" name="mode" value="{{ request()->query('mode') }}">

                    <!-- Top Action / Title Bar -->
                    @php
                        $currentBranchId = auth()->user()->getBranchId();
                        $currentBranchName = $currentBranchId
                            ? \App\Models\Branch::find($currentBranchId)?->name
                            : 'All Branches (Super Admin)';
                        $defaultWhId = isset($Warehouse) && $Warehouse->first() ? $Warehouse->first()->id : 1;
                    @endphp
                    <div class="qb-topbar">
                        <div class="d-flex align-items-center gap-2">
                            <h1 class="qb-page-title">
                                <i class="bi bi-receipt-cutoff text-success"></i>
                                {{ request()->query('mode') == 'so' ? 'Sale Order' : 'Sale Invoice Note' }}
                            </h1>
                            <span class="badge" style="background:#ecfdf5; border:1px solid #a7f3d0; color:#065f46; font-size:10.5px; font-weight:600; padding:3px 8px; border-radius:4px;">
                                <i class="bi bi-record-circle-fill me-1"></i>Draft Mode
                            </span>
                            <span class="badge" style="background:#f1f5f9; border:1px solid #e2e8f0; color:#475569; font-size:10px; padding:3px 7px; border-radius:4px;">
                                <i class="bi bi-geo-alt me-1"></i>{{ strtoupper($currentBranchName) }}
                            </span>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" class="qb-btn-import" id="btnDeliveryOrderModal" disabled>
                                <i class="bi bi-file-earmark-arrow-down"></i> Import Delivery Note
                            </button>
                            <a href="{{ route('sale.receipt.index') }}" class="qb-btn-back">
                                <i class="bi bi-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>

                    <!-- Order Information (2-Row Compact Grid) -->
                    <div class="qb-card p-2 mb-1">
                        <input type="hidden" name="branch_id" id="branch_id" value="{{ $currentBranchId }}">
                        <input type="hidden" id="warehouse_id_header" value="{{ $defaultWhId }}">

                        <!-- Row 1 -->
                        <div class="row gx-2 gy-1">
                            <!-- Customer Account -->
                            <div class="col-md-3">
                                <label class="qb-lbl">Customer Account</label>
                                <div class="input-group input-group-sm">
                                    <button type="button" class="btn btn-select-modal" data-toggle="modal" data-target="#customerModal" title="Select Customer">
                                        <i class="bi bi-person-fill text-success"></i>
                                    </button>
                                    <input type="hidden" name="customer" id="customer_id" value="">
                                    <input type="text" id="customer_name_display"
                                        class="form-control qb-input qb-input-name fw-bold" readonly
                                        placeholder="WALKING CUSTOMER" data-toggle="modal" data-target="#customerModal" value="WALKING CUSTOMER">
                                </div>
                            </div>

                            <!-- Sales Officer -->
                            <div class="col-md-2">
                                <label class="qb-lbl">Sales Officer</label>
                                <div class="input-group input-group-sm">
                                    <button type="button" class="btn btn-select-modal" data-toggle="modal" data-target="#officerModal" title="Select Sales Officer">
                                        <i class="bi bi-person-badge text-primary"></i>
                                    </button>
                                    <input type="hidden" name="sales_officer_id" id="sales_officer_id" value="">
                                    <input type="text" id="sales_officer_display"
                                        class="form-control qb-input qb-input-name fw-bold" readonly
                                        placeholder="Select Sales Officer" data-toggle="modal" data-target="#officerModal" value="Select Sales Officer">
                                </div>
                            </div>

                            <!-- Sale Invc # -->
                            <div class="col-md-2">
                                <label class="qb-lbl">Invoice #</label>
                                <input type="hidden" value="{{ $nextInvoice ?? 'S-001017' }}">
                                <input type="text" name="sale_no" readonly value="{{ $nextInvoice ?? 'S-001017' }}" class="form-control qb-input font-monospace fw-bold text-dark bg-light">
                            </div>

                            <!-- Invoice Date -->
                            <div class="col-md-2">
                                <label class="qb-lbl">Invoice Date</label>
                                <input type="date" id="purchase_date_input" name="purchase_date" value="{{ date('Y-m-d') }}" class="form-control qb-input">
                            </div>

                            <!-- Cust Ref / DC # -->
                            <div class="col-md-2">
                                <label class="qb-lbl">Cust Ref / DC #</label>
                                <input type="text" name="vendor_bill_no" class="form-control qb-input" placeholder="Ref / DC">
                            </div>

                            <!-- DC Date -->
                            <div class="col-md-1">
                                <label class="qb-lbl">DC Date</label>
                                <input type="date" id="dc_date_input" name="dc_date" class="form-control qb-input">
                            </div>
                        </div>

                        <!-- Row 2 -->
                        <div class="row gx-2 gy-1 mt-1 align-items-center">
                            <!-- SO # -->
                            <div class="col-md-2">
                                <label class="qb-lbl">SO #</label>
                                <input type="text" name="sale_order_no" class="form-control qb-input" value="000000">
                            </div>

                            <!-- SO Date -->
                            <div class="col-md-1">
                                <label class="qb-lbl">SO Date</label>
                                <input type="date" id="so_date_input" name="so_date" value="{{ date('Y-m-d') }}" class="form-control qb-input">
                            </div>

                            <!-- Order # -->
                            <div class="col-md-2">
                                <label class="qb-lbl">Order #</label>
                                <input type="text" name="order_no" class="form-control qb-input" placeholder="Order #">
                            </div>

                            <!-- Job # / Ref -->
                            <div class="col-md-2">
                                <label class="qb-lbl">Job # / Ref</label>
                                <input type="text" name="reference" class="form-control qb-input" placeholder="Job / Ref">
                            </div>

                            <!-- Project -->
                            <div class="col-md-2">
                                <label class="qb-lbl">Project</label>
                                <select name="project" class="form-select qb-select">
                                    <option value="">(N/A)</option>
                                </select>
                            </div>

                            <!-- Commission % -->
                            <div class="col-md-1">
                                <label class="qb-lbl">Comm %</label>
                                <input type="number" step="0.01" min="0" max="100" name="commission_percentage" id="commission_percentage" class="form-control qb-input fw-bold" placeholder="0.00" value="">
                            </div>

                            <!-- Checkboxes & Status -->
                            <div class="col-md-2">
                                <div class="d-flex align-items-center justify-content-between pt-3" style="gap: 4px;">
                                    <label class="qb-check-pill" title="GST Invoice">
                                        <input type="checkbox" id="gst_invoice" name="is_gst_invoice" checked>
                                        <span>GST</span>
                                    </label>
                                    <label class="qb-check-pill" title="Enable HS Code">
                                        <input type="checkbox" id="enable_hs_code" name="enable_hs_code" value="1" checked>
                                        <span>HS Code</span>
                                    </label>
                                    <span class="qb-status-pill">UN-POSTED</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Line Items Grid -->
                    <div class="qb-card p-2 mb-1">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="d-flex align-items-center gap-2">
                                <span class="qb-section-title"><i class="bi bi-boxes text-success"></i> Product Line Items</span>
                                <small class="text-muted" style="font-size: 10px;">(Press Enter on any field to add new row)</small>
                            </div>
                            <button type="button" class="qb-btn-add-line" id="btnAddRow">
                                <i class="bi bi-plus-lg"></i> Add New Row
                            </button>
                        </div>

                        <div class="qb-table-scroll">
                            @php
                                $allUnits = \App\Models\Unit::pluck('name')->toArray();
                                $defaultUoms = ['KG', 'Piece', 'Number', 'Pack', 'Box', 'Carton', 'Dozen', 'Meter', 'Liter', 'Pair', 'Set', 'Roll', 'Bag', 'Bottle', 'Vial', 'Kit'];
                                $uomList = array_unique(array_merge($defaultUoms, $allUnits));
                            @endphp
                            <datalist id="uom_datalist">
                                @foreach($uomList as $uName)
                                    <option value="{{ $uName }}">
                                @endforeach
                            </datalist>
                            <table class="erp-table qb-table">
                                <thead>
                                    <tr>
                                        <th style="width:85px">Item Code</th>
                                        <th style="min-width:210px">Product</th>
                                        <th style="width:115px" class="hs-code-col text-center">HS Code</th>
                                        <th style="width:115px">Packing</th>
                                        <th style="width:75px" class="text-center">UOM</th>
                                        <th style="width:55px" class="text-center">Packet</th>
                                        <th style="width:75px" class="text-end">Box Qty</th>
                                        <th style="width:65px" class="text-end">Loose</th>
                                        <th style="width:65px" class="text-end">Free Pcs</th>
                                        <th style="width:85px" class="text-end">Rate</th>
                                        <th style="width:110px" class="text-end">Discount</th>
                                        <th style="width:95px" class="text-end">Sub Total</th>
                                        <th style="width:70px" class="text-end">GST %</th>
                                        <th style="width:75px" class="text-end">IncTax</th>
                                        <th style="width:80px" class="text-end">advTax</th>
                                        <th style="width:105px" class="text-end">Net Total</th>
                                        @if (request()->query('mode') != 'so')
                                            <th style="width:120px">Batch</th>
                                            <th style="width:90px">Lot#</th>
                                            <th style="width:80px" class="text-end">Cost/PC</th>
                                        @else
                                            <th style="width:80px" class="text-end">Cost/PC</th>
                                        @endif
                                        <th style="width:36px; text-align:center;">Del</th>
                                    </tr>
                                </thead>
                                <tbody id="saleItems">
                                    <!-- Embedded Rows Go Here -->
                                </tbody>
                            </table>
                            <!-- Empty State Background -->
                            <div id="emptyTableState" class="text-center py-2 text-muted"
                                style="background: #f8fafc; border-top: 1px dashed #cbd5e1; font-size:11px;">
                                <i class="bi bi-cart me-1"></i> No items added yet. Click "+ Add New Row" to begin.
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Section (Setup & Payments + Financial Summary) -->
                    <div class="row gx-2 mt-1">
                        <!-- Setup & Payments -->
                        <div class="col-lg-6 col-xl-6">
                            <div class="qb-card h-100 p-2 d-flex flex-column justify-content-between">
                                <div>
                                    <div class="d-flex justify-content-between align-items-center mb-1 pb-1 border-bottom">
                                        <span class="qb-section-title"><i class="bi bi-wallet2 text-success"></i> {{ request()->query('mode') == 'so' ? 'Setup Details' : 'Setup & Payments' }}</span>
                                        <span class="badge" style="background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; font-size:9.5px;">Logistics &amp; Voucher</span>
                                    </div>
                                    <div class="row gx-2 gy-1 mb-2">
                                        <div class="col-6">
                                            <label class="qb-lbl">Delivered By / Transport</label>
                                            <input type="text" name="transport_name" class="form-control qb-input" placeholder="Courier / driver / vehicle">
                                        </div>
                                        <div class="col-6">
                                            <label class="qb-lbl">Sale Remarks</label>
                                            <input type="text" name="note" class="form-control qb-input" placeholder="Any internal notes or terms">
                                        </div>
                                    </div>

                                    @if (request()->query('mode') != 'so')
                                        <div class="pt-2 border-top mt-1">
                                            <div class="p-2 rounded" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <label class="qb-lbl mb-0">Payment Voucher Assignment</label>
                                                    <span class="badge" style="background:#ecfdf5; color:#065f46; font-weight:700; font-size:10.5px; border:1px solid #a7f3d0;" id="totalPaid">Rs. 0.00</span>
                                                </div>
                                                <div id="paymentWrapper">
                                                    <div class="d-flex gap-1 align-items-center mb-1 payment-row">
                                                        <div class="input-group input-group-sm" style="flex:1;">
                                                            <span class="input-group-text bg-light p-1" style="font-size:11px; border-color:#cbd5e1;"><i class="bi bi-bank"></i></span>
                                                            <select class="form-select rv-account qb-input" name="payment_account_id[]" style="font-size:11px;">
                                                                <option value="" selected disabled>Select Payment Account</option>
                                                                @if (isset($accounts))
                                                                    @foreach ($accounts as $acc)
                                                                        <option value="{{ $acc->id }}">{{ $acc->title }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="input-group input-group-sm" style="width:115px;">
                                                            <span class="input-group-text bg-light p-1 fw-bold" style="font-size:10px; border-color:#cbd5e1;">Rs.</span>
                                                            <input type="number" class="form-control text-end payment-amount qb-input" name="payment_amount[]" placeholder="0.00" style="font-size:11px;">
                                                        </div>
                                                        <button type="button" class="btn btn-sm rounded px-2" id="btnAddPayment" style="height:26px; padding:0 10px; font-size:11px; background:#0f172a; color:#fff; border:none;">
                                                            <i class="bi bi-plus-lg"></i> Add
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="pt-1 border-top mt-1 d-flex justify-content-between align-items-center">
                                    <label class="qb-check-pill" style="cursor: pointer;">
                                        <input type="checkbox" id="printPreview" name="print_preview" value="1" checked>
                                        <span>Auto Print Receipt</span>
                                    </label>
                                    <small class="text-muted" style="font-size: 10px;">Press F2 to Quick Post</small>
                                </div>
                            </div>
                        </div>

                        <!-- Financial Summary -->
                        <div class="col-lg-6 col-xl-6">
                            <div class="qb-card qb-summary-card h-100 p-2 d-flex flex-column justify-content-between">
                                <div>
                                    <div class="d-flex justify-content-between align-items-center mb-1 pb-1 border-bottom">
                                        <span class="qb-section-title"><i class="bi bi-calculator text-success"></i> Financial Summary</span>
                                        <div class="d-flex gap-1 align-items-center">
                                            <span class="badge" style="background:#f1f5f9; border:1px solid #e2e8f0; color:#0f172a; font-size:10px;" id="summary_total_qty">0 Pcs</span>
                                            <span class="badge" style="background:#f1f5f9; border:1px solid #e2e8f0; color:#475569; font-size:10px;" id="summary_total_free_qty">—</span>
                                        </div>
                                    </div>

                                    <!-- 2-Column Ledger -->
                                    <div class="row gx-2 gy-0 mb-1">
                                        <div class="col-6">
                                            <div class="qb-ledger-row">
                                                <span class="qb-ledger-lbl">Gross Total:</span>
                                                <input type="text" class="qb-ledger-val" id="gross_total" readonly tabindex="-1" value="0.00">
                                            </div>
                                            <div class="qb-ledger-row">
                                                <span class="qb-ledger-lbl text-danger">Prod Disc:</span>
                                                <input type="text" class="qb-ledger-val text-danger" id="total_row_disc" readonly tabindex="-1" value="0.00">
                                            </div>
                                            <div class="qb-ledger-row">
                                                <span class="qb-ledger-lbl">Bill Disc:</span>
                                                <div class="d-flex align-items-center gap-1" style="width: 100px;">
                                                    <input type="number" step="0.01" id="sum_discount" name="discount" class="form-control form-control-sm text-end qb-ledger-input" value="0.00">
                                                    <input type="hidden" name="discount_type" id="sum_discount_type" value="amount">
                                                    <button class="btn btn-outline-secondary toggle-type p-0 px-1" type="button" data-type="amount" style="height: 20px; font-size: 9px; line-height: 18px; border-color:#cbd5e1;">Rs</button>
                                                </div>
                                            </div>
                                            <div class="qb-ledger-row">
                                                <span class="qb-ledger-lbl fw-bold text-dark">Sub Total:</span>
                                                <input type="text" class="qb-ledger-val fw-bold text-dark" name="subtotal" id="summary_sub_total" readonly tabindex="-1" value="0.00">
                                            </div>
                                            <div class="qb-ledger-row">
                                                <span class="qb-ledger-lbl">Freight:</span>
                                                <input type="number" class="form-control form-control-sm text-end qb-ledger-input input_summary" name="freight_charges" id="sum_freight" value="0.00" style="width: 80px;">
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="qb-ledger-row">
                                                <span class="qb-ledger-lbl">Bilti Exp:</span>
                                                <input type="number" class="form-control form-control-sm text-end qb-ledger-input input_summary" name="extra_cost" id="sum_expense" value="0.00" style="width: 80px;">
                                            </div>
                                            <div class="qb-ledger-row">
                                                <span class="qb-ledger-lbl text-success">GST (+):</span>
                                                <input type="text" class="qb-ledger-val text-success fw-bold" id="total_gst" readonly tabindex="-1" value="0.00">
                                            </div>
                                            <div class="qb-ledger-row">
                                                <span class="qb-ledger-lbl fw-bold text-dark">Invoice Total:</span>
                                                <input type="text" class="qb-ledger-val fw-bold text-dark" id="invoice_total" readonly tabindex="-1" value="0.00">
                                            </div>
                                            <div class="qb-ledger-row">
                                                <span class="qb-ledger-lbl text-danger">WHT (-):</span>
                                                <input type="text" class="qb-ledger-val text-danger" id="total_inc_tax" readonly tabindex="-1" value="0.00">
                                            </div>
                                            <div class="qb-ledger-row">
                                                <span class="qb-ledger-lbl text-success">Adv Tax (+):</span>
                                                <input type="text" class="qb-ledger-val text-success" id="total_adv_tax" readonly tabindex="-1" value="0.00">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Obsidian Slate Net Payable Box -->
                                    <div class="qb-net-box">
                                        <div class="d-flex flex-column">
                                            <span class="qb-net-title">NET PAYABLE AMOUNT</span>
                                            <small style="font-size: 8.5px; color: #94a3b8; letter-spacing: 0.3px;">TOTAL INCLUDING TAXES</small>
                                        </div>
                                        <div class="d-flex align-items-baseline gap-1">
                                            <span class="qb-currency">PKR</span>
                                            <input type="text" class="qb-net-amount" id="final_net_total" name="net_amount" readonly tabindex="-1" value="0.00">
                                        </div>
                                    </div>

                                    <!-- In Words -->
                                    <div class="d-flex align-items-center gap-1 mb-1 mt-1" style="font-size: 10px;">
                                        <span class="text-muted text-nowrap">In Words:</span>
                                        <input type="text" name="total_amount_Words" id="amountInWords" class="form-control-plaintext py-0 px-1 fw-bold text-secondary text-truncate" readonly tabindex="-1" value="Zero Rupees" style="font-size: 10px; height: 16px;">
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex gap-1 align-items-center mt-1">
                                    <button type="button" class="btn qb-btn-post w-100" id="btnConfirm" style="{{ request()->query('mode') == 'so' ? 'display:none;' : '' }}">
                                        <i class="bi bi-check2-circle"></i> Confirm &amp; Post Sale
                                    </button>
                                    <button type="button" class="btn qb-btn-draft w-100" id="btnSaveOnly" style="{{ request()->query('mode') != 'so' ? 'display:none;' : '' }}">
                                        <i class="bi bi-save2"></i> Save Sale Order (Draft)
                                    </button>
                                    <button type="button" class="btn qb-btn-fbr" id="btnPostToFbr" disabled title="Post this sale invoice to FBR Digital Invoicing" style="{{ request()->query('mode') == 'so' ? 'display:none;' : '' }}; white-space: nowrap;">
                                        <i class="bi bi-cloud-arrow-up-fill"></i> POST TO FBR
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Booked Products Modal -->
    <div class="modal fade" id="bookedProductsModal" tabindex="-1" aria-labelledby="bookedProductsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header bg-light border-bottom border-light px-4 py-3">
                    <h5 class="modal-title fw-bold text-dark d-flex align-items-center gap-2"
                        id="bookedProductsModalLabel">
                        <i class="bi bi-card-checklist text-primary fs-4"></i>
                        {{ request()->query('mode') == 'so' ? 'Import Sales / Delivery Notes' : 'Import Delivery Notes' }}
                    </h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-white">
                    <div class="row mb-3">
                        <div class="col-md-5">
                            <div class="search-wrapper">
                                <i class="bi bi-search search-icon text-muted"></i>
                                <input type="text" id="searchBookedProducts"
                                    class="form-control form-control-sm search-input"
                                    placeholder="Search by vendor, component, code, sys ID...">
                            </div>
                        </div>
                    </div>

                    <div class="erp-table-wrapper" style="max-height: 400px; overflow-y: auto;">
                        <table class="erp-table table-hover align-middle mb-0" id="bookedProductsTable">
                            <thead class="sticky-top bg-light">
                                <tr>
                                    <th style="width: 5%;"></th>
                                    <th>SYS ID / Ref #</th>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th class="text-end">Total Items</th>
                                    <th class="text-end">Net Amount</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody id="bookedProductsTableBody">
                                @php
                                    $hasDraftItems = false;
                                    $isSoMode = request()->query('mode') == 'so';
                                    $advanceDcNotes = $dcNotes->filter(fn($dc) => $dc->is_advance);
                                @endphp

                                {{-- Draft Sale Orders section (mode=so only) --}}
                                @if ($isSoMode)
                                    @php
                                        $draftSales = $sales->where('sale_status', 'draft');
                                    @endphp
                                    @foreach ($draftSales as $draft)
                                        @php $hasDraftItems = true; @endphp
                                        <tr class="booked-item-row"
                                            data-customer-id="{{ $draft->customer_id }}"
                                            data-search="{{ strtolower($draft->invoice_no . ' ' . ($draft->customer_relation->customer_name ?? '')) }}">
                                            <td>
                                                <i class="bi bi-file-earmark-text text-primary"></i>
                                            </td>
                                            <td><span class="badge bg-light text-dark border">{{ $draft->invoice_no }}</span>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($draft->sale_date)->format('d M, Y') }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="vendor-initial bg-primary-subtle text-primary fw-bold rounded-3 p-2"
                                                        style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                                        {{ strtoupper(substr($draft->customer_relation->customer_name ?? 'C', 0, 1)) }}
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <span
                                                            class="fw-bold text-dark">{{ $draft->customer_relation->customer_name ?? 'N/A' }}</span>
                                                        <span
                                                            class="text-muted small">{{ $draft->customer_relation->business_name ?? 'Individual' }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end fw-bold">{{ $draft->items->count() }}</td>
                                            <td class="text-end fw-bold text-primary">
                                                {{ number_format($draft->total_net, 2) }}</td>
                                            <td class="text-end">
                                                <button type="button"
                                                    class="btn btn-primary btn-sm rounded-pill px-4 btn-import-single"
                                                    title="Import Sale Order"
                                                    data-type="draft"
                                                    data-customer-id="{{ $draft->customer_id }}"
                                                    data-id="{{ $draft->id }}">
                                                    <i class="bi bi-arrow-down-square me-1"></i> Import
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                    {{-- Visual separator for advance DCs in SO mode --}}
                                    @if ($advanceDcNotes->count() > 0)
                                    <tr>
                                        <td colspan="7" style="background:#fffbeb; color:#92400e; font-weight:700; padding:6px 14px; font-size:12px; border-top:2px solid #fbbf24;">
                                            <i class="bi bi-truck me-1"></i> Advance Delivery Notes &mdash; Pending Sale Invoice
                                        </td>
                                    </tr>
                                    @endif
                                @endif

                                {{-- Advance DCs (always shown in SO mode); All DC notes in SIN mode --}}
                                @foreach ($isSoMode ? $advanceDcNotes : $dcNotes as $dc)
                                    @php $hasDraftItems = true; @endphp
                                    <tr class="booked-item-row"
                                        data-customer-id="{{ $dc->customer_id }}"
                                        data-search="{{ strtolower($dc->dc_no . ' ' . ($dc->customer->customer_name ?? '')) }}">
                                        <td>
                                            <i class="bi bi-file-earmark-arrow-down text-warning"></i>
                                        </td>
                                        <td><span class="badge bg-warning text-dark border">{{ $dc->dc_no }}</span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($dc->delivery_date)->format('d M, Y') }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="vendor-initial bg-primary-subtle text-primary fw-bold rounded-3 p-2"
                                                    style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                                    {{ strtoupper(substr($dc->customer->customer_name ?? 'C', 0, 1)) }}
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span
                                                        class="fw-bold text-dark">{{ $dc->customer->customer_name ?? 'N/A' }}</span>
                                                    <span
                                                        class="text-muted small">{{ $dc->customer->business_name ?? 'Individual' }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end fw-bold">{{ $dc->items->count() }}</td>
                                        <td class="text-end fw-bold text-primary">
                                            {{ number_format($dc->net_amount, 2) }}</td>
                                        <td class="text-end">
                                            <button type="button"
                                                class="btn btn-warning btn-sm rounded-pill px-4 btn-import-single"
                                                title="Import DC Note as Sale Invoice"
                                                data-type="dc"
                                                data-customer-id="{{ $dc->customer_id }}"
                                                data-id="{{ $dc->id }}"
                                                data-is-advance="{{ $dc->is_advance ? '1' : '0' }}">
                                                <i class="bi bi-arrow-down-square me-1"></i> Import Invoice
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

                                @if (!$hasDraftItems)
                                    <tr id="emptyBookedRow">
                                        <td colspan="7" class="text-center py-5 text-muted">
                                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                            No booked/draft products found.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top border-light px-4 py-3">
                    <button type="button" class="btn-erp btn-erp-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Modal -->
    <div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header bg-light border-bottom border-light px-4 py-3">
                    <h5 class="modal-title fw-bold text-dark d-flex align-items-center gap-2" id="customerModalLabel">
                        <i class="bi bi-people text-primary fs-4"></i>
                        Select Customer
                    </h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-white">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="search-wrapper position-relative">
                                <i class="bi bi-search text-muted position-absolute" style="left: 15px; top: 50%; transform: translateY(-50%);"></i>
                                <input type="text" id="searchCustomer" class="form-control form-control-sm ps-5 py-2 rounded-pill" placeholder="Search by name, code, or business...">
                            </div>
                        </div>
                    </div>
                    <div class="erp-table-wrapper" style="max-height: 400px; overflow-y: auto;">
                        <table class="erp-table table-hover align-middle mb-0" id="customerTable">
                            <thead class="sticky-top bg-light">
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Business</th>
                                    <th>Contact Info</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody id="customerTableBody">
                                <tr class="customer-item-row" data-search="walking customer">
                                    <td>-</td>
                                    <td><strong>WALKING CUSTOMER</strong></td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-primary btn-sm rounded-pill px-4 btn-select-customer" data-id="" data-name="WALKING CUSTOMER">
                                            Select
                                        </button>
                                    </td>
                                </tr>
                                @foreach ($Customer as $c)
                                    <tr class="customer-item-row" data-search="{{ strtolower(($c->customer_id ?? '') . ' ' . ($c->customer_name ?? '') . ' ' . ($c->business_name ?? '')) }}">
                                        <td><span class="badge bg-light text-dark border">{{ $c->customer_id ?? 'N/A' }}</span></td>
                                        <td><strong>{{ $c->customer_name }}</strong></td>
                                        <td>{{ $c->business_name ?? '-' }}</td>
                                        <td>
                                            @if($c->phone)<i class="bi bi-telephone text-muted"></i> <small>{{ $c->phone }}</small><br>@endif
                                            @if($c->email)<small class="text-muted"><i class="bi bi-envelope"></i> {{ $c->email }}</small><br>@endif
                                            @if($c->address)<small class="text-muted"><i class="bi bi-geo-alt"></i> {{ \Illuminate\Support\Str::limit($c->address, 30) }}</small>@endif
                                        </td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-primary btn-sm rounded-pill px-4 btn-select-customer" 
                                                data-id="{{ $c->id }}" 
                                                data-name="{{ $c->customer_id ? '['.$c->customer_id.'] ' : '' }}{{ $c->customer_name }} {{ $c->business_name ? '(' . $c->business_name . ')' : '' }}">
                                                Select
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top border-light px-4 py-3">
                    <button type="button" class="btn-erp btn-erp-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Officer Modal -->
    <div class="modal fade" id="officerModal" tabindex="-1" aria-labelledby="officerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header bg-light border-bottom border-light px-4 py-3">
                    <h5 class="modal-title fw-bold text-dark d-flex align-items-center gap-2" id="officerModalLabel">
                        <i class="bi bi-person-badge text-primary fs-4"></i>
                        Select Sales Officer
                    </h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-white">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="search-wrapper position-relative">
                                <i class="bi bi-search text-muted position-absolute" style="left: 15px; top: 50%; transform: translateY(-50%);"></i>
                                <input type="text" id="searchOfficer" class="form-control form-control-sm ps-5 py-2 rounded-pill" placeholder="Search by name...">
                            </div>
                        </div>
                    </div>
                    <div class="erp-table-wrapper" style="max-height: 400px; overflow-y: auto;">
                        <table class="erp-table table-hover align-middle mb-0" id="officerTable">
                            <thead class="sticky-top bg-light">
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Contact Details</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody id="officerTableBody">
                                <tr class="officer-item-row" data-search="select sales officer">
                                    <td><strong>N/A (None)</strong></td>
                                    <td>-</td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-primary btn-sm rounded-pill px-4 btn-select-officer" data-id="" data-name="Select Sales Officer">
                                            Select
                                        </button>
                                    </td>
                                </tr>
                                @foreach ($employees as $emp)
                                    <tr class="officer-item-row" data-search="{{ strtolower(($emp->employee_id ?? '') . ' ' . ($emp->first_name ?? '') . ' ' . ($emp->last_name ?? '')) }}">
                                        <td><span class="badge bg-light text-dark border">{{ $emp->employee_id ?? 'N/A' }}</span></td>
                                        <td><strong>{{ $emp->first_name }} {{ $emp->last_name }}</strong></td>
                                        <td>
                                            @if($emp->phone) <i class="bi bi-telephone ms-1 text-muted"></i> <small>{{ $emp->phone }}</small><br> @endif
                                            @if($emp->email) <small class="text-muted"><i class="bi bi-envelope ms-1"></i> {{ $emp->email }}</small> @endif
                                        </td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-primary btn-sm rounded-pill px-4 btn-select-officer" 
                                                data-id="{{ $emp->id }}" 
                                                data-name="{{ $emp->employee_id ? '['.$emp->employee_id.'] ' : '' }}{{ $emp->first_name }} {{ $emp->last_name }}">
                                                Select
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top border-light px-4 py-3">
                    <button type="button" class="btn-erp btn-erp-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @include('admin_panel.sale.components.quick_hs_modal')

@endsection

{{-- Advanced Product Selection Modal --}}
@include('admin_panel.components.product_select_modal')
@include('admin_panel.sale.components.fbr_post_modal')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    /* Custom Select2 Overrides for Modern UI */
    .select2-container--default .select2-selection--single {
        border: 1px solid transparent;
        border-bottom: 1px solid #e2e8f0;
        border-radius: 4px;
        height: 38px;
        display: flex;
        align-items: center;
        background-color: transparent;
    }

    .select2-container--default.select2-container--focus .select2-selection--single {
        border-bottom: 1px solid #3b82f6;
        box-shadow: inset 0 -1px 0 0 #3b82f6;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #334155;
        font-weight: 600;
    }
</style>

<script>
    $(document).ready(function() {
        function toggleGstFields() {
            let isGst = $('#gst_invoice').is(':checked');
            if (isGst) {
                $('.gst, .inc-tax, .adv-tax').prop('readonly', false).css('background', '');
            } else {
                $('.gst, .inc-tax, .adv-tax').val(0).prop('readonly', true).css('background', '#e9ecef');
            }
            // Trigger recalculation on all rows
            $('#saleItems tr').each(function() {
                let $row = $(this);
                if (typeof recalcRow === "function" && ($row.find('.item-id').val() || $row.find('.product-select2').val())) {
                    recalcRow($row);
                }
            });
            if (typeof recalcSummary === "function") recalcSummary();
        }

        $('#gst_invoice').on('change', function() {
            toggleGstFields();
        });
        
        setTimeout(toggleGstFields, 500);

        // Customer Modal Logic
        $('#searchCustomer').on('input', function() {
            let val = $(this).val().toLowerCase();
            $('.customer-item-row').each(function() {
                let searchData = $(this).attr('data-search');
                if (searchData.includes(val)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        $('.btn-select-customer').on('click', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            $('#customer_id').val(id);
            $('#customer_name_display').val(name);
            $('#customerModal').modal('hide');

            $('#btnDeliveryOrderModal').prop('disabled', false);

            $('.booked-item-row').each(function() {
                let rowCustId = $(this).attr('data-customer-id') || $(this).find('.btn-import-single').attr('data-customer-id') || $(this).find('.btn-import-single').data('customer-id');
                if (!id || rowCustId == id) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
            $('#searchBookedProducts').val('');
        });

        $('#btnDeliveryOrderModal').on('click', function() {
            let currentCustId = $('#customer_id').val();
            if (currentCustId) {
                $('.booked-item-row').each(function() {
                    let rowCustId = $(this).attr('data-customer-id') || $(this).find('.btn-import-single').attr('data-customer-id');
                    if (rowCustId == currentCustId) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            } else {
                $('.booked-item-row').show();
            }
            $('#searchBookedProducts').val('');
            $('#bookedProductsModal').modal('show');
        });

        // Officer Modal Logic
        $('#searchOfficer').on('input', function() {
            let val = $(this).val().toLowerCase();
            $('.officer-item-row').each(function() {
                let searchData = $(this).attr('data-search');
                if (searchData.includes(val)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        $('.btn-select-officer').on('click', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            $('#sales_officer_id').val(id);
            $('#sales_officer_display').val(name);
            $('#officerModal').modal('hide');
        });

        // Payment Voucher Add/Remove Logic
        $('#btnAddPayment').click(function() {
            const html = `
                <div class="d-flex gap-2 align-items-center mb-2 payment-row">
                    <div class="input-group" style="max-width:350px;">
                        <span class="input-group-text bg-light text-secondary"><i class="bi bi-bank"></i></span>
                        <select class="form-select rv-account" name="payment_account_id[]">
                            <option value="" selected disabled>Select Payment Account</option>
                            @if (isset($accounts))
                                @foreach ($accounts as $acc)
                                    <option value="{{ $acc->id }}">{{ $acc->title }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="input-group" style="max-width:180px;">
                        <span class="input-group-text bg-light fw-bold">Rs.</span>
                        <input type="number" class="form-control text-end payment-amount" name="payment_amount[]" placeholder="0.00">
                    </div>
                    <button type="button" class="btn btn-erp-danger-ghost border-0 remove-payment" style="padding: 0.5rem 0.75rem;"><i class="bi bi-trash fs-5"></i></button>
                </div>`;
            $('#paymentWrapper').append(html);
        });

        $(document).on('click', '.remove-payment', function() {
            $(this).closest('.payment-row').remove();
            calcTotalPaid();
        });

        $(document).on('focus', '.quantity, .free_qty, .price, .item_disc, .gst, .payment-amount, .input_summary', function() {
            $(this).select();
        });

        $(document).on('input', '.payment-amount', function() {
            calcTotalPaid();
        });

        function calcTotalPaid() {
            let total = 0;
            $('.payment-amount').each(function() {
                total += parseFloat($(this).val()) || 0;
            });
            $('#totalPaid').text('Rs. ' + total.toFixed(2));
        }

        // Prevent natural form submission (e.g. on Enter key)
        $('#saleForm').on('submit', function(e) {
            e.preventDefault();
        });

        // AJAX Form Submission
        $('#btnSaveOnly').click(function(e) {
            e.preventDefault();

            /* 
            // Check for duplicate lots
            let duplicateLots = getDuplicateLots();
            if (duplicateLots.length > 0) {
                let dupeList = duplicateLots.map(d => `<li><strong>${d.name}</strong>: ${d.lot}</li>`)
                    .join('');
                Swal.fire({
                    icon: 'error',
                    title: 'Duplicate Lot Numbers!',
                    html: `<p>The following products have the same Lot Number in your list. Each Lot Number must be unique per product:</p><ul class="text-start">${dupeList}</ul>`,
                });
                return;
            }
            */

            let $btn = $(this);
            let ogHtml = $btn.html();
            $btn.prop('disabled', true).html(
                '<span class="spinner-border spinner-border-sm me-2"></span>Saving...');
            $('#action').val('save_only');

            $.ajax({
                url: "{{ route('sales.store') }}",
                method: "POST",
                data: $('#saleForm').serialize(),
                success: function(response) {
                    if (response.invoice_url && response.print_preview && $('#action')
                        .val() !== 'save_only') {
                        window.open(response.invoice_url, '_blank');
                    }
                    Swal.fire({
                        icon: 'success',
                        title: 'Draft Saved!',
                        text: 'Sale order saved as draft successfully.',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        let redirectUrl = "{{ route('sale.order.index') }}";
                        window.location.href = redirectUrl;
                    });
                },
                error: function(xhr) {
                    $btn.prop('disabled', false).html(ogHtml);
                    let msg = 'Something went wrong.';
                    if (xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON
                        .message;
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        msg += '\n' + Object.values(xhr.responseJSON.errors).flat().join(
                            '\n');
                    }
                    Swal.fire('Error', msg, 'error');
                }
            });
        });

        $('#btnConfirm').click(function(e) {
            e.preventDefault();

            /*
            // Check for duplicate lots
            let duplicateLots = getDuplicateLots();
            if (duplicateLots.length > 0) {
                let dupeList = duplicateLots.map(d => `<li><strong>${d.name}</strong>: ${d.lot}</li>`)
                    .join('');
                Swal.fire({
                    icon: 'error',
                    title: 'Duplicate Lot Numbers!',
                    html: `<p>The following products have the same Lot Number in your list. Each Lot Number must be unique per product:</p><ul class="text-start">${dupeList}</ul>`,
                });
                return;
            }
            */



            let warningText =
                "This action will affect your inventory stock and this change is irreversible.";
            let warningTitle = "Are you sure you want to post this sale?";
            let warningIcon = "warning";
            let confirmBtnColor = '#059669';
            let confirmBtnText = 'Yes, Post it!';

            Swal.fire({
                title: warningTitle,
                html: warningText,
                icon: warningIcon,
                showCancelButton: true,
                confirmButtonColor: confirmBtnColor,
                cancelButtonColor: '#cbd5e1',
                confirmButtonText: confirmBtnText,
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    let $btn = $('#btnConfirm');
                    let ogHtml = $btn.html();
                    $btn.prop('disabled', true).html(
                        '<span class="spinner-border spinner-border-sm me-2"></span>Processing...'
                    );
                    $('#action').val('post');
                    $.ajax({
                        url: "{{ route('sales.store') }}",
                        method: "POST",
                        data: $('#saleForm').serialize(),
                        success: function(response) {
                            if (response.invoice_url && response.print_preview) {
                                window.open(response.invoice_url, '_blank');
                            }

                            // Capture created sale ID
                            const createdSaleId = response.booking_id;

                            // Update UI: Disable Confirm button and Enable POST TO FBR button
                            if (createdSaleId) {
                                $('#btnConfirm').prop('disabled', true).html('<i class="bi bi-check2-all me-1"></i> Sale Already Posted');
                                $('#btnPostToFbr')
                                    .prop('disabled', false)
                                    .attr('data-sale-id', createdSaleId)
                                    .css('cursor', 'pointer');
                            }

                            Swal.fire({
                                icon: 'success',
                                title: 'Sale Posted Successfully!',
                                html: `
                                    <div class="py-2">
                                        <p class="text-muted mb-3">Sale processed, stock updated, and ledger recorded.</p>
                                        <div class="alert alert-warning border text-start p-2 mb-0" style="font-size: 0.88rem;">
                                            <i class="bi bi-cloud-arrow-up-fill me-1"></i> <strong>Do you want to post it to FBR?</strong>
                                            <div class="text-muted small mt-1">You can transmit to FBR right now, or click the enabled <b>POST TO FBR</b> button at any time.</div>
                                        </div>
                                    </div>
                                `,
                                showCancelButton: true,
                                confirmButtonColor: '#f59e0b',
                                cancelButtonColor: '#64748b',
                                confirmButtonText: '<i class="bi bi-cloud-arrow-up-fill me-1"></i> Yes, Post to FBR',
                                cancelButtonText: 'View Sales List'
                            }).then((popupRes) => {
                                if (popupRes.isConfirmed) {
                                    if (window.FbrPostManager && createdSaleId) {
                                        window.FbrPostManager.open(createdSaleId);
                                    }
                                } else if (popupRes.dismiss === Swal.DismissReason.cancel) {
                                    window.location.href = response.redirect_url || "{{ route('sale.receipt.index') }}";
                                }
                            });
                        },
                        error: function(xhr) {
                            $btn.prop('disabled', false).html(ogHtml);
                            let msg = 'Something went wrong.';
                            if (xhr.responseJSON && xhr.responseJSON.message) msg =
                                xhr.responseJSON.message;
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                msg += '\n' + Object.values(xhr.responseJSON.errors)
                                    .flat().join('\n');
                            }
                            Swal.fire('Error', msg, 'error');
                        }
                    });
                }
            });
        });

        // POST TO FBR Button Click Handler
        $('#btnPostToFbr').click(function(e) {
            e.preventDefault();
            const saleId = $(this).attr('data-sale-id');
            if (!saleId) {
                Swal.fire({
                    icon: 'info',
                    title: 'Sale Not Yet Posted',
                    text: 'Please confirm and post the sale first. Once posted, you can transmit this invoice to FBR.'
                });
                return;
            }
            if (window.FbrPostManager) {
                window.FbrPostManager.open(saleId);
            }
        });

        // Listen for FBR Posted Event
        $(document).on('fbr:posted', function(e, data) {
            $('#btnPostToFbr')
                .prop('disabled', true)
                .css('cursor', 'default')
                .addClass('is-posted')
                .html('<i class="bi bi-check-circle-fill text-success me-1"></i> FBR Posted: ' + data.fbrInvoiceNo);
        });

        // Discount Type Toggle (Amt per pc vs Percent)
        $(document).on('click', '.toggle-type', function() {
            let $btn = $(this);
            let current = $btn.data('type') || 'amount';
            let next = (current === 'amount') ? 'percent' : 'amount';
            let nextText = (next === 'percent') ? '%' : 'Rs';
            
            $btn.data('type', next).text(nextText);
            
            if (next === 'percent') {
                $btn.removeClass('btn-outline-secondary').addClass('btn-outline-info');
            } else {
                $btn.removeClass('btn-outline-info').addClass('btn-outline-secondary');
            }

            // Sync hidden input
            let $row = $btn.closest('tr');
            if ($row.length) {
                $row.find('.item-disc-type').val(next);
                recalcRow($row);
                recalcSummary();
            } else {
                // Bill discount toggle
                $('#sum_discount_type').val(next);
                recalcSummary();
            }
        });

        // Toggle Advance Tax Type (% vs Rs)
        $(document).on('click', '.toggle-adv-tax-type', function () {
            let $btn = $(this);
            let current = $btn.attr('data-type') || 'percent';
            let next = (current === 'percent') ? 'amount' : 'percent';

            $btn.attr('data-type', next).text(next === 'percent' ? '%' : 'Rs');
            
            if (next === 'percent') {
                $btn.removeClass('btn-outline-secondary').addClass('btn-outline-info');
            } else {
                $btn.removeClass('btn-outline-info').addClass('btn-outline-secondary');
            }

            let $row = $btn.closest('tr');
            if ($row.length) {
                $row.find('.adv-tax-type').val(next);
                recalcRow($row);
                recalcSummary();
            }
        });

        // Standardized Product Row Population
        function populateProductRow($row, p) {
            const $btn = $row.find('.product-select-btn');
            $btn.text((p.item_name || '') + (p.item_code ? ' (' + p.item_code + ')' : '') + ' ');
            $btn.append('<span class="psm-btn-arrow">&#9660;</span>');
            $btn.addClass('has-value');

            $row.find('.item-id').val(p.id);
            $row.find('.item-code').val(p.item_code || '');
            $row.find('.item-name').val(p.item_name || '');
            $row.find('.hs-code').val(p.hs_code || '');
            $row.find('.size-mode').val(p.size_mode || 'by_cartons');

            // Auto set UOM from product unit or uom_name
            let uomVal = (p.unit && p.unit.name) ? p.unit.name : (p.uom_name || 'Piece');
            $row.find('.uom-input').val(uomVal);
            console.log(p);
            
            // Set price from product data if not already set or if it's a new product
            if (p.sale_price_per_piece) {
                $row.find('.price').val(p.sale_price_per_piece);
            }

            // Standardize UOM/Packing dropdown
            const $pkgSelect = $row.find('.packing-select');
            if ($pkgSelect.length) {
                let optionsHtml = '';
                let seenFactors = {};

                // 1. Packings from database (ProductUom table) - Prioritize these names
                if (p.packings && p.packings.length > 0) {
                    p.packings.forEach(pkg => {
                        let f = parseInt(pkg.pieces_per_box) || 1;
                        if (f <= 1) {
                            let match = pkg.name ? pkg.name.match(/1[xX](\d+)/) : null;
                            if (!match && p.item_name) match = p.item_name.match(/1[xX](\d+)/);
                            if (match && parseInt(match[1]) > 0) {
                                f = parseInt(match[1]);
                            } else {
                                f = parseInt(p.uom || p.pieces_per_box) || 1;
                            }
                        }
                        if (seenFactors[f]) return;
                        seenFactors[f] = true;
                        optionsHtml += `<option value="${pkg.id}" data-ppb="${f}" data-price="${pkg.sale_price || 0}" data-mode="${p.size_mode || 'by_cartons'}">${pkg.name}</option>`;
                    });
                } else {
                    // 2. Base Unit (Only add if NO specialized packings exist)
                    let bPpb = parseInt(p.uom || p.pieces_per_box) || 1;
                    if (bPpb <= 1 && p.item_name) {
                        let match = p.item_name.match(/1[xX](\d+)/);
                        if (match && parseInt(match[1]) > 0) {
                            bPpb = parseInt(match[1]);
                        }
                    }
                    let bName = p.uom_name || (p.unit ? p.unit.name : 'Pcs');
                    if (!bName || bName.toLowerCase() === 'piece' || bName.toLowerCase() === 'pcs') {
                        bName = '1x' + bPpb;
                    }
                    
                    optionsHtml = `<option value="" data-ppb="${bPpb}" data-price="${p.sale_price_per_piece || 0}" data-mode="${p.size_mode || 'by_cartons'}">${bName} (Base)</option>`;
                }

                $pkgSelect.html(optionsHtml);
                
                // 3. Auto-select first available packing if any exists
                let $extras = $pkgSelect.find('option[value!=""]');
                if ($extras.length > 0) {
                    $pkgSelect.val($extras.first().val());
                }
                
                // Explicitly update Packet (item-uom) and trigger change
                const $selectedOpt = $pkgSelect.find('option:selected');
                if ($selectedOpt.length) {
                    const initialFactor = parseInt($selectedOpt.attr('data-ppb') || $selectedOpt.data('ppb')) || 1;
                    const $uomInput = $row.find('.item-uom');
                    $uomInput.val(initialFactor);
                    if ($uomInput[0]) $uomInput[0].value = initialFactor; // Direct assignment for reliability
                    $row.find('.item_uom_factor').val(initialFactor);
                }

                $pkgSelect.trigger('change');
            }

            // Load warehouses and batches
            const $whSelect = $row.find('.item-warehouse');
            if ($whSelect.length) {
                const isSoMode = "{{ request()->query('mode') }}" === "so";
                let whParams = {};
                if (isSoMode) whParams.include_empty = 1;

                $.getJSON('/product/' + p.id + '/warehouses', whParams, function(warehouses) {
                    $whSelect.html('<option value="">-- Select --</option>');
                    if (warehouses.length > 0) {
                        warehouses.forEach(function(pw) {
                            var stock = pw.total_pieces || 0;
                            var displayStock = pw.stock_display || stock;
                            $whSelect.append(`<option value="${pw.id}" data-stock="${stock}" data-stock-display="${displayStock}" data-ppb="${pw.ppb || 1}" data-size-mode="${pw.size_mode || 'std'}">${pw.name} (Stock: ${displayStock})</option>`);
                        });
                        const hWh = $('#warehouse_id_header').val() || '{{ $defaultWhId }}';
                        const defaultWh = warehouses.find(w => w.id == hWh) || warehouses[0];
                        $whSelect.val(defaultWh.id).trigger('change');
                    }
                });
            }

            loadBatches($row, p.id);
            recalcRow($row);
            recalcSummary();
        }

        // Product Table & Search Logic
        let rowCount = 0;

        function num(n) {
            return isNaN(parseFloat(n)) ? 0 : parseFloat(n);
        }

        function checkEmptyState() {
            if ($('#saleItems tr').length > 0) {
                $('#emptyTableState').hide();
            } else {
                $('#emptyTableState').show();
            }
        }

        // ── parseBoxPiece: identical to GRN logic ──────────────────────────
        function parseBoxPieceNew($boxInput, $looseInput, pack) {
            let boxes = parseFloat($boxInput.val()) || 0;
            let loose = parseFloat($looseInput.val()) || 0;
            let total = (boxes * pack) + loose;
            return { total_pieces: total, boxes: boxes, pieces: loose };
        }


        function recalcRow($row) {
            const pack     = parseFloat($row.find('.item-uom').val()) || 1;
            const sizeMode = $row.find('.size-mode').val() || 'by_cartons';
            const price    = num($row.find('.price').val());
            const discVal  = num($row.find('.item_disc').val());
            const discType = $row.find('.item-disc-type').val() || 'amount';
            const gstRate  = num($row.find('.gst').val());

            let paid = parseBoxPieceNew($row.find('.quantity'), $row.find('.loose_pieces'), pack);
            let total_free_pieces = num($row.find('.free_loose_pieces').val());

            $row.data('total-pieces', paid.total_pieces);
            $row.data('total-free-pieces', total_free_pieces);

            let billableQty = paid.boxes + (pack > 0 ? (paid.pieces / pack) : 0);
            let line_gross = Math.round((billableQty * price) * 100) / 100;
            let line_disc  = (discType === 'percent') ? (Math.round((line_gross * discVal / 100) * 100) / 100) : discVal;

            let subTotal = Math.max(0, Math.round((line_gross - line_disc) * 100) / 100);

            const gstAmt   = Math.round((subTotal * (gstRate / 100)) * 100) / 100;   // GST: ADDED
            $row.find('.gst-amount-row').val(gstAmt.toFixed(2));

            const incTaxPct  = num($row.find('.inc-tax').val());
            const advTaxVal  = num($row.find('.adv-tax').val());
            const advTaxType = $row.find('.adv-tax-type').val() || 'percent';

            const incTaxAmt = Math.round((subTotal * (incTaxPct / 100)) * 100) / 100; // WHT: DEDUCTED
            const advTaxAmt = (advTaxType === 'percent') ? (Math.round((subTotal * (advTaxVal / 100)) * 100) / 100) : advTaxVal; // Adv: ADDED
            // Line net: sub + GST - WHT + Adv
            const netTotal  = Math.round((subTotal + gstAmt - incTaxAmt + advTaxAmt) * 100) / 100;

            $row.find('.row-sub-total').val(subTotal.toFixed(2));
            $row.find('.row-net-total').val(netTotal.toFixed(2));

            const totalQty = paid.total_pieces + total_free_pieces;
            $row.find('.row-cost-pc').val(totalQty > 0 ? (netTotal / totalQty).toFixed(2) : '0.00');
        }

        function recalcSummary() {
            let gross       = 0;
            let totalGstAmt = 0;
            let totalIncTax = 0;
            let totalAdvTax = 0;
            let totalPieces = 0;
            let totalFreePieces = 0;
            let totalRowDisc = 0;
            let sumRowSub = 0;
            let boxCount = 0;
            let pieceCount = 0;

            $('#saleItems tr').each(function() {
                const $r      = $(this);
                recalcRow($r);
                const pack    = parseFloat($r.find('.item-uom').val()) || 1;
                const sizeMode = $r.find('.size-mode').val() || 'by_cartons';
                const price   = num($r.find('.price').val());
                const fpcs    = $r.data('total-free-pieces') || 0;
                
                const discVal  = num($r.find('.item_disc').val());
                const discType = $r.find('.item-disc-type').val() || 'amount';

                let paid = parseBoxPieceNew($r.find('.quantity'), $r.find('.loose_pieces'), pack);

                let billableQty = paid.boxes + (pack > 0 ? (paid.pieces / pack) : 0);
                let rowGross  = Math.round((billableQty * price) * 100) / 100;
                let rowDisc   = (discType === 'percent') ? (Math.round((rowGross * discVal / 100) * 100) / 100) : discVal;
                
                let rowGst    = num($r.find('.gst-amount-row').val());
                let rowSub    = num($r.find('.row-sub-total').val());
                let rowIncTax = rowSub * (num($r.find('.inc-tax').val()) / 100);

                let rowAdvTaxVal  = num($r.find('.adv-tax').val());
                let rowAdvTaxType = $r.find('.adv-tax-type').val() || 'percent';
                let rowAdvTax     = (rowAdvTaxType === 'percent') ? (rowSub * (rowAdvTaxVal / 100)) : rowAdvTaxVal;

                let sub       = num($r.find('.row-sub-total').val());

                gross          += rowGross;
                totalRowDisc   += rowDisc;
                sumRowSub      += sub;
                totalGstAmt    += rowGst;
                totalIncTax    += rowIncTax;
                totalAdvTax    += rowAdvTax;
                totalPieces    += paid.total_pieces;
                totalFreePieces += fpcs;
                
                boxCount       += paid.boxes;
                pieceCount     += paid.pieces;
            });

            // Display total pieces only
            $('#summary_total_qty').text(totalPieces + ' Pcs');
            $('#summary_total_free_qty').text(totalFreePieces + ' Total Pcs');

            $('#gross_total').val(gross.toFixed(2));
            $('#total_row_disc').val(totalRowDisc.toFixed(2));
            $('#total_gst').val(totalGstAmt.toFixed(2));
            $('#total_inc_tax').val(totalIncTax.toFixed(2));
            $('#total_adv_tax').val(totalAdvTax.toFixed(2));

            const discVal = num($('#sum_discount').val());
            const discType = $('#sum_discount').closest('.input-group').find('.toggle-type').data('type');
            
            let billDisc = 0;
            if (discType === 'percent') {
                billDisc = (sumRowSub) * (discVal / 100);
            } else {
                billDisc = discVal;
            }

            let summarySub = sumRowSub - billDisc;
            $('#summary_sub_total').val(summarySub.toFixed(2));

            const sumApplyGst = num($('#sum_apply_gst').val());
            const sumFreight  = num($('#sum_freight').val());
            const sumExpense  = parseFloat($('#sum_expense').val() || 0);

            // Pakistan Standard:
            // Invoice Total = (summarySub + freight + expense + fixed gst add-on) + GST
            // Net Payable = Invoice Total - WHT - Adv
            const gstBase     = summarySub + sumFreight + sumExpense + sumApplyGst;
            const invoiceTotal = gstBase + totalGstAmt;
            let finalNet       = invoiceTotal - totalIncTax + totalAdvTax;
            $('#invoice_total').val(invoiceTotal.toFixed(2));
            $('#final_net_total').val(finalNet.toFixed(2));

            // Update Amount in Words
            if (typeof numberToWords === 'function') {
                $('#amountInWords').val(numberToWords(Math.round(finalNet)));
            }
        }

        function numberToWords(num) {
            var a = ['', 'one ', 'two ', 'three ', 'four ', 'five ', 'six ', 'seven ', 'eight ', 'nine ', 'ten ', 'eleven ', 'twelve ', 'thirteen ', 'fourteen ', 'fifteen ', 'sixteen ', 'seventeen ', 'eighteen ', 'nineteen '];
            var b = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
            if ((num = num.toString()).length > 9) return 'overflow';
            n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
            if (!n) return;
            var str = '';
            str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
            str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
            str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
            str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
            str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) : '';
            return str.trim().toUpperCase() + ' RUPEES ONLY';
        }


        function getDuplicateLots() {
            let lots = {};
            let duplicates = [];
            $('#saleItems tr').each(function() {
                let pid = $(this).find('.item-id').val();
                let lot = $(this).find('input[name="lot_no[]"]').val();
                let name = $(this).find('.item-name').val();
                if (pid && lot && lot.trim() !== '') {
                    lot = lot.trim().toLowerCase();
                    let key = pid + '_' + lot;
                    if (lots[key]) {
                        duplicates.push({
                            name: name,
                            lot: lot
                        });
                    } else {
                        lots[key] = true;
                    }
                }
            });
            return duplicates;
        }

        function loadBatches($row, productId, selectedBatchId = null) {
            const warehouseId = $row.find('.row-warehouse-id').val() || $('#warehouse_id_header').val();
            const $batchSelect = $row.find('.batch-select2');
            const isSoMode = "{{ request()->query('mode') }}" === "so";

            // Clear existing except first option
            $batchSelect.find('option:not(:first)').remove();

            if (!productId) return;

            let params = { warehouse_id: warehouseId };
            if (isSoMode) params.include_empty = 1;

            $.get("{{ route('batches.for.product', ':id') }}".replace(':id', productId), params, function(batches) {
                batches.forEach(function(batch) {
                    $batchSelect.append(`<option value="${batch.id}"
                        data-lot="${batch.batch_number}"
                        data-exp="${batch.exp_date}"
                        data-qty="${batch.qty_remaining}">
                        ${batch.label}
                    </option>`);
                });
                
                if (selectedBatchId) {
                    $batchSelect.val(selectedBatchId).trigger('change');
                }
            });
        }

        function addBlankRow() {
            rowCount++;
            const isSoMode = "{{ request()->query('mode') }}" === "so";
            let batchHtml = '';
            if (!isSoMode) {
                batchHtml = `
                <td>
                    <select name="batch_id[]" class="form-select batch-select2 row-input" style="width:100%">
                        <option value="">Auto (FEFO)</option>
                    </select>
                </td>
                <td><input type="text" name="lot_no[]" class="form-control text-center row-input lot-no-display" placeholder="Auto"></td>
                `;
            }

            const newRow = `
              <tr class="item-row">
                <td>
                    <input type="hidden" name="product_id[]" class="item-id">
                    <input type="hidden" name="warehouse_id[]" class="item-warehouse row-warehouse-id" value="{{ $defaultWhId }}">
                    <input type="text" name="item_code[]" class="form-control bg-transparent border-0 px-1 item-code text-muted font-monospace" placeholder="—" readonly style="font-size:11px;">
                </td>
                <td style="font-weight:600; color:#334155;">
                    <input type="hidden" name="item_name[]" class="item-name">
                    <button type="button" class="product-select-btn">Select Product <span class="psm-btn-arrow">&#9660;</span></button>
                </td>
                <td class="hs-code-col">
                    <div class="input-group input-group-sm" style="min-width: 130px;">
                        <input type="text" name="hs_code[]" class="form-control text-center hs-code item-hs-code" style="font-size:11px; padding:2px 4px; background:#fff;" placeholder="HS Code">
                        <button type="button" class="btn btn-outline-primary btn-quick-hs px-2" onclick="window.openQuickHsModalForBtn && window.openQuickHsModalForBtn(this)" title="Quick Update Product HS Code" style="padding: 2px 7px;">
                            <i class="bi bi-plus-lg"></i>
                        </button>
                    </div>
                </td>
                <td>
                    <select name="pieces_per_box[]" class="form-select packing-select" style="min-width:130px;"></select>
                    <input type="hidden" name="packing_id[]" class="packing-id">
                    <input type="hidden" name="uom_id[]" class="uom-id">
                    <input type="hidden" name="item_uom_factor[]" class="item_uom_factor" value="1">
                    <input type="hidden" name="size_mode[]" class="size-mode" value="by_cartons">
                </td>
                <td>
                    <input type="text" name="item_uom[]" list="uom_datalist" class="form-control text-center uom-input row-input" style="min-width:85px;" placeholder="e.g. KG, Piece" value="Piece">
                </td>
                <td class="text-center">
                    <input type="number" name="pcs_per_box_display[]" class="form-control text-center item-uom" value="1" readonly style="width:60px; background:#f8fafc;"
                           title="Pieces per Box">
                </td>
                <td><input type="number" name="qty[]" class="form-control quantity text-end fw-bold row-input" style="background:#eff6ff; min-width: 80px;" value="1" placeholder="Box"></td>
                <td><input type="number" name="loose_pieces[]" class="form-control loose_pieces text-end fw-bold row-input" style="background:#eff6ff; min-width: 80px;" value="0" placeholder="Pcs"></td>
                <td><input type="number" name="free_loose_pieces[]" class="form-control free_loose_pieces text-end row-input" value="0" placeholder="Free Pcs"></td>
                <td><input type="number" step="0.01" name="price[]" class="form-control price text-end row-input" value="0" ></td>
                <td>
                    <div class="input-group input-group-sm">
                        <input type="hidden" name="item_disc_type[]" class="item-disc-type" value="amount">
                        <input type="number" step="0.01" name="item_disc[]" class="form-control item_disc text-end row-input" value="0">
                        <button class="btn btn-outline-secondary toggle-type" type="button" data-type="amount">Rs</button>
                    </div>
                </td>
                <td><input type="text" name="sub_total[]" class="form-control row-sub-total text-end" readonly></td>
                <td>
                    <div class="input-group input-group-sm">
                        <input type="number" step="0.01" name="gst[]" class="form-control gst text-end row-input" value="0">
                        <span class="input-group-text p-1" style="font-size:0.7rem;">%</span>
                    </div>
                    <input type="hidden" name="gst_amount[]" class="gst-amount-row" value="0">
                </td>
                <td><input type="number" step="0.01" name="inc_tax[]" class="form-control inc-tax text-end row-input" value="0"></td>
                <td>
                    <div class="input-group input-group-sm" style="min-width: 90px;">
                        <input type="hidden" name="adv_tax_type[]" class="adv-tax-type" value="percent">
                        <input type="number" step="0.01" name="adv_tax[]" class="form-control adv-tax text-end row-input" value="0">
                        <button class="btn btn-outline-info toggle-adv-tax-type" type="button" data-type="percent" style="padding: 2px 5px; font-size: 0.72rem;">%</button>
                    </div>
                </td>
                <td><input type="text" name="total[]" class="form-control row-net-total input-highlight text-end" readonly></td>
                ${batchHtml}
                <td><input type="text" name="cost_per_pc[]" class="form-control row-cost-pc text-end" readonly></td>
                <td style="text-align:center;">
                    <button type="button" class="btn-erp-danger-ghost remove-row" title="Remove Item"><i class="bi bi-x-circle-fill"></i></button>
                </td>
              </tr>`;

            $('#saleItems').append(newRow);
            const $inserted = $('#saleItems tr:last');

            recalcRow($inserted);
            toggleGstFields();
            recalcSummary();
            checkEmptyState();
            return $inserted;
        }

        /* ── Quick HS Code Button Click ── */
        $(document).on('click', '.btn-quick-hs', function(e) {
            e.preventDefault();
            if (window.openQuickHsModalForBtn) {
                window.openQuickHsModalForBtn(this);
            }
        });

        /* ── Row Product Button → Modal (multi-select) ── */
        $(document).on('click', '.product-select-btn', function() {
            var $triggerBtn = $(this);
            var $triggerRow = $triggerBtn.closest('tr');
            var triggerRowEmpty = !$triggerRow.find('.item-id').val();
            
            ERPProductModal.open({
                priceField: 'sale',
                selectedIds: [],
                onSelect: function(products) {
                    products.forEach(function(p, idx) {
                        // First product replaces the triggering row, subsequent products get new rows
                        var $row = (idx === 0) ? $triggerRow : addBlankRow();
                        populateProductRow($row, p);
                    });
                    checkEmptyState();
                    setTimeout(function() { $('#saleItems tr:last').find('.quantity').focus().select(); }, 150);
                }
            });
        });

        function initSelect2($el) {  /* kept for legacy */
            $el.select2({
                placeholder: 'Search product...',
                allowClear: true,
                ajax: {
                    url: "{{ route('search-products') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        var items = Array.isArray(data) ? data : (data.results || []);
                        return {
                            results: items.map(function(item) {
                                return {
                                    id: item.id,
                                    text: (item.item_code ? item.item_code + ' - ' : '') + item.item_name,
                                    item_name: item.item_name,
                                    item_code: item.item_code,
                                    hs_code: item.hs_code || '',
                                    uom: item.pieces_per_box || 1,
                                    size_mode: item.size_mode || 'by_cartons',
                                    packings: item.packings || [],
                                    price: item.sale_price_per_piece || 0,
                                    uom_name: item.uom_name || ''
                                };
                            }),
                            pagination: data.pagination || { more: false }
                        };
                    },
                    cache: true
                }
            });

            $el.on('select2:select', function(e) {
                var data = e.params.data;
                var $row = $(this).closest('tr');
                $row.find('.item-code').val(data.item_code);
                $row.find('.item-id').val(data.id);
                $row.find('.item-name').val(data.item_name);
                $row.find('.hs-code').val(data.hs_code || '');
                $row.find('.size-mode').val(data.size_mode || 'by_cartons');
                console.log(data);
                
                // Initialize Packing Select — DB packings first, base only if not covered
                var $pSelect = $row.find('.packing-select');
                $pSelect.empty();
                
                if ($pSelect.length) {
                    let optionsHtml = '';
                    let seenFactors = {};

                    // 1. DB packings first (use their exact names from product_uoms)
                    if (data.packings && data.packings.length > 0) {
                        data.packings.forEach(function(pkg) {
                            let f = parseInt(pkg.pieces_per_box) || 1;
                            if (f === 1) f = parseInt(data.uom || data.pieces_per_box) || 1;
                            if (seenFactors[f]) return; // deduplicate by factor
                            seenFactors[f] = true;
                            optionsHtml += `<option value="${pkg.id}" data-ppb="${f}" data-price="${pkg.sale_price || 0}">${pkg.name}</option>`;
                        });
                    } else {
                        // 2. Base unit — only add if NO DB packings exist
                        let bPpb = parseInt(data.uom) || 1;
                        let bName = data.uom_name;
                        if (!bName || bName.toLowerCase() === 'piece' || bName.toLowerCase() === 'pcs') {
                            bName = '1x' + bPpb;
                        }
                        optionsHtml = `<option value="" data-ppb="${bPpb}" data-price="${data.price || 0}">${bName}</option>`;
                    }

                    $pSelect.html(optionsHtml);
                    
                    // Auto-select first option (which is now the first DB packing if any)
                    $pSelect.prop('selectedIndex', 0);
                    
                    // Update Packet column and trigger change
                    const $selectedOpt = $pSelect.find('option:selected');
                    if ($selectedOpt.length) {
                        const initialFactor = parseInt($selectedOpt.attr('data-ppb') || $selectedOpt.data('ppb')) || 1;
                        const $uomInput = $row.find('.item-uom');
                        $uomInput.val(initialFactor);
                        if ($uomInput[0]) $uomInput[0].value = initialFactor;
                        $row.find('.item_uom_factor').val(initialFactor);
                    }

                    $pSelect.trigger('change');
                }

                if (!$pSelect.val()) {
                    $row.find('.price').val(data.price);
                }

                var ppb = parseInt(data.uom) || 1;
                $row.find('.quantity').attr('placeholder', 'Box').val('1');
                $row.find('.loose_pieces').attr('placeholder', 'Pcs').val('0');
                $row.find('.free_loose_pieces').attr('placeholder', 'Free Pcs').val('0');

                $row.data('ppb', data.uom || 1);
                $row.data('size_mode', data.size_mode || 'by_cartons');

                // Load warehouses for this product
                var $whSelect = $row.find('.item-warehouse');
                $whSelect.html('<option value="">-- Select --</option>');
                
                const isSoMode = "{{ request()->query('mode') }}" === "so";
                let whParams = {};
                if (isSoMode) whParams.include_empty = 1;

                $.getJSON('/product/' + data.id + '/warehouses', whParams, function(warehouses) {
                    $whSelect.html('<option value="">-- Select --</option>');
                    if (warehouses.length > 0) {
                        warehouses.forEach(function(pw) {
                            var stock = pw.total_pieces || 0;
                            var displayStock = pw.stock_display || stock;
                            
                            $whSelect.append('<option value="' + pw.id +
                                '" data-stock="' + stock + '" data-stock-display="' + displayStock + '" data-ppb="' + (pw.ppb || 1) + '" data-size-mode="' + (pw.size_mode || 'std') + '">' + pw
                                .name + ' (Stock: ' + displayStock + ')</option>'
                            );
                        });
                        if (warehouses.length > 0) {
                            var hWh = $('#warehouse_id_header').val() || '{{ $defaultWhId }}';
                            var defaultWh = warehouses.find(w => w.id == hWh) || warehouses[0];
                            $whSelect.val(defaultWh.id).trigger('change');
                        }
                    }
                });

                // FEFO: Load batches
                loadBatches($row, data.id);

                recalcRow($row);
                recalcSummary();
                // move focus to qty
                setTimeout(() => $row.find('.quantity').focus().select(), 100);
            });
            $el.on('select2:unselect', function(e) {
                var $row = $(this).closest('tr');
                $row.find('.item-code').val('');
                $row.find('.item-id').val('');
                $row.find('.item-name').val('');
                $row.find('.hs-code').val('');
                $row.find('.item-uom').val('');
                $row.find('.price').val(0);

                // Clear batches
                $row.find('.batch-select2').find('option:not(:first)').remove();
                $row.find('.lot-no-display').val('').prop('readonly', false);

                recalcRow($row);
                recalcSummary();
            });
        }

        // Listener for Batch Change
        $('#saleItems').on('change', '.batch-select2', function() {
            const $row = $(this).closest('tr');
            const $opt = $(this).find('option:selected');
            const batchId = $(this).val();

            if (batchId) {
                const lot = $opt.data('lot');
                $row.find('.lot-no-display').val(lot).prop('readonly', true);
            } else {
                // Auto FEFO
                $row.find('.lot-no-display').val('').prop('readonly', false).attr('placeholder',
                    'Auto');
            }
        });

        // Listener for Warehouse Change in row
        $('#saleItems').on('change', '.item-warehouse', function() {
            const whId = $(this).val();
            const $row = $(this).closest('tr');
            const productId = $row.find('.item-id').val();
            if (productId) {
                loadBatches($row, productId);
            }
        });

        // Generate Blank Row by default
        addBlankRow();

        // HS Code Toggle Logic
        $('#enable_hs_code').on('change', function() {
            if($(this).is(':checked')) {
                $('.hs-code-col').show();
            } else {
                $('.hs-code-col').hide();
            }
        }).trigger('change');

        // Add row via button
        $('#btnAddRow').click(function() {
            addBlankRow();
        });

        // Add row via Enter Key on any row-input
        $('#saleItems').on('keydown', '.row-input', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                // Check if this is the last row in the table
                const isLastRow = $(this).closest('tr').is(':last-child');
                if (isLastRow) {
                    addBlankRow();
                    setTimeout(function() {
                        $('#saleItems tr:last').find('.product-select-btn').focus();
                    }, 100);
                } else {
                    // Just move to the next row's quantity or select2
                    $(this).closest('tr').next().find('.quantity').focus().select();
                }
            }
        });

        // Calculations & Removals
        $('#saleItems').on('change', '.packing-select', function() {
            var $row = $(this).closest('tr');
            var $opt = $(this).find('option:selected');
            
            var factor = parseFloat($opt.attr('data-ppb') || $opt.data('ppb')) || 1;
            if (factor <= 1) {
                var optText = $opt.text();
                if (optText && optText.match(/1[xX](\d+)/)) {
                    factor = parseInt(optText.match(/1[xX](\d+)/)[1]);
                }
            }
            var price  = $opt.data('price');
            var pkgId  = $(this).val();

            $row.find('.item_uom_factor').val(factor);
            $row.find('.item-uom').val(factor);
            $row.find('.uom-id').val(pkgId);
            
            if (price && parseFloat(price) > 0) {
                $row.find('.price').val(parseFloat(price).toFixed(2));
            }
            
            recalcRow($row);
            recalcSummary();
        });

        $('#saleItems').on('input', '.quantity, .loose_pieces, .free_loose_pieces, .price, .item_disc, .gst, .inc-tax, .adv-tax', function() {
            recalcRow($(this).closest('tr'));
            recalcSummary();
        });

        $('.input_summary, #sum_freight, #sum_expense').on('input', recalcSummary);

        $('#saleItems').on('change', 'input[name="lot_no[]"]', function() {
            let $row = $(this).closest('tr');
            let pid = $row.find('.item-id').val();
            let lot = $(this).val();

            if (pid && lot && lot.trim() !== '') {
                $.get("{{ route('purchase.check_lot') }}", {
                    product_id: pid,
                    lot_no: lot
                }, function(res) {
                    if (res.exists) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Batch Number Already Exists',
                            text: `This batch/lot number (${lot}) was already purchased for this product in the past. Please verify if this is a repeat purchase or a typing error.`
                        });
                    }
                });
            }
        });

        $('#saleItems').on('click', '.remove-row', function() {
            $(this).closest('tr').remove();
            recalcSummary();
            checkEmptyState();
        });


        // Init Vendor Search Select2
        $('#vendor_select').select2({
            placeholder: 'Select Vendor A/C...',
            allowClear: true
        });

        recalcSummary();
        checkEmptyState();

        // --- Booked Products Logic ---
        $('#searchBookedProducts').on('input', function() {
            let val = $(this).val().toLowerCase();
            $('.booked-item-row').each(function() {
                let searchable = $(this).attr('data-search') || '';
                $(this).toggle(searchable.includes(val));
            });
        });

        // Helper to reliably set date input values (supporting Native Inputs & Flatpickr instances)
        function setFormDate(selector, dateStr) {
            if (!dateStr) return;
            // Strict YYYY-MM-DD extraction
            if (typeof dateStr === 'string' && dateStr.length >= 10) {
                dateStr = dateStr.substring(0, 10);
            }
            var el = document.querySelector(selector);
            if (!el) return;

            // 1. Direct DOM & jQuery assignment
            el.value = dateStr;
            $(el).val(dateStr);

            // 2. Flatpickr Instance Update (Crucial: Flatpickr hides the original input and uses a cloned visible input)
            if (el._flatpickr) {
                el._flatpickr.setDate(dateStr, true, 'Y-m-d');
            }

            // 3. Dispatch change events
            el.dispatchEvent(new Event('input', { bubbles: true }));
            el.dispatchEvent(new Event('change', { bubbles: true }));
        }

        // Helper to populate imported items into the sale items table
        function populateImportedItems(items, defaultWhId) {
            $('#saleItems').empty();
            rowCount = 0;

            if (!items || !items.length) {
                addBlankRow();
                recalcSummary();
                checkEmptyState();
                return;
            }

            items.forEach(function(item) {
                addBlankRow();
                let $lastRow = $('#saleItems tr:last');
                let prodId = item.product_id;

                if (!prodId) return;

                $.getJSON("{{ route('product.details', ':id') }}".replace(':id', prodId), function(p) {
                    populateProductRow($lastRow, p);

                    let ppb = parseInt(p.pieces_per_box) || parseInt(item.ppb) || 1;
                    let totalPieces = parseInt(item.total_pieces) || 0;
                    if (totalPieces === 0 && item.qty) {
                        totalPieces = Math.round((parseFloat(item.qty) || 0) * ppb);
                    }
                    let boxes = Math.floor(totalPieces / ppb);
                    let pcs = totalPieces % ppb;

                    $lastRow.find('.quantity').val(boxes);
                    $lastRow.find('.loose_pieces').val(pcs);

                    if (item.price && parseFloat(item.price) > 0) {
                        $lastRow.find('.price').val(parseFloat(item.price).toFixed(2));
                    }

                    if (item.discount_amount !== undefined && parseFloat(item.discount_amount) > 0) {
                        $lastRow.find('.item_disc').val(parseFloat(item.discount_amount));
                    } else if (item.discount_percent !== undefined && parseFloat(item.discount_percent) > 0) {
                        $lastRow.find('.item_disc').val(parseFloat(item.discount_percent));
                    }

                    if (item.lot_number || item.lot_no || item.batch_no) {
                        $lastRow.find('.lot-no-display').val(item.lot_number || item.lot_no || item.batch_no);
                    }

                    if (item.uom_name) {
                        $lastRow.find('.uom-input').val(item.uom_name);
                    }

                    let wh_id = item.warehouse_id || defaultWhId;
                    if (wh_id) {
                        let $whSelect = $lastRow.find('.item-warehouse');
                        let checkInterval = setInterval(function() {
                            if ($whSelect.find('option[value="' + wh_id + '"]').length > 0) {
                                $whSelect.val(wh_id).trigger('change');
                                clearInterval(checkInterval);
                            }
                        }, 100);
                        setTimeout(() => clearInterval(checkInterval), 3000);
                    }

                    if (item.batch_id) {
                        loadBatches($lastRow, prodId, item.batch_id);
                    }

                    recalcRow($lastRow);
                    recalcSummary();
                    checkEmptyState();
                });
            });
        }

        // Consolidated AJAX-driven Import Handler
        function importBookedItem(btn) {
            let $btn = $(btn);
            let importType = $btn.data('type') || 'dc';
            let id = $btn.data('id');
            let isAdvance = $btn.data('is-advance') == '1';
            let currentMode = $('input[name="mode"]').val();

            if (!id) return;

            if (isAdvance && currentMode === 'so') {
                $('input[name="mode"]').val('sin');
                $('h1.page-title').html('<i class="bi bi-box-seam me-2 text-primary"></i> Sale Invoice Note');
                $('p.page-subtitle').text('Record outward stock to customers efficiently.');
                $('#btnSaveOnly').hide();
                $('#btnConfirm').show();
            }

            if (window.ERPImportLoader) window.ERPImportLoader.start();

            let endpoint = (importType === 'draft') 
                ? '{{ url("sales/draft-details") }}/' + id 
                : '{{ url("sales/dc-details") }}/' + id;

            $.getJSON(endpoint, function(data) {
                if (importType === 'dc') {
                    // Delivery Note (DC) Import
                    if (data.sale_id) $('#draft_id_input').val(data.sale_id);
                    $('#dc_id_input').val(data.id);

                    if (data.customer_id) {
                        $('#customer_id').val(data.customer_id);
                        $('#customer_name_display').val(data.customer_name || (data.customer ? data.customer.customer_name : ''));
                    }

                    if (data.employee_id) {
                        $('#sales_officer_id').val(data.employee_id);
                        $('#sales_officer_display').val(data.employee_name || '');
                    }

                    if (data.commission_percentage !== undefined && data.commission_percentage !== null) {
                        $('#commission_percentage').val(data.commission_percentage);
                    }

                    let headerWh = data.warehouse_id || (data.items && data.items.length ? data.items[0].warehouse_id : '');
                    if (headerWh) {
                        $('#warehouse_id_header').val(headerWh).trigger('change');
                    }

                    $('input[name="vendor_bill_no"]').val(data.grouped_dc_no || data.dc_no || '');

                    if (data.sale) {
                        $('input[name="sale_order_no"]').val(data.sale.invoice_no || '');
                        $('input[name="order_no"]').val(data.sale.order_no || '');
                        $('input[name="note"]').val(data.sale.note || '');
                        $('input[name="reference"]').val(data.sale.reference || '');
                        $('input[name="transport_name"]').val(data.sale.transport_name || '');
                        if (data.sale.discount !== undefined) $('#sum_discount').val(data.sale.discount);
                        if (data.sale.freight_charges !== undefined) $('#sum_freight').val(data.sale.freight_charges);
                        if (data.sale.extra_cost !== undefined) $('#sum_expense').val(data.sale.extra_cost);
                        if (data.sale.is_gst_invoice !== undefined) {
                            $('#gst_invoice').prop('checked', data.sale.is_gst_invoice == 1);
                        }
                    }

                    // Strict Date Population (Flatpickr aware)
                    if (data.delivery_date_formatted) {
                        setFormDate('#dc_date_input', data.delivery_date_formatted);
                        setFormDate('input[name="dc_date"]', data.delivery_date_formatted);
                    }
                    if (data.so_date_formatted) {
                        setFormDate('#so_date_input', data.so_date_formatted);
                        setFormDate('input[name="so_date"]', data.so_date_formatted);
                    }
                    if (data.sale_date_formatted) {
                        setFormDate('#purchase_date_input', data.sale_date_formatted);
                        setFormDate('input[name="purchase_date"]', data.sale_date_formatted);
                    }

                    // Populate Table Rows
                    populateImportedItems(data.items || [], headerWh);

                } else {
                    // Draft Sale Import
                    $('#draft_id_input').val(data.id);

                    if (data.customer_id) {
                        $('#customer_id').val(data.customer_id);
                        $('#customer_name_display').val(data.customer_name || (data.customer_relation ? data.customer_relation.customer_name : ''));
                    }

                    if (data.warehouse_id) {
                        $('#warehouse_id_header').val(data.warehouse_id).trigger('change');
                    }

                    if (data.employee_id) {
                        $('#sales_officer_id').val(data.employee_id);
                        $('#sales_officer_display').val(data.employee_name || '');
                    }

                    if (data.commission_percentage !== undefined && data.commission_percentage !== null) {
                        $('#commission_percentage').val(data.commission_percentage);
                    }

                    $('input[name="vendor_bill_no"]').val(data.vendor_bill_no || '');
                    $('input[name="order_no"]').val(data.order_no || '');
                    $('input[name="sale_order_no"]').val(data.invoice_no || '');
                    $('input[name="note"]').val(data.note || '');
                    $('input[name="reference"]').val(data.reference || '');
                    $('input[name="transport_name"]').val(data.transport_name || '');

                    if (data.discount !== undefined) $('#sum_discount').val(data.discount);
                    if (data.freight_charges !== undefined) $('#sum_freight').val(data.freight_charges);
                    if (data.extra_cost !== undefined) $('#sum_expense').val(data.extra_cost);
                    if (data.is_gst_invoice !== undefined) {
                        $('#gst_invoice').prop('checked', data.is_gst_invoice == 1);
                    }

                    // Strict Date Population (Flatpickr aware)
                    if (data.so_date_formatted) {
                        setFormDate('#so_date_input', data.so_date_formatted);
                        setFormDate('input[name="so_date"]', data.so_date_formatted);
                    }
                    if (data.sale_date_formatted) {
                        setFormDate('#purchase_date_input', data.sale_date_formatted);
                        setFormDate('input[name="purchase_date"]', data.sale_date_formatted);
                    }

                    // Populate Table Rows
                    populateImportedItems(data.items || [], data.warehouse_id);
                }

                $('#bookedProductsModal').modal('hide');
                if (window.ERPImportLoader) window.ERPImportLoader.success();
            }).fail(function(err) {
                console.error("Import Error:", err);
                if (window.ERPImportLoader) window.ERPImportLoader.stop();
                Swal.fire({
                    icon: 'error',
                    title: 'Import Failed',
                    text: 'Unable to load invoice details from server. Please try again.'
                });
            });
        }

        // Import Button Click Handler
        $('.btn-import-single').on('click', function() {
            importBookedItem(this);
        });
    });
</script>
