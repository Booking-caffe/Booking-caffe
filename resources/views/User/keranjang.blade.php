@extends('layouts.app')

@section('title', 'Keranjang')

@section('content')
    <div class="container mx-auto px-4 py-10">

        <h1 class="text-center text-2xl md:text-3xl font-bold mb-10">
            Keranjang
        </h1>

        @if (count($keranjang) == 0)
            <div class="text-center text-gray-500">
                Keranjang kosong.
            </div>
        @else
            <!-- ITEM GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($keranjang as $index => $item)
                    <div class="bg-white rounded-xl shadow-md p-4 flex gap-4">

                        <img src="{{ asset('storage/' . $item['gambar']) }}" class="w-24 h-24 rounded-lg object-cover">

                        <div class="flex-1 flex flex-col justify-between">

                            <div>
                                <h3 class="font-semibold text-lg">{{ $item['nama'] }}</h3>
                                <p class="text-sm text-gray-500">
                                    Rp {{ number_format($item['harga']) }}
                                </p>
                            </div>

                            <div class="flex items-center justify-between mt-4">

                                <!-- QTY -->
                                <input type="number" min="1" max="{{ $item['stok'] }}" value="{{ $item['qty'] }}"
                                    data-index="{{ $index }}" data-stok="{{ $item['stok'] }}"
                                    class="qty-input w-16 text-center rounded-md border">


                                <!-- DELETE -->
                                <form action="{{ route('remove-item', $index) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 text-xl">🗑</button>
                                </form>

                                <!-- CHECKBOX -->
                                <input type="checkbox" class="item-check w-4 h-4" data-index="{{ $index }}"
                                    {{ isset($selected[$index]) ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- BOTTOM BAR -->
            <div
                class="mt-10 flex flex-col md:flex-row justify-between items-center gap-4
                    bg-white rounded-xl shadow-md p-5">

                <label class="flex items-center gap-2">
                    <input type="checkbox" id="checkAll">
                    Pilih Semua
                </label>

                <a href="{{ route('reservasi') }}" class="bg-primary text-white px-6 py-3 rounded-lg">
                    Reservasi
                </a>
            </div>

        @endif
    </div>
@endsection


@push('extra-scripts')
    <script>
        /* ===============================
           UPDATE QTY
        ================================ */
        document.querySelectorAll('.qty-input').forEach(input => {
            input.addEventListener('change', function() {

                let qty = parseInt(this.value);
                let stok = parseInt(this.dataset.stok);

                // ❌ jika kosong / < 1
                if (!qty || qty < 1) {
                    this.value = 1;
                    qty = 1;
                }

                // ❌ jika melebihi stok
                if (qty > stok) {
                    alert('Stok hanya tersisa ' + stok);
                    this.value = stok;
                    qty = stok;
                }

                fetch(`/keranjang/update/${this.dataset.index}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        qty: qty
                    })
                });
            });
        });

        /* ===============================
           CHECKBOX PER ITEM
        ================================ */
        document.querySelectorAll('.item-check').forEach(cb => {
            cb.addEventListener('change', function() {
                fetch('/keranjang/pilih', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        index: this.dataset.index,
                        checked: this.checked
                    })
                });
            });
        });

        /* ===============================
           CHECK ALL
        ================================ */
        document.getElementById('checkAll').addEventListener('change', function() {
            document.querySelectorAll('.item-check').forEach(cb => {
                cb.checked = this.checked;
                cb.dispatchEvent(new Event('change'));
            });
        });
    </script>
@endpush
