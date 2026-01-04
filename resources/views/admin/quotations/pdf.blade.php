<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Quotation {{ $quotation->quotation_no }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12px;
            line-height: 1.4;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }

        .company-info {
            flex: 1;
        }

        .company-info h1 {
            margin: 0;
            color: #333;
            font-size: 24px;
        }

        .company-info p {
            margin: 5px 0;
            color: #666;
        }

        .quotation-info {
            text-align: right;
            flex: 1;
        }

        .quotation-info h2 {
            margin: 0 0 10px 0;
            font-size: 20px;
            color: #333;
        }

        .quotation-info p {
            margin: 3px 0;
            color: #666;
        }

        .customer-section {
            margin-bottom: 30px;
        }

        .customer-section h3 {
            margin: 0 0 10px 0;
            font-size: 14px;
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }

        .customer-details {
            display: flex;
            justify-content: space-between;
        }

        .bill-to,
        .ship-to {
            flex: 1;
            margin-right: 20px;
        }

        .bill-to h4,
        .ship-to h4 {
            margin: 0 0 5px 0;
            font-size: 12px;
            font-weight: bold;
            color: #333;
        }

        .bill-to p,
        .ship-to p {
            margin: 2px 0;
            color: #666;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .items-table th {
            background-color: #f5f5f5;
            font-weight: bold;
            font-size: 11px;
        }

        .items-table td {
            font-size: 11px;
        }

        .items-table .text-right {
            text-align: right;
        }

        .items-table .text-center {
            text-align: center;
        }

        .totals-section {
            margin-top: 20px;
            margin-left: auto;
            width: 300px;
        }

        .totals-table {
            width: 100%;
            border-collapse: collapse;
        }

        .totals-table td {
            padding: 5px;
            border: none;
        }

        .totals-table .label {
            text-align: right;
            font-weight: bold;
            padding-right: 10px;
        }

        .totals-table .amount {
            text-align: right;
            width: 100px;
        }

        .grand-total {
            border-top: 2px solid #333 !important;
            font-weight: bold;
            font-size: 14px;
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            color: #666;
            font-size: 10px;
        }

        .terms-section {
            margin-top: 30px;
        }

        .terms-section h3 {
            margin: 0 0 10px 0;
            font-size: 14px;
            color: #333;
        }

        .terms-section p {
            margin: 5px 0;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="company-info">
            <h1>{{ app(\App\Settings\GeneralSettings::class)->site_name }}</h1>
            <p>{{ app(\App\Settings\GeneralSettings::class)->address }}</p>
            <p>Phone: {{ app(\App\Settings\GeneralSettings::class)->contact_phone }}</p>
            <p>Email: {{ app(\App\Settings\GeneralSettings::class)->contact_email }}</p>
            <p>Website: {{ env('APP_URL') }}</p>
        </div>
        <div class="quotation-info">
            <h2>QUOTATION</h2>
            <p><strong>Quotation No:</strong> {{ $quotation->quotation_no }}</p>
            <p><strong>Date:</strong> {{ $quotation->quotation_date->format('d M Y') }}</p>
            <p><strong>Currency:</strong> {{ $quotation->currency }}</p>
            {{-- @if ($quotation->make)
                <p><strong>Make:</strong> {{ $quotation->make }}</p>
            @endif --}}
        </div>
    </div>

    <div class="customer-section">
        {{-- <h3>Customer Information</h3> --}}
        <div class="customer-details">
            <div class="bill-to">
                <h4>Proposed To:</h4>
                <p><strong>{{ $quotation->customer_name ?? ($quotation->customer->company_name ?? 'N/A') }}</strong>
                </p>
                @if ($quotation->customer_email)
                    <p>Email: {{ $quotation->customer_email }}</p>
                @endif
                @if ($quotation->customer_gst_no)
                    <p>GST No: {{ $quotation->customer_gst_no }}</p>
                @endif
                @if ($quotation->customer_street)
                    <p>{{ $quotation->customer_street }}</p>
                @endif
                @if ($quotation->customer_city || $quotation->customer_state || $quotation->customer_zip)
                    <p>{{ $quotation->customer_city }}{{ $quotation->customer_city && $quotation->customer_state ? ', ' : '' }}{{ $quotation->customer_state }}
                        {{ $quotation->customer_zip }}</p>
                @endif
                @if ($quotation->customer_country)
                    <p>{{ $quotation->customer_country }}</p>
                @endif
            </div>
            {{-- <div class="ship-to">
                <h4>Ship To:</h4>
                <p><strong>{{ $quotation->customer_name ?? ($quotation->customer->company_name ?? 'N/A') }}</strong></p>
                @if ($quotation->customer_street)
                <p>{{ $quotation->customer_street }}</p>
                @endif
                @if ($quotation->customer_city || $quotation->customer_state || $quotation->customer_zip)
                <p>{{ $quotation->customer_city }}{{ $quotation->customer_city && $quotation->customer_state ? ', ' : '' }}{{ $quotation->customer_state }} {{ $quotation->customer_zip }}</p>
                @endif
                @if ($quotation->customer_country)
                <p>{{ $quotation->customer_country }}</p>
                @endif
            </div> --}}
        </div>
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 35%;">Product Description</th>
                <th style="width: 10%;">GST%</th>
                <th style="width: 10%;">Price</th>
                <th style="width: 8%;">Qty</th>
                <th style="width: 12%;">Discount</th>
                <th style="width: 10%;">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quotation->items as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $item->product_name ?? ($item->product->name ?? '-') }}</strong>
                        @php $brandName = $item->product?->brand?->name; @endphp
                        @if ($brandName)
                            <br><small>{{ $brandName }}</small>
                        @endif
                        @if ($item->description)
                            <br><small>{{ $item->description }}</small>
                        @endif
                        @if ($item->product_code || $item->guarantee)
                            <br><small>
                                @if ($item->product_code)
                                    Code: {{ $item->product_code }}
                                @endif
                                @if ($item->product_code && $item->guarantee)
                                    |
                                @endif
                                @if ($item->guarantee)
                                    Guarantee: {{ $item->guarantee }}
                                @endif
                            </small>
                        @endif
                    </td>
                    <td class="text-center">{{ number_format($item->gst_percent, 2) }}</td>
                    <td class="text-right">{{ number_format($item->price, 2) }}</td>
                    <td class="text-center">{{ number_format($item->quantity, 2) }}</td>
                    <td class="text-right">
                        @if ($item->discount_value > 0)
                            {{ $item->discount_type === 'percent' ? number_format($item->discount_value, 2) . '%' : number_format($item->discount_value, 2) }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-right">{{ number_format($item->amount, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals-section">
        <table class="totals-table">
            <tr>
                <td class="label">Sub Total:</td>
                <td class="amount">{{ number_format($quotation->subtotal, 2) }}</td>
            </tr>
            <tr>
                <td class="label">Total Discount:</td>
                <td class="amount">{{ number_format($quotation->total_discount, 2) }}</td>
            </tr>
            <tr>
                <td class="label">Total GST:</td>
                <td class="amount">{{ number_format($quotation->total_gst, 2) }}</td>
            </tr>
            <tr class="grand-total">
                <td class="label">Grand Total:</td>
                <td class="amount">{{ number_format($quotation->grand_total, 2) }}</td>
            </tr>
        </table>
    </div>

    <div class="terms-section">
        <h3>Terms & Conditions</h3>
        @php
            $selectedTerms = $quotation->selected_terms_and_conditions ?? [];
            $settings = app(\App\Settings\GeneralSettings::class);
            $availableTerms = $settings->terms_and_conditions ?? [];
            
            // If no specific terms were selected, show all available terms as default
            if (empty($selectedTerms)) {
                $selectedTerms = $availableTerms;
            }
        @endphp
        @if(!empty($selectedTerms))
            @foreach($selectedTerms as $index => $term)
                @if(!empty(trim($term)))
                    <p>{{ $index + 1 }}. {{ $term }}</p>
                @endif
            @endforeach
        @else
            <p><em>No terms and conditions specified.</em></p>
        @endif
    </div>

    <div class="footer">
        <p>Thank you for your business!</p>
        <p>For any queries, please contact us at {{ app(\App\Settings\GeneralSettings::class)->contact_email }} or call {{ app(\App\Settings\GeneralSettings::class)->contact_phone }}</p>
    </div>
</body>

</html>
