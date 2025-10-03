@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto p-4" x-data="quotationForm()" x-init="init()">
    <h1 class="text-2xl font-semibold mb-4">New Quotation</h1>

    <form method="POST" action="{{ route('admin.quotations.store') }}" @submit="prepare()">
        @csrf

        <div class="bg-white shadow rounded p-4 mb-6">
            <h2 class="font-semibold text-lg mb-3">Customer Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Company Name</label>
                    <select name="customer_id" class="w-full border rounded p-2">
                        <option value="">Select Company</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->company_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Quotation No</label>
                    <input class="w-full border rounded p-2" name="quotation_no" value="{{ $nextNumber }}" />
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Date</label>
                    <input class="w-full border rounded p-2" type="date" name="quotation_date" value="{{ now()->toDateString() }}" />
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded p-4 mb-6">
            <h2 class="font-semibold text-lg mb-3">Product Details</h2>
            <div class="overflow-auto">
                <table class="min-w-full border">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-2 py-1">Product</th>
                            <th class="px-2 py-1">GST(%)</th>
                            <th class="px-2 py-1">Price</th>
                            <th class="px-2 py-1">Qty</th>
                            <th class="px-2 py-1">Disc. Type</th>
                            <th class="px-2 py-1">Discount</th>
                            <th class="px-2 py-1">Make</th>
                            <th class="px-2 py-1">Guarantee</th>
                            <th class="px-2 py-1">Amount</th>
                            <th class="px-2 py-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(item, index) in items" :key="index">
                            <tr>
                                <td class="border px-2 py-1">
                                    <select class="w-full border rounded p-1" x-model.number="item.product_id" @change="autofillProduct(index)">
                                        <option value="">Select Product</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" :name="`items[${index}][product_id]`" :value="item.product_id">
                                    <input class="mt-1 w-full border rounded p-1" placeholder="Product name" x-model="item.product_name" :name="`items[${index}][product_name]`" />
                                    <textarea class="mt-1 w-full border rounded p-1" placeholder="Description" x-model="item.description" :name="`items[${index}][description]`"></textarea>
                                    <div class="grid grid-cols-3 gap-1 mt-1">
                                        <input class="border rounded p-1" placeholder="Code" x-model="item.product_code" :name="`items[${index}][product_code]`" />
                                        <input class="border rounded p-1" placeholder="HSN/SAC" x-model="item.hsn_sac_code" :name="`items[${index}][hsn_sac_code]`" />
                                        <input class="border rounded p-1" placeholder="Make" x-model="item.make" :name="`items[${index}][make]`" />
                                    </div>
                                </td>
                                <td class="border px-2 py-1">
                                    <input class="w-24 border rounded p-1 text-right" type="number" step="0.01" x-model.number="item.gst_percent" :name="`items[${index}][gst_percent]`" @input="recalc(index)" />
                                </td>
                                <td class="border px-2 py-1">
                                    <input class="w-24 border rounded p-1 text-right" type="number" step="0.01" x-model.number="item.price" :name="`items[${index}][price]`" @input="recalc(index)" />
                                </td>
                                <td class="border px-2 py-1">
                                    <input class="w-20 border rounded p-1 text-right" type="number" step="0.01" x-model.number="item.quantity" :name="`items[${index}][quantity]`" @input="recalc(index)" />
                                </td>
                                <td class="border px-2 py-1">
                                    <select class="w-28 border rounded p-1" x-model="item.discount_type" :name="`items[${index}][discount_type]`" @change="recalc(index)">
                                        <option value="percent">Per(%)</option>
                                        <option value="amount">Amount</option>
                                    </select>
                                </td>
                                <td class="border px-2 py-1">
                                    <input class="w-24 border rounded p-1 text-right" type="number" step="0.01" x-model.number="item.discount_value" :name="`items[${index}][discount_value]`" @input="recalc(index)" />
                                </td>
                                <td class="border px-2 py-1">
                                    <input class="w-28 border rounded p-1" x-model="item.make" :name="`items[${index}][make]`" />
                                </td>
                                <td class="border px-2 py-1">
                                    <input class="w-32 border rounded p-1" x-model="item.guarantee" :name="`items[${index}][guarantee]`" placeholder="Guarantee" />
                                </td>
                                <td class="border px-2 py-1 text-right">
                                    <input class="w-28 border rounded p-1 text-right" type="number" step="0.01" x-model.number="item.amount" :name="`items[${index}][amount]`" readonly />
                                </td>
                                <td class="border px-2 py-1 text-center">
                                    <button type="button" class="text-red-600" @click="removeRow(index)">Remove</button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                <button type="button" class="bg-gray-200 px-3 py-1 rounded" @click="addRow()">Add Product</button>
            </div>
        </div>

        <div class="bg-white shadow rounded p-4 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div></div><div></div>
                <div class="space-y-2">
                    <div class="flex justify-between"><span>Sub Total:</span><span x-text="subtotal().toFixed(2)"></span></div>
                    <div class="flex justify-between"><span>Total Discount:</span><span x-text="totalDiscount().toFixed(2)"></span></div>
                    <div class="flex justify-between"><span>Total GST:</span><span x-text="totalGst().toFixed(2)"></span></div>
                    <div class="flex justify-between font-semibold text-lg"><span>Total Amount:</span><span x-text="grandTotal().toFixed(2)"></span></div>
                </div>
            </div>
            <input type="hidden" name="currency" value="INR" />
        </div>

        <div class="flex justify-end">
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Save Quotation</button>
        </div>
    </form>
</div>

<script>
function quotationForm() {
    return {
        items: [defaultItem()],
        init() { this.items.forEach((_, i) => this.recalc(i)); },
        addRow() { this.items.push(defaultItem()); },
        removeRow(i) { this.items.splice(i, 1); },
        recalc(i) {
            const it = this.items[i];
            const line = (Number(it.price||0) * Number(it.quantity||0));
            const discount = it.discount_type === 'amount' ? Number(it.discount_value||0) : line * (Number(it.discount_value||0)/100);
            const base = Math.max(0, line - discount);
            const gst = base * (Number(it.gst_percent||0)/100);
            it.amount = base + gst;
        },
        subtotal() { return this.items.reduce((s,i)=> s + (Number(i.price||0)*Number(i.quantity||0)), 0); },
        totalDiscount() {
            return this.items.reduce((s,i)=>{
                const line = (Number(i.price||0) * Number(i.quantity||0));
                const discount = i.discount_type === 'amount' ? Number(i.discount_value||0) : line * (Number(i.discount_value||0)/100);
                return s + discount; }, 0);
        },
        totalGst() {
            return this.items.reduce((s,i)=>{
                const line = (Number(i.price||0) * Number(i.quantity||0));
                const discount = i.discount_type === 'amount' ? Number(i.discount_value||0) : line * (Number(i.discount_value||0)/100);
                const base = Math.max(0, line - discount);
                return s + base * (Number(i.gst_percent||0)/100); }, 0);
        },
        grandTotal() { return this.items.reduce((s,i)=> s + Number(i.amount||0), 0); },
        prepare() { /* amounts already bound via inputs */ },
        autofillProduct(i) { /* optional AJAX hook later */ },
    };
    function defaultItem() {
        return { product_id: '', product_name: '', description:'', product_code:'', hsn_sac_code:'', make:'', guarantee:'', gst_percent: 0, price: 0, quantity: 1, discount_type:'percent', discount_value: 0, amount: 0 };
    }
}
</script>
@endsection

