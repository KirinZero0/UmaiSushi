@extends('layouts.admin')

@section('title', 'Laporan Barang Masuk')

@section('css')

@endsection

@section('js')
<script>
    const productTypeSelect = document.getElementById('product_type_select');
        const productTypeView = document.getElementById('product_type_view');

        productTypeSelect.addEventListener("change", (e) => {
            productTypeView.innerHTML = e.srcElement.options[e.srcElement.selectedIndex].text;
        });
</script>
@endsection

@section('content')

    <x-content>
        <x-slot name="modul">
            <h1>Laporan Barang Masuk</h1>
        </x-slot>

        <x-section>
            <x-slot name="title">
            </x-slot>

            <x-slot name="header">
                <h4>Laporan Barang Masuk</h4>
                <div class="card-header-form row">
                    <div>
                        <form>
                            <div class="input-group">
                                <select type="text" class="form-control" name="status" id="product_type_select" required
                                        onchange="this.form.submit()">
                                    <option value="">Pilih Status</option>
                                    <option @if(request()->get('status') == \App\Models\Product::PENDING) selected @endif value="{{ \App\Models\Product::PENDING }}">Barang Menunggu</option>
                                    <option @if(request()->get('status') == \App\Models\Product::REJECTED) selected @endif value="{{ \App\Models\Product::REJECTED }}">Barang Ditolak</option>
                                    <option @if(request()->get('status') == \App\Models\Product::APPROVED) selected @endif value="{{ \App\Models\Product::APPROVED }}">Barang Diterima</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div>
                        <form>
                            <div class="input-group">
                                <select type="text" name="month" id="month" class="form-control"
                                        onchange="this.form.submit()">
                                    <option value="">Pilih Bulan</option>
                                    @foreach($months as $key => $month)
                                        <option @if($key + 1 == request()->get('month')) selected
                                                @endif value="{{ $key + 1 }}">{{ $month }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="ml-2">
                        <a href="{{ route('admin.laporan.masuk.export') }}" class="btn btn-primary">
                            Export Data <i class="fas fa-download"></i>
                        </a>
                    </div>
                </div>
            </x-slot>

            <x-slot name="body">
                <div class="table-responsive">
                    <table class="table table-bordered  table-md">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $loop->index + $products->firstItem() }}</td>
                                <td>{{ $product->product['custom_id'] }}</td>
                                <td>{{ $product->product['name'] }}</td>
                                <td>{{ formatRupiah($product->price) }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->date->format('F j, Y') }}</td>
                                <td>
                                    <span class="{{ $product->getStatusColor() }}">{{ $product->getStatus() }}@if(!blank($product->reasons)){{ ': ' . $product->reasons }} @endif</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <p class="text-center"><em>There is no record.</em></p>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </x-slot>

            <x-slot name="footer">
                {{ $products->onEachSide(2)->appends($_GET)->links('admin.partials.pagination') }}
            </x-slot>
        </x-section>

    </x-content>

@endsection
