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
                <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

                <form id="saleForm" action="{{ route('sales.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="action" id="action" value="post">
                    <input type="hidden" name="draft_id" id="draft_id_input" value="{{ $sale->id }}">
                    <input type="hidden" name="mode" value="{{ $sale->sale_status == 'booked' ? 'so' : 'srn' }}">

                    <!-- Top Action / Title Bar -->
                    <div class="qb-topbar">
                        <div class="d-flex align-items-center gap-2">
                            <h1 class="qb-page-title">
                                <i class="bi bi-pencil-square text-success"></i>
                                Edit {{ $sale->sale_status == 'booked' ? 'Sale Order' : 'Sale Invoice Note' }}
                            </h1>
                            <span class="badge" style="background:#ecfdf5; border:1px solid #a7f3d0; color:#065f46; font-size:10.5px; font-weight:600; padding:3px 8px; border-radius:4px;">
                                <i class="bi bi-pencil me-1"></i>Editing #{{ $sale->invoice_no }}
                            </span>
                            <span class="badge" style="background:#f1f5f9; border:1px solid #e2e8f0; color:#475569; font-size:10px; padding:3px 7px; border-radius:4px;">
                                <i class="bi bi-geo-alt me-1"></i>{{ strtoupper($sale->branch->name ?? 'Head Office') }}
                            </span>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('sale.receipt.index') }}" class="qb-btn-back">
                                <i class="bi bi-arrow-left"></i> Back to Registry
                            </a>
                        </div>
                    </div>

                    <!-- Order Information (2-Row Compact Grid) -->
                    <div class="qb-card p-2 mb-1">
                        <input type="hidden" name="branch_id" value="{{ $sale->branch_id }}">
                        <input type="hidden" id="warehouse_id_header" value="1">

                        <!-- Row 1 -->
                        <div class="row gx-2 gy-1">
                            <!-- Customer Account -->
                            <div class="col-md-3">
                                <label class="qb-lbl">Customer Account</label>
                                <div class="input-group input-group-sm">
                                    <button type="button" class="btn btn-select-modal" data-toggle="modal" data-target="#customerModal" title="Select Customer">
                                        <i class="bi bi-person-fill text-success"></i>
                                    </button>
                                    <input type="hidden" name="customer" id="customer_id" value="{{ $sale->customer_id }}">
                                    <input type="text" id="customer_name_display"
                                        class="form-control qb-input qb-input-name fw-bold" readonly
                                        placeholder="Select Customer" data-toggle="modal" data-target="#customerModal"
                                        value="{{ $sale->customer_relation->customer_name ?? 'Select Customer' }}">
                                </div>
                            </div>

                            <!-- Sales Officer -->
                            <div class="col-md-2">
                                <label class="qb-lbl">Sales Officer</label>
                                <div class="input-group input-group-sm">
                                    <button type="button" class="btn btn-select-modal" data-toggle="modal" data-target="#officerModal" title="Select Sales Officer">
                                        <i class="bi bi-person-badge text-primary"></i>
                                    </button>
                                    <input type="hidden" name="sales_officer_id" id="sales_officer_id" value="{{ $sale->employee_id }}">
                                    <input type="text" id="sales_officer_display"
                                        class="form-control qb-input qb-input-name fw-bold" readonly
                                        placeholder="Select Sales Officer" data-toggle="modal" data-target="#officerModal"
                                        value="{{ $sale->salesOfficer->name ?? 'Select Sales Officer' }}">
                                </div>
                            </div>

                            <!-- Sale Invc # -->
                            <div class="col-md-2">
                                <label class="qb-lbl">Invoice #</label>
                                <input type="text" name="sale_no" readonly value="{{ $sale->invoice_no }}" class="form-control qb-input font-monospace fw-bold text-dark bg-light">
                            </div>

                            <!-- Invoice Date -->
                            <div class="col-md-2">
                                <label class="qb-lbl">Invoice Date</label>
                                <input type="date" id="purchase_date_input" name="purchase_date" value="{{ \Carbon\Carbon::parse($sale->created_at)->toDateString() }}" class="form-control qb-input">
                            </div>

                            <!-- Cust Ref / DC # -->
                            <div class="col-md-2">
                                <label class="qb-lbl">Cust Ref / DC #</label>
                                <input type="text" name="vendor_bill_no" value="{{ $sale->vendor_bill_no }}" class="form-control qb-input" placeholder="Ref / DC">
                            </div>

                            <!-- DC Date -->
                            <div class="col-md-1">
                                <label class="qb-lbl">DC Date</label>
                                <input type="date" id="dc_date_input" name="dc_date" value="{{ $sale->dc_date ? \Carbon\Carbon::parse($sale->dc_date)->toDateString() : '' }}" class="form-control qb-input">
                            </div>
                        </div>

                        <!-- Row 2 -->
                        <div class="row gx-2 gy-1 mt-1 align-items-center">
                            <!-- SO # -->
                            <div class="col-md-2">
                                <label class="qb-lbl">SO #</label>
                                <input type="text" name="sale_order_no" class="form-control qb-input" value="{{ $sale->sale_order_no ?? '000000' }}">
                            </div>

                            <!-- SO Date -->
                            <div class="col-md-1">
                                <label class="qb-lbl">SO Date</label>
                                <input type="date" id="so_date_input" name="so_date" value="{{ $sale->so_date ? \Carbon\Carbon::parse($sale->so_date)->toDateString() : date('Y-m-d') }}" class="form-control qb-input">
                            </div>

                            <!-- Order # -->
                            <div class="col-md-2">
                                <label class="qb-lbl">Order #</label>
                                <input type="text" name="order_no" class="form-control qb-input" value="{{ $sale->order_no }}" placeholder="Order #">
                            </div>

                            <!-- Job # / Ref -->
                            <div class="col-md-2">
                                <label class="qb-lbl">Job # / Ref</label>
                                <input type="text" name="reference" class="form-control qb-input" value="{{ $sale->reference }}" placeholder="Job / Ref">
                            </div>

                            <!-- Project -->
                            <div class="col-md-2">
                                <label class="qb-lbl">Project</label>
                                <select name="project" class="form-select qb-select">
                                    <option value="">(N/A)</option>
                                    @if(isset($projects))
                                        @foreach($projects as $p)
                                            <option value="{{ $p->id }}" {{ $sale->project_id == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <!-- Commission % -->
                            <div class="col-md-1">
                                <label class="qb-lbl">Comm %</label>
                                <input type="number" step="0.01" min="0" max="100" name="commission_percentage" id="commission_percentage" class="form-control qb-input fw-bold" value="{{ $sale->commission_percentage ?? '' }}" placeholder="0.00">
                            </div>

                            <!-- Checkboxes & Status -->
                            <div class="col-md-2">
                                <div class="d-flex align-items-center justify-content-between pt-3" style="gap: 4px;">
                                    <label class="qb-check-pill" title="GST Invoice">
                                        <input type="checkbox" id="gst_invoice" name="is_gst_invoice" {{ $sale->is_gst_invoice ? 'checked' : '' }}>
                                        <span>GST</span>
                                    </label>
                                    <label class="qb-check-pill" title="Enable HS Code">
                                        <input type="checkbox" id="enable_hs_code" name="enable_hs_code" value="1" {{ $sale->enable_hs_code ? 'checked' : '' }}>
                                        <span>HS Code</span>
                                    </label>
                                    <span class="qb-status-pill">{{ strtoupper($sale->sale_status ?? 'DRAFT') }}</span>
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
                                        <th style="width:115px" class="hs-code-col text-center">HS Code</th>
                                        <th style="min-width:210px">Product</th>
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
                                        @if ($sale->sale_status != 'booked')
                                            <th style="width:120px">Batch</th>
                                            <th style="width:90px">Lot#</th>
                                        @endif
                                        <th style="width:80px" class="text-end">Cost/PC</th>
                                        <th style="width:36px; text-align:center;">Del</th>
                                    </tr>
                                </thead>
                                <tbody id="saleItems">

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Bottom Section (Setup & Payments + Financial Summary) -->
                    <div class="row gx-2 mt-1">
                        <!-- Setup & Payments -->
                        <div class="col-lg-6 col-xl-6">
                            <div class="qb-card h-100 p-2 d-flex flex-column justify-content-between">
                                <div>
                                    <div class="d-flex justify-content-between align-items-center mb-1 pb-1 border-bottom">
                                        <span class="qb-section-title"><i class="bi bi-wallet2 text-success"></i> Setup &amp; Payments</span>
                                        <span class="badge" style="background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; font-size:9.5px;">Logistics &amp; Voucher</span>
                                    </div>
                                    <div class="row gx-2 gy-1 mb-2">
                                        <div class="col-6">
                                            <label class="qb-lbl">Delivered By / Transport</label>
                                            <input type="text" name="transport_name" class="form-control qb-input" value="{{ $sale->transport_name }}" placeholder="Courier / driver / vehicle">
                                        </div>
                                        <div class="col-6">
                                            <label class="qb-lbl">Sale Remarks</label>
                                            <input type="text" name="note" class="form-control qb-input" value="{{ $sale->note }}" placeholder="Any internal notes or terms">
                                        </div>
                                    </div>

                                    @if ($sale->sale_status != 'booked')
                                        <div class="pt-2 border-top mt-1">
                                            <div class="p-2 rounded" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <label class="qb-lbl mb-0">Payment Voucher Assignment</label>
                                                    <span class="badge" style="background:#ecfdf5; color:#065f46; font-weight:700; font-size:10.5px; border:1px solid #a7f3d0;" id="totalPaid">Rs. 0.00</span>
                                                </div>
                                                <div id="paymentWrapper">
                                                    @php
                                                        $displayPayments = [];
                                                        if($sale->payments && $sale->payments->count() > 0) {
                                                            foreach($sale->payments as $p) {
                                                                $displayPayments[] = (object)['account_id' => $p->account_id, 'amount' => $p->amount];
                                                            }
                                                        } elseif(!empty($sale->payment_details)) {
                                                            foreach($sale->payment_details as $pd) {
                                                                $displayPayments[] = (object)['account_id' => $pd['account_id'], 'amount' => $pd['amount']];
                                                            }
                                                        }
                                                    @endphp

                                                    @foreach($displayPayments as $payment)
                                                        <div class="d-flex gap-1 align-items-center mb-1 payment-row">
                                                            <div class="input-group input-group-sm" style="flex:1;">
                                                                <select class="form-select rv-account qb-input" name="payment_account_id[]" style="font-size:11px;">
                                                                    @foreach ($accounts as $acc)
                                                                        <option value="{{ $acc->id }}" {{ $payment->account_id == $acc->id ? 'selected' : '' }}>{{ $acc->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="input-group input-group-sm" style="width:115px;">
                                                                <span class="input-group-text bg-light p-1 fw-bold" style="font-size:10px; border-color:#cbd5e1;">Rs.</span>
                                                                <input type="number" class="form-control text-end payment-amount qb-input" name="payment_amount[]" value="{{ $payment->amount }}" style="font-size:11px;">
                                                            </div>
                                                            <button type="button" class="btn btn-erp-danger-ghost remove-payment"><i class="bi bi-trash"></i></button>
                                                        </div>
                                                    @endforeach
                                                    <div class="d-flex gap-1 align-items-center mb-1 payment-row">
                                                        <div class="input-group input-group-sm" style="flex:1;">
                                                            <span class="input-group-text bg-light p-1" style="font-size:11px; border-color:#cbd5e1;"><i class="bi bi-bank"></i></span>
                                                            <select class="form-select rv-account qb-input" name="payment_account_id[]" style="font-size:11px;">
                                                                <option value="" selected disabled>Select Payment Account</option>
                                                                @foreach ($accounts as $acc)
                                                                    <option value="{{ $acc->id }}">{{ $acc->title }}</option>
                                                                @endforeach
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
                                            <span class="badge" style="background:#f1f5f9; border:1px solid #e2e8f0; color:#0f172a; font-size:10px;" id="summary_total_qty">{{ $sale->total_qty ?? 0 }} Pcs</span>
                                            <span class="badge" style="background:#f1f5f9; border:1px solid #e2e8f0; color:#475569; font-size:10px;" id="summary_total_free_qty">{{ $sale->free_pieces ?? '—' }}</span>
                                        </div>
                                    </div>

                                    <!-- 2-Column Ledger -->
                                    <div class="row gx-2 gy-0 mb-1">
                                        <div class="col-6">
                                            <div class="qb-ledger-row">
                                                <span class="qb-ledger-lbl">Gross Total:</span>
                                                <input type="text" class="qb-ledger-val" id="gross_total" readonly tabindex="-1" value="{{ $sale->gross_total }}">
                                            </div>
                                            <div class="qb-ledger-row">
                                                <span class="qb-ledger-lbl text-danger">Prod Disc:</span>
                                                <input type="text" class="qb-ledger-val text-danger" id="total_row_disc" readonly tabindex="-1" value="0.00">
                                            </div>
                                            <div class="qb-ledger-row">
                                                <span class="qb-ledger-lbl">Bill Disc:</span>
                                                <div class="d-flex align-items-center gap-1" style="width: 100px;">
                                                    <input type="number" step="0.01" id="sum_discount" name="discount" class="form-control form-control-sm text-end qb-ledger-input" value="{{ $sale->order_discount ?? 0.00 }}">
                                                    <input type="hidden" name="discount_type" id="sum_discount_type" value="amount">
                                                    <button class="btn btn-outline-secondary toggle-type p-0 px-1" type="button" data-type="amount" style="height: 20px; font-size: 9px; line-height: 18px; border-color:#cbd5e1;">Rs</button>
                                                </div>
                                            </div>
                                            <div class="qb-ledger-row">
                                                <span class="qb-ledger-lbl fw-bold text-dark">Sub Total:</span>
                                                <input type="text" class="qb-ledger-val fw-bold text-dark" name="subtotal" id="summary_sub_total" readonly tabindex="-1" value="{{ $sale->subtotal }}">
                                            </div>
                                            <div class="qb-ledger-row">
                                                <span class="qb-ledger-lbl">Freight:</span>
                                                <input type="number" class="form-control form-control-sm text-end qb-ledger-input input_summary" name="freight_charges" id="sum_freight" value="{{ $sale->freight_charges ?? 0.00 }}" style="width: 80px;">
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="qb-ledger-row">
                                                <span class="qb-ledger-lbl">Bilti Exp:</span>
                                                <input type="number" class="form-control form-control-sm text-end qb-ledger-input input_summary" name="extra_cost" id="sum_expense" value="{{ $sale->extra_cost ?? 0.00 }}" style="width: 80px;">
                                            </div>
                                            <div class="qb-ledger-row">
                                                <span class="qb-ledger-lbl text-success">GST (+):</span>
                                                <input type="text" class="qb-ledger-val text-success fw-bold" id="total_gst" readonly tabindex="-1" value="{{ $sale->total_gst ?? 0.00 }}">
                                            </div>
                                            <div class="qb-ledger-row">
                                                <span class="qb-ledger-lbl fw-bold text-dark">Invoice Total:</span>
                                                <input type="text" class="qb-ledger-val fw-bold text-dark" id="invoice_total" readonly tabindex="-1" value="{{ $sale->invoice_total ?? $sale->net_total }}">
                                            </div>
                                            <div class="qb-ledger-row">
                                                <span class="qb-ledger-lbl text-danger">WHT (-):</span>
                                                <input type="text" class="qb-ledger-val text-danger" id="total_inc_tax" readonly tabindex="-1" value="{{ $sale->total_inc_tax ?? 0.00 }}">
                                            </div>
                                            <div class="qb-ledger-row">
                                                <span class="qb-ledger-lbl text-success">Adv Tax (+):</span>
                                                <input type="text" class="qb-ledger-val text-success" id="total_adv_tax" readonly tabindex="-1" value="{{ $sale->total_adv_tax ?? 0.00 }}">
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
                                            <input type="text" class="qb-net-amount" id="final_net_total" name="net_amount" readonly tabindex="-1" value="{{ $sale->net_total }}">
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
                                    <button type="button" class="btn qb-btn-post w-100" id="btnConfirm" style="{{ $sale->sale_status == 'booked' ? 'display:none;' : '' }}">
                                        <i class="bi bi-check2-circle"></i> Update &amp; Post Sale
                                    </button>
                                    <button type="button" class="btn qb-btn-draft w-100" id="btnSaveOnly" style="{{ $sale->sale_status != 'booked' ? 'display:none;' : '' }}">
                                        <i class="bi bi-save2"></i> Update Sale Order (Draft)
                                    </button>
                                    <button type="button" id="btnPostToFbr" 
                                        class="btn qb-btn-fbr {{ $sale->fbr_status === 'posted' ? 'is-posted' : '' }}" 
                                        data-sale-id="{{ $sale->id }}"
                                        {{ ($sale->sale_status !== 'post' || $sale->fbr_status === 'posted') ? 'disabled' : '' }} style="white-space: nowrap;">
                                        @if($sale->fbr_status === 'posted')
                                            <i class="bi bi-check-circle-fill text-success fs-6"></i> FBR Posted ({{ $sale->fbr_invoice_no }})
                                        @else
                                            <i class="bi bi-cloud-arrow-up-fill fs-6"></i> POST TO FBR
                                        @endif
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Modals -->
    @include('admin_panel.sale.sale_receipt_note.modals')
    @include('admin_panel.components.product_select_modal')
    @include('admin_panel.sale.components.fbr_post_modal')
    @include('admin_panel.sale.components.quick_hs_modal')

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Quick HS Code Button Click
            $(document).on('click', '.btn-quick-hs', function(e) {
                e.preventDefault();
                if (window.openQuickHsModalForBtn) {
                    window.openQuickHsModalForBtn(this);
                }
            });

            // Helper functions
            function num(n) { return isNaN(parseFloat(n)) ? 0 : parseFloat(n); }

            function parseBoxPiece($input, pack, sizeMode) {
                let val = String($input.val() || '0');
                let total_pieces = 0, boxes = 0, pieces = 0;

                if (sizeMode === 'by_piece') {
                    total_pieces = parseInt(val) || 0;
                    $input.val(total_pieces);
                    return { total_pieces, boxes: total_pieces, pieces: 0 };
                }

                if (val.includes('.')) {
                    let parts = val.split('.');
                    boxes = parseInt(parts[0]) || 0;
                    pieces = parseInt(parts[1]) || 0;
                    if (pieces >= pack && pack > 0) {
                        boxes += Math.floor(pieces / pack);
                        pieces = pieces % pack;
                        $input.val(pieces > 0 ? `${boxes}.${pieces}` : `${boxes}`);
                    }
                } else {
                    boxes = parseInt(val) || 0;
                }
                total_pieces = (boxes * pack) + pieces;
                return { total_pieces, boxes, pieces };
            }

            function recalcRow($row) {
                const pack = parseFloat($row.find('.item_uom_factor').val()) || 1;
                const sizeMode = $row.find('.size-mode').val() || 'by_cartons';
                const price = num($row.find('.price').val());
                const discVal = num($row.find('.item_disc').val());
                const discType = $row.find('.item-disc-type').val() || 'amount';
                const gstRate = num($row.find('.gst').val());

                let boxes = num($row.find('.quantity').val());
                let loose = num($row.find('.loose_pieces').val());
                let total_pieces = (boxes * pack) + loose;

                let total_free_pieces = num($row.find('.free_loose_pieces').val());

                $row.data('total-pieces', total_pieces);
                $row.data('total-free-pieces', total_free_pieces);

                let billableQty = boxes + (pack > 0 ? (loose / pack) : 0);
                let line_gross = Math.round((billableQty * price) * 100) / 100;
                let line_disc = (discType === 'percent') ? (Math.round((line_gross * discVal / 100) * 100) / 100) : discVal;
                let subTotal = Math.max(0, Math.round((line_gross - line_disc) * 100) / 100);

                const gstAmt = Math.round((subTotal * (gstRate / 100)) * 100) / 100;   // GST: ADDED
                // inc-tax and adv-tax are now percentages (standardized)
                const incTaxPct = num($row.find('.inc-tax').val());
                const advTaxPct = num($row.find('.adv-tax').val());
                const incTaxAmt = Math.round((subTotal * (incTaxPct / 100)) * 100) / 100; // WHT: DEDUCTED
                const advTaxAmt = Math.round((subTotal * (advTaxPct / 100)) * 100) / 100; // Adv: DEDUCTED
                const netTotal = Math.round((subTotal + gstAmt - incTaxAmt - advTaxAmt) * 100) / 100;

                                $row.find('.gst-amount-row').val(gstAmt.toFixed(2));
                $row.find('.row-sub-total').val(subTotal.toFixed(2));
                $row.find('.row-net-total').val(netTotal.toFixed(2));
            }

            function recalcSummary() {
                let gross = 0, totalRowDisc = 0, totalGstAmt = 0, sumRowSub = 0;
                let totalIncTax = 0, totalAdvTax = 0;
                let totalPieces = 0;
                let boxCount = 0, pieceCount = 0;

                $('#saleItems tr').each(function() {
                    const $r = $(this);
                    recalcRow($r);
                    
                    const price = num($r.find('.price').val());
                    const pack = parseFloat($r.find('.item_uom_factor').val()) || 1;
                    
                    let boxes = num($r.find('.quantity').val());
                    let loose = num($r.find('.loose_pieces').val());
                    let total_pieces = (boxes * pack) + loose;
                    
                    const discVal = num($r.find('.item_disc').val());
                    const discType = $r.find('.item-disc-type').val() || 'amount';

                    let billableQty = boxes + (pack > 0 ? (loose / pack) : 0);
                    let rowGross = Math.round((billableQty * price) * 100) / 100;
                    let rowDisc = (discType === 'percent') ? (Math.round((rowGross * discVal / 100) * 100) / 100) : discVal;
                    let sub = num($r.find('.row-sub-total').val());

                    gross += rowGross;
                    totalRowDisc += rowDisc;
                    sumRowSub += sub;
                    totalGstAmt += num($r.find('.gst-amount-row').val());
                    // WHT and Adv are now percentages — compute amounts from row subtotal
                    const rSub = num($r.find('.row-sub-total').val());
                    totalIncTax += rSub * (num($r.find('.inc-tax').val()) / 100);
                    totalAdvTax += rSub * (num($r.find('.adv-tax').val()) / 100);
                    totalPieces += total_pieces;
                    boxCount += boxes;
                    pieceCount += loose;
                });
                
                $('#summary_total_qty').text(totalPieces + ' Pcs');
                $('#gross_total').val(gross.toFixed(2));
                $('#total_row_disc').val(totalRowDisc.toFixed(2));
                $('#total_gst').val(totalGstAmt.toFixed(2));
                $('#total_inc_tax').val(totalIncTax.toFixed(2));
                $('#total_adv_tax').val(totalAdvTax.toFixed(2));

                const discVal = num($('#sum_discount').val());
                const discType = $('#sum_discount').closest('.input-group').find('.toggle-type').data('type') || 'amount';
                
                let billDisc = (discType === 'percent') ? (sumRowSub * discVal / 100) : discVal;
                let summarySub = sumRowSub - billDisc;
                $('#summary_sub_total').val(summarySub.toFixed(2));

                const sumFreight  = num($('#sum_freight').val());
                const sumExpense  = num($('#sum_expense').val());

                // Pakistan Standard:
                // Invoice Total = (summarySub + freight + expense) + GST
                // Net Payable = Invoice Total - WHT + Adv
                const gstBase     = summarySub + sumFreight + sumExpense;
                const invoiceTotal = gstBase + totalGstAmt;
                let finalNet       = invoiceTotal - totalIncTax + totalAdvTax;
                $('#invoice_total').val(invoiceTotal.toFixed(2));
                $('#final_net_total').val(finalNet.toFixed(2));
            }

            function addBlankRow() {
                const isSoMode = "{{ $sale->sale_status == 'booked' }}";
                let batchHtml = !isSoMode ? `
                    <td><select name="batch_id[]" class="form-select batch-select2 row-input" style="width:100%"><option value="">Auto (FEFO)</option></select></td>
                    <td><input type="text" name="lot_no[]" class="form-control text-center row-input lot-no-display" placeholder="Auto" readonly></td>
                ` : '';
                
                const newRow = `
                    <tr class="item-row">
                        <td>
                            <input type="hidden" name="product_id[]" class="item-id">
                            <input type="hidden" name="warehouse_id[]" class="item-warehouse" value="1">
                            <input type="text" name="item_code[]" class="form-control bg-transparent border-0 px-1 item-code text-muted font-monospace" placeholder="—" readonly style="font-size:11px;">
                        </td>
                        <td class="hs-code-col">
                            <div class="input-group input-group-sm" style="min-width: 130px;">
                                <input type="text" name="hs_code[]" class="form-control text-center hs-code item-hs-code" style="font-size:11px; padding:2px 4px; background:#fff;" placeholder="HS Code">
                                <button type="button" class="btn btn-outline-primary btn-quick-hs px-2" onclick="window.openQuickHsModalForBtn && window.openQuickHsModalForBtn(this)" title="Quick Update Product HS Code" style="padding: 2px 7px;">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>
                        </td>
                        <td style="font-weight:600;">
                            <input type="hidden" name="item_name[]" class="item-name">
                            <button type="button" class="product-select-btn">Select Product <span class="psm-btn-arrow">&#9660;</span></button>
                        </td>
                        <td><select name="pieces_per_box[]" class="form-select packing-select row-input"><option value="">Select</option></select>
                            <input type="hidden" name="packing_id[]" class="packing-id"><input type="hidden" name="uom_id[]" class="uom-id">
                            <input type="hidden" name="item_uom_factor[]" class="item_uom_factor" value="1"><input type="hidden" name="size_mode[]" class="size-mode" value="by_cartons"></td>
                        <td><input type="text" name="item_uom[]" list="uom_datalist" class="form-control text-center uom-input row-input" style="min-width:85px;" value="Piece" placeholder="UOM"></td>
                        <td><input type="number" name="pcs_per_box_display[]" class="form-control text-center item-uom" value="1" readonly style="width:60px;"></td>
                        <td><input type="number" name="qty[]" class="form-control quantity text-end fw-bold row-input" value="1"></td>
                        <td><input type="number" name="loose_pieces[]" class="form-control loose_pieces text-end row-input" value="0"></td>
                        <td><input type="number" name="free_loose_pieces[]" class="form-control free_loose_pieces text-end row-input" value="0"></td>
                        <td><input type="number" step="0.01" name="price[]" class="form-control price text-end row-input" value="0"></td>
                        <td><div class="input-group input-group-sm"><input type="hidden" name="item_disc_type[]" class="item-disc-type" value="percent"><input type="number" step="0.01" name="item_disc[]" class="form-control item_disc text-end row-input" value="0"><button class="btn btn-outline-info toggle-type" type="button" data-type="percent">%</button></div></td>
                        <td><input type="text" name="sub_total[]" class="form-control row-sub-total text-end" readonly></td>
                        <td><div class="input-group input-group-sm"><input type="number" step="0.01" name="gst[]" class="form-control gst text-end row-input" value="0"><span class="input-group-text">%</span></div><input type="hidden" name="gst_amount[]" class="gst-amount-row"></td>
                        <td><input type="number" step="0.01" name="inc_tax[]" class="form-control inc-tax text-end row-input" value="0"></td>
                        <td><input type="number" step="0.01" name="adv_tax[]" class="form-control adv-tax text-end row-input" value="0"></td>
                        <td><input type="text" name="total[]" class="form-control row-net-total input-highlight text-end" readonly></td>
                        ${batchHtml}
                        <td><input type="text" name="cost_per_pc[]" class="form-control row-cost-pc text-end" readonly></td>
                        <td class="text-center"><button type="button" class="btn-erp-danger-ghost remove-row"><i class="bi bi-x-circle-fill"></i></button></td>
                    </tr>`;
                $('#saleItems').append(newRow);
                const $inserted = $('#saleItems tr:last');
                recalcRow($inserted);
                return $inserted;
            }

            // ERP Product Modal Logic
            $(document).on('click', '.product-select-btn', function() {
                var $btn = $(this);
                var $row = $btn.closest('tr');

                ERPProductModal.open({
                    mode: 'single',
                    onSelect: function(products) {
                        products.forEach(function(p, idx) {
                            var $targetRow = (idx === 0) ? $row : addBlankRow();
                            populateRow($targetRow, p);
                        });
                    }
                });
            });

            function populateRow($row, data) {
                $row.find('.item-id').val(data.id);
                $row.find('.item-code').val(data.item_code);
                $row.find('.item-hs-code').val(data.hs_code || '');
                $row.find('.item-name').val(data.item_name);
                $row.find('.price').val(data.price || data.sale_price_per_piece || 0);
                $row.find('.size-mode').val(data.size_mode || 'by_cartons');
                let uomVal = (data.unit && data.unit.name) ? data.unit.name : (data.uom_name || 'Piece');
                $row.find('.uom-input').val(uomVal);

                // Update button UI
                var $btn = $row.find('.product-select-btn');
                var btnText = (data.item_name || 'Select Product') + '<br><small class="text-muted" style="font-size:0.7rem; font-weight:400;">' + (data.item_code || '') + '</small>';
                $btn.html(btnText + ' <span class="psm-btn-arrow">&#9660;</span>');
                $btn.addClass('has-value');

                // Packing dropdown logic
                var $pSelect = $row.find('.packing-select');
                if ($pSelect.length) {
                    $pSelect.empty();
                    let optionsHtml = '';
                    let seenFactors = {};

                    if (data.packings && data.packings.length > 0) {
                        data.packings.forEach(function(pkg) {
                            let f = parseInt(pkg.pieces_per_box) || 1;
                            if (f === 1) f = parseInt(data.uom || data.pieces_per_box) || 1;
                            if (seenFactors[f]) return; 
                            seenFactors[f] = true;
                            optionsHtml += `<option value="${pkg.id}" data-ppb="${f}" data-price="${pkg.sale_price || 0}">${pkg.name}</option>`;
                        });
                    } else {
                        let bPpb = parseInt(data.uom || data.pieces_per_box) || 1;
                        let bName = data.uom_name || 'Pcs';
                        if (!bName || bName.toLowerCase() === 'piece' || bName.toLowerCase() === 'pcs') {
                            bName = '1x' + bPpb;
                        }
                        optionsHtml = `<option value="" data-ppb="${bPpb}" data-price="${data.price || 0}">${bName} (Base)</option>`;
                    }
                    $pSelect.html(optionsHtml);

                    $pSelect.off('change').on('change', function() {
                        var $r = $(this).closest('tr');
                        var $opt = $(this).find('option:selected');
                        var factor = parseFloat($opt.data('ppb')) || 1;
                        var sPrice = parseFloat($opt.data('price')) || 0;
                        var pId    = $(this).val();
                        
                        $r.find('.item_uom_factor').val(factor);
                        $r.find('.item-uom').val(factor);   
                        $r.find('.packing-id').val(pId);
                        $r.find('.uom-id').val(pId);
                        
                        if (sPrice > 0) { $r.find('.price').val(sPrice.toFixed(2)); }
                        recalcRow($r);
                        recalcSummary();
                    });
                    $pSelect.trigger('change');
                }

                setTimeout(() => {
                    if (data.size_mode === 'by_piece') {
                        $row.find('.loose_pieces').focus().select();
                    } else {
                        $row.find('.quantity').focus().select();
                    }
                }, 100);
            }

            // Add Row button
            $('#btnAddRow').click(function() {
                addBlankRow();
            });

            $(document).on('click', '.remove-row', function() { $(this).closest('tr').remove(); recalcSummary(); });
            $(document).on('input', '.quantity, .loose_pieces, .free_loose_pieces, .price, .item_disc, .gst, .inc-tax, .adv-tax, #sum_discount, #sum_freight, #sum_expense', recalcSummary);

            $(document).on('click', '.toggle-type', function() {
                const $btn = $(this);
                const current = $btn.data('type') || 'amount', next = (current === 'amount' ? 'percent' : 'amount');
                $btn.data('type', next).text(next === 'percent' ? '%' : 'Rs');
                $btn.toggleClass('btn-outline-info', next === 'percent').toggleClass('btn-outline-secondary', next === 'amount');
                const $row = $btn.closest('tr');
                if ($row.length) { $row.find('.item-disc-type').val(next); recalcRow($row); } else { $('#sum_discount_type').val(next); }
                recalcSummary();
            });

            // HS Code Toggle Logic
            function toggleHsCodeFields() {
                const isEnabled = $('#enable_hs_code').is(':checked');
                if (isEnabled) {
                    $('.hs-code-col').show();
                } else {
                    $('.hs-code-col').hide();
                }
            }
            $('#enable_hs_code').on('change', toggleHsCodeFields);
            toggleHsCodeFields(); // Initial call

            $('#btnSaveOnly, #btnConfirm').click(function(e) {
                e.preventDefault();
                const isPost = $(this).attr('id') === 'btnConfirm';
                $('#action').val(isPost ? 'post' : 'save_only');

                if (isPost) {
                    Swal.fire({
                        title: 'Are you sure you want to post this sale?',
                        text: "This action will affect your inventory stock and this change is irreversible.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#059669',
                        confirmButtonText: 'Yes, Post it!'
                    }).then((result) => { if (result.isConfirmed) submitForm(); });
                } else {
                    submitForm();
                }
            });

            function submitForm() {
                const $btn = $('#action').val() === 'post' ? $('#btnConfirm') : $('#btnSaveOnly');
                const ogHtml = $btn.html();
                $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Processing...');

                $.ajax({
                    url: "{{ route('sales.store') }}",
                    method: "POST",
                    data: $('#saleForm').serialize(),
                    success: function(res) {
                        Swal.fire({ icon: 'success', title: 'Success!', text: 'Transaction updated.', timer: 1500, showConfirmButton: false })
                        .then(() => window.location.href = "{{ route('sale.receipt.index') }}");
                    },
                    error: function(xhr) {
                        $btn.prop('disabled', false).html(ogHtml);
                        Swal.fire('Error', xhr.responseJSON?.message || 'Update failed', 'error');
                    }
                });
            }

            $('#btnPostToFbr').click(function(e) {
                e.preventDefault();
                const saleId = $(this).attr('data-sale-id');
                if (window.FbrPostManager && saleId) {
                    window.FbrPostManager.open(saleId);
                }
            });

            $(document).on('fbr:posted', function(e, data) {
                $('#btnPostToFbr')
                    .prop('disabled', true)
                    .addClass('is-posted')
                    .html('<i class="bi bi-check-circle-fill text-success me-1"></i> FBR Posted (' + data.fbrInvoiceNo + ')');
            });

            // --- Import Logic ---
            function importBookedItem(btn) {
                let $btn = $(btn);
                let items = $btn.data('items');
                if (typeof items === 'string') { try { items = JSON.parse(items); } catch (e) { items = []; } }
                if (!items || !items.length) return;

                // Set Header Data
                if ($btn.data('customer-id')) $('#customer_id').val($btn.data('customer-id')).trigger('change');
                if ($btn.data('employee')) $('#sales_officer_id').val($btn.data('employee')).trigger('change');
                
                // Clear existing table and import items
                $('#saleItems').empty();
                items.forEach(function(item) {
                    $('#btnAddRow').click();
                    let $row = $('#saleItems tr:last');
                    $row.find('.item-id').val(item.product_id);
                    $row.find('.item-code').val(item.item_code);
                    $row.find('.item-name').val(item.product_name);
                    
                    let newOption = new Option(item.product_name, item.product_id, true, true);
                    $row.find('.product-select2').append(newOption).trigger('change');
                    
                    let ppb = parseInt(item.ppb) || 1;
                    let totalPieces = parseInt(item.total_pieces) || 0;
                    let boxes = Math.floor(totalPieces / ppb);
                    let pcs = totalPieces % ppb;

                    $row.find('.quantity').val(boxes);
                    $row.find('.loose_pieces').val(pcs);
                    $row.find('.price').val(item.price);
                    recalcRow($row);
                });
                recalcSummary();
            }

            $('.btn-import-single').on('click', function() {
                if (window.ERPImportLoader) window.ERPImportLoader.start();
                importBookedItem(this);
                $('#bookedProductsModal').modal('hide');
                if (window.ERPImportLoader) window.ERPImportLoader.success();
            });

            // --- Customer & Officer Selection Handlers ---
            $(document).on('click', '.btn-select-customer', function() {
                let id = $(this).data('id');
                let name = $(this).data('name');
                $('#customer_id').val(id).trigger('change');
                $('#customer_name_display').val(name);
                $('#customerModal').modal('hide');

                // Filter booked products if any
                if (id) {
                    $('.booked-item-row').each(function() {
                        let rowCustId = $(this).find('.btn-import-single').attr('data-customer-id') || $(this).data('customer-id');
                        if (!rowCustId || rowCustId == id) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                } else {
                    $('.booked-item-row').show();
                }
            });

            $(document).on('click', '.btn-select-officer', function() {
                let id = $(this).data('id');
                let name = $(this).data('name');
                $('#sales_officer_id').val(id).trigger('change');
                $('#sales_officer_display').val(name);
                $('#officerModal').modal('hide');
            });

            // Quick Customer Box Toggle
            $('#btnToggleQuickCustomer').on('click', function() {
                $('#quickCustomerBox').slideToggle();
                $('#qcAlert').addClass('d-none').text('');
            });
            $('#btnCancelQuickCustomer, #btnCloseQuickCustomer').on('click', function() {
                $('#quickCustomerBox').slideUp();
                $('#qcAlert').addClass('d-none').text('');
            });

            // Quick Customer AJAX Form Submit
            $('#quickCustomerForm').on('submit', function(e) {
                e.preventDefault();
                let $btn = $('#btnSaveQuickCustomer');
                let $spinner = $('#qcSpinner');
                let $alert = $('#qcAlert');

                $btn.prop('disabled', true);
                $spinner.removeClass('d-none');
                $alert.addClass('d-none').text('');

                $.ajax({
                    url: '{{ route("customers.store") }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Accept': 'application/json'
                    },
                    success: function(response) {
                        $btn.prop('disabled', false);
                        $spinner.addClass('d-none');

                        if (response && response.success && response.customer) {
                            let c = response.customer;
                            let searchStr = ((c.customer_id || '') + ' ' + (c.customer_name || '') + ' ' + (c.business_name || '')).toLowerCase();
                            let newRow = `
                                <tr class="customer-item-row" data-search="${searchStr}">
                                    <td><span class="badge bg-light text-dark border">${c.customer_id || 'N/A'}</span></td>
                                    <td><strong>${c.customer_name}</strong></td>
                                    <td>${c.business_name || '-'}</td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-primary btn-sm rounded-pill px-4 btn-select-customer" 
                                            data-id="${c.id}" 
                                            data-name="${c.customer_name}">
                                            Select
                                        </button>
                                    </td>
                                </tr>
                            `;
                            $('#customerTableBody').prepend(newRow);

                            // Auto select newly created customer
                            $('#customer_id').val(c.id).trigger('change');
                            $('#customer_name_display').val(c.customer_name);

                            // Reset and hide form
                            $('#quickCustomerForm')[0].reset();
                            $('#quickCustomerBox').hide();

                            // Hide modal
                            $('#customerModal').modal('hide');

                            if (window.toastr) {
                                toastr.success('Customer added and selected successfully!');
                            }
                        } else {
                            $alert.removeClass('d-none').text('Customer could not be added.');
                        }
                    },
                    error: function(xhr) {
                        $btn.prop('disabled', false);
                        $spinner.addClass('d-none');
                        let msg = 'Failed to create customer.';
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            msg = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            msg = xhr.responseJSON.message;
                        }
                        $alert.removeClass('d-none').html(msg);
                    }
                });
            });

            // Search Logic for Modals
            $('#searchCustomer').on('input', function() {
                let v = $(this).val().toLowerCase();
                $('.customer-item-row').each(function() { $(this).toggle($(this).attr('data-search').includes(v)); });
            });
            $('#searchOfficer').on('input', function() {
                let v = $(this).val().toLowerCase();
                $('.officer-item-row').each(function() { $(this).toggle($(this).attr('data-search').includes(v)); });
            });
            $('#searchBookedProducts').on('input', function() {
                let v = $(this).val().toLowerCase();
                $('.booked-item-row').each(function() { $(this).toggle($(this).attr('data-search').includes(v)); });
            });

            // Initial recalcs
            recalcSummary();
        });
    </script>
@endsection
