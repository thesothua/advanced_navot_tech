@extends('admin.layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">New Quotation</h1>
        <a href="{{ route('admin.quotations.index') }}" class="btn btn-sm btn-danger">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <form method="POST" action="{{ route('admin.quotations.store') }}" id="quotation-form">
        @csrf

        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Customer Details</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6 position-relative">
                        <label class="form-label">Company</label>
                        <input type="text" class="form-control" id="customer-autocomplete" placeholder="Type customer/company name">
                        <input type="hidden" name="customer_id" id="customer-id">
                        <div class="list-group position-absolute w-100 d-none" id="customer-suggestions" style="z-index: 1050; max-height: 240px; overflow:auto;"></div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Quotation No.</label>
                        <input type="text" class="form-control" name="quotation_no" value="{{ $nextNumber }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Date</label>
                        <input class="form-control" type="date" name="quotation_date" value="{{ now()->toDateString() }}" />
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Currency</label>
                        <input class="form-control" name="currency" value="INR" />
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-4">
                        <label class="form-label">Customer Name (as on quotation)</label>
                        <input type="text" class="form-control" name="customer_name" id="customer-name-manual" placeholder="Type customer name">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" name="customer_email" id="customer-email">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">GST No</label>
                        <input type="text" class="form-control" name="customer_gst_no" id="customer-gst" >
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <label class="form-label">Street</label>
                        <input type="text" class="form-control" name="customer_street" id="addr-street" >
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">City</label>
                        <input type="text" class="form-control" name="customer_city" id="addr-city" >
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">State</label>
                        <input type="text" class="form-control" name="customer_state" id="addr-state" >
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Zip</label>
                        <input type="text" class="form-control" name="customer_zip" id="addr-zip" >
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Country</label>
                        <input type="text" class="form-control" name="customer_country" id="addr-country" >
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0">Product Details</h5>
                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-sm btn-outline-primary" id="add-row-btn">
                        <i class="fas fa-plus"></i> Add Product
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle mb-0" id="items-table">
                        <thead>
                            <tr>
                                <th style="min-width: 260px;">Product</th>
                                <th>GST(%)</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Disc. Type</th>
                                <th>Discount</th>
                                {{-- <th>Guarantee</th> --}}
                                <th class="text-end">Amount</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <div class="d-flex justify-content-between mb-2"><span>Sub Total:</span><span id="subtotal">0.00</span></div>
                        <div class="d-flex justify-content-between mb-2"><span>Total Discount:</span><span id="total-discount">0.00</span></div>
                        <div class="d-flex justify-content-between mb-2"><span>Total GST:</span><span id="total-gst">0.00</span></div>
                        <div class="d-flex justify-content-between fs-5 fw-semibold"><span>Total Amount:</span><span id="grand-total">0.00</span></div>
                    </div>
                </div>
                <input type="hidden" name="currency" value="INR" />
            </div>
        </div>

        <!-- Terms and Conditions Section -->
        @if(!empty($availableTerms))
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Terms & Conditions</h5>
                <small class="text-muted">Select the terms and conditions that apply to this quotation</small>
            </div>
            <div class="card-body">
                @foreach($availableTerms as $index => $term)
                    @if(!empty(trim($term)))
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" 
                               name="selected_terms_and_conditions[]" 
                               value="{{ $term }}" 
                               id="term_{{ $index }}">
                        <label class="form-check-label" for="term_{{ $index }}">
                            {{ $index + 1 }}. {{ $term }}
                        </label>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
        @endif

        <div class="text-end mx-4">
            <button class="btn btn-danger">
                <i class="fas fa-save"></i> Save Quotation
            </button>
        </div>
    </form>

    <template id="row-template">
        <tr>
            <td>
                <label class="form-label">Product</label>
                <select class="form-select product-select" name="__REPLACE__[product_id]">
                    <option value="">Select Product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
                {{-- <label class="form-label mt-2">Product Name</label>
                <input class="form-control product-name" placeholder="Product name" name="__REPLACE__[product_name]" /> --}}
                <label class="form-label mt-2">Brand</label>
                <input class="form-control brand" name="__REPLACE__[brand]" placeholder="Brand" />
                <div class="row g-2 mt-2">
                    <div class="col-md-6">
                        <label class="form-label">Product Code</label>
                        <input class="form-control product-code" placeholder="Code" name="__REPLACE__[product_code]" />
                    </div>
                    {{-- <div class="col-md-6">
                        <label class="form-label">Guarantee</label>
                        <input class="form-control guarantee" name="__REPLACE__[guarantee]" placeholder="Guarantee" />
                    </div> --}}
                </div>
                <label class="form-label mt-2">Description</label>
                <textarea class="form-control description" placeholder="Description" name="__REPLACE__[description]"></textarea>
            </td>
            <td><input class="form-control text-end gst-percent" type="number" step="0.01" name="__REPLACE__[gst_percent]" value="0" /></td>
            <td><input class="form-control text-end price" type="number" step="0.01" name="__REPLACE__[price]" value="0" /></td>
            <td><input class="form-control text-end quantity" type="number" step="1" name="__REPLACE__[quantity]" value="1" /></td>
            <td>
                <select class="form-select discount-type" name="__REPLACE__[discount_type]">
                    <option value="percent">Per(%)</option>
                    <option value="amount">Amount</option>
                </select>
            </td>
            <td><input class="form-control text-end discount-value" type="number" step="0.01" name="__REPLACE__[discount_value]" value="0" /></td>
            <td class="text-end"><input class="form-control text-end amount" type="number" step="0.01" name="__REPLACE__[amount]" value="0" readonly /></td>
            <td class="text-center"><button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="fas fa-trash"></i></button></td>
        </tr>
    </template>

    <script>
    // Customer autocomplete and details autofill
    (function(){
        const input = document.getElementById('customer-autocomplete');
        const list = document.getElementById('customer-suggestions');
        const hiddenId = document.getElementById('customer-id');
        const emailEl = document.getElementById('customer-email');
        const gstEl = document.getElementById('customer-gst');
        const addr = {
            street: document.getElementById('addr-street'),
            city: document.getElementById('addr-city'),
            state: document.getElementById('addr-state'),
            zip: document.getElementById('addr-zip'),
            country: document.getElementById('addr-country'),
        };

        function clearDetails(){
            hiddenId.value = '';
            emailEl.value = '';
            gstEl.value = '';
            Object.values(addr).forEach(el => el.value = '');
        }

        function hideList(){ list.classList.add('d-none'); list.innerHTML = ''; }

        function fetchSuggestions(q){
            if(!q || q.length < 2){ hideList(); return; }
            fetch(`{{ route('admin.quotations.customersAutocomplete') }}?q=${encodeURIComponent(q)}`)
                .then(r => r.json())
                .then(names => {
                    if(!Array.isArray(names) || names.length === 0){ hideList(); return; }
                    list.innerHTML = '';
                    names.forEach(name => {
                        const a = document.createElement('a');
                        a.href = '#'; a.className = 'list-group-item list-group-item-action';
                        a.textContent = name;
                        a.addEventListener('click', (e)=>{ e.preventDefault(); selectCompany(name); });
                        list.appendChild(a);
                    });
                    list.classList.remove('d-none');
                })
                .catch(()=> hideList());
        }

        function selectCompany(name){
            input.value = name; hideList();
            fetch(`{{ route('admin.quotations.getCustomerDetails') }}?company=${encodeURIComponent(name)}`)
                .then(r => r.json())
                .then(data => {
                    if(!data || !data.id){ clearDetails(); return; }
                    hiddenId.value = data.id;
                    emailEl.value = data.email || '';
                    gstEl.value = data.gst_no || '';
                    addr.street.value = (data.address && data.address.street) || '';
                    addr.city.value = (data.address && data.address.city) || '';
                    addr.state.value = (data.address && data.address.state) || '';
                    addr.zip.value = (data.address && data.address.zip) || '';
                    addr.country.value = (data.address && data.address.country) || '';
                })
                .catch(()=> clearDetails());
        }

        let debounce;
        input.addEventListener('input', function(){
            clearTimeout(debounce);
            const q = this.value.trim();
            debounce = setTimeout(()=> fetchSuggestions(q), 200);
            clearDetails();
        });
        document.addEventListener('click', function(e){ if(!list.contains(e.target) && e.target !== input){ hideList(); }});
    })();

    (function(){
        const itemsBody = document.querySelector('#items-table tbody');
        const addBtn = document.getElementById('add-row-btn');
        const rowTpl = document.getElementById('row-template');
        let rowIndex = 0;

        function nameFor(idx, field){ return `items[${idx}][${field}]`; }

        function parseNum(v){ const n = parseFloat(v); return isNaN(n) ? 0 : n; }

        function recalcRow(tr){
            const price = parseNum(tr.querySelector('.price').value);
            const qty = parseNum(tr.querySelector('.quantity').value);
            const discType = tr.querySelector('.discount-type').value;
            const discVal = parseNum(tr.querySelector('.discount-value').value);
            const gstPct = parseNum(tr.querySelector('.gst-percent').value);

            const line = price * qty;
            const discount = discType === 'amount' ? discVal : line * (discVal/100);
            const base = Math.max(0, line - discount);
            const gst = base * (gstPct/100);
            const amount = base + gst;
            tr.querySelector('.amount').value = amount.toFixed(2);
        }

        function recalcTotals(){
            let subtotal = 0, totalDiscount = 0, totalGst = 0, grand = 0;
            itemsBody.querySelectorAll('tr').forEach(tr => {
                const price = parseNum(tr.querySelector('.price').value);
                const qty = parseNum(tr.querySelector('.quantity').value);
                const discType = tr.querySelector('.discount-type').value;
                const discVal = parseNum(tr.querySelector('.discount-value').value);
                const gstPct = parseNum(tr.querySelector('.gst-percent').value);

                const line = price * qty; subtotal += line;
                const discount = discType === 'amount' ? discVal : line * (discVal/100); totalDiscount += discount;
                const base = Math.max(0, line - discount);
                const gst = base * (gstPct/100); totalGst += gst;
                const amount = base + gst; grand += amount;
            });
            document.getElementById('subtotal').textContent = subtotal.toFixed(2);
            document.getElementById('total-discount').textContent = totalDiscount.toFixed(2);
            document.getElementById('total-gst').textContent = totalGst.toFixed(2);
            document.getElementById('grand-total').textContent = grand.toFixed(2);
        }


        function wireRow(tr){
            ['price','quantity','discount-type','discount-value','gst-percent'].forEach(cls => {
                tr.querySelectorAll('.' + cls).forEach(el => {
                    el.addEventListener('input', () => { recalcRow(tr); recalcTotals(); });
                    el.addEventListener('change', () => { recalcRow(tr); recalcTotals(); });
                });
            });
            // Product change -> autofill product details
            const prodSel = tr.querySelector('.product-select');
            prodSel.addEventListener('change', () => {
                const val = prodSel.value;
                if(!val){ return; }
                fetch(`{{ route('admin.quotations.product', ['product' => '__ID__']) }}`.replace('__ID__', val))
                    .then(r=>r.json())
                    .then(data => {
                        const codeEl = tr.querySelector('.product-code');
                        const brandEl = tr.querySelector('.brand');
                        const descEl = tr.querySelector('.description');
                        const priceEl = tr.querySelector('.price');

                        if (codeEl) codeEl.value = data.sku || '';
                        if (brandEl) brandEl.value = data.brand || '';
                        if (descEl && !descEl.value) descEl.value = data.description || '';
                        if (priceEl && parseFloat(priceEl.value || '0') === 0) priceEl.value = (data.price ?? 0);
                        recalcRow(tr); recalcTotals();
                    });
            });
            tr.querySelector('.remove-row').addEventListener('click', () => {
                tr.remove();
                recalcTotals();
            });
        }

        function addRow(){
            const frag = rowTpl.content.cloneNode(true);
            const tr = frag.querySelector('tr');
            // replace input names with concrete index
            tr.querySelectorAll('[name^="__REPLACE__"]').forEach(el => {
                const field = el.getAttribute('name').match(/__REPLACE__\[(.*)\]/)[1];
                el.setAttribute('name', nameFor(rowIndex, field));
            });
            itemsBody.appendChild(frag);
            const inserted = itemsBody.querySelectorAll('tr')[itemsBody.querySelectorAll('tr').length - 1];
            wireRow(inserted);
            recalcRow(inserted);
            recalcTotals();
            rowIndex++;
        }

        addBtn.addEventListener('click', addRow);
        // initial row
        addRow();
    })();
    </script>
@endsection
