@extends('layouts.app')

@section('title', 'Keranjang')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/keranjang.css') }}">
@endpush


@section('content')
<h1 style="text-align:center; margin: 50px 30px; font-size: 2rem;">Keranjang</h1>

<div class="keranjang-container">

    @if(count($keranjang) == 0)

        <p style="text-align:center;">Keranjang kosong.</p>

    @else

        {{-- GRID 2 KOLOM --}}
        <div class="grid-keranjang">

            @foreach($keranjang as $index => $item)
            <div class="item-card">

                {{-- Gambar --}}
                <img src="{{ asset($item['gambar']) }}" class="menu-img" alt="Gambar Menu">

                <div class="item-info">
                    <strong>{{ $item['nama'] }}</strong><br>
                    Rp. {{ number_format($item['harga']) }},
                    
                    <div class="delete-btn">
                        <form action="{{ route('update-qty', $index) }}" method="POST" class="qty-form">
                            @csrf
                            @method('PUT')
                        </form>

                        
                        {{-- Tombol Delete (pisah form) --}}
                        <form action="{{ route('remove-item', $index) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none; border:none; cursor:pointer; color:red; font-size:30px;">
                                🗑
                            </button>
                        </form>

                        <input type="number" class="qty-input" data-index="{{ $index }}" value="{{ $item['qty'] }}" min="1">

                        {{-- Checkbox --}}
                        <input type="checkbox" class="item-check">
                    </div>
                </div>

            </div>
            @endforeach

        </div>

        {{-- BAGIAN BAWAH: Checklist Semua + Tombol Reservasi --}}
        <div class="bottom-section">
            <label>
                <input type="checkbox"> Semua
            </label>

            <button class="reservasi-btn"><a href="{{ route('reservasi') }}"> Reservasi</a></button>
        </div>

    @endif

</div>
@endsection

@push('extra-scripts')
<script>
    document.querySelectorAll('.qty-input').forEach(input => {
        input.addEventListener('change', function() {

            const index = this.dataset.index;
            const qty = this.value;

            fetch(`/keranjang/update/${index}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ qty: qty })
            })
            .then(res => res.json())
            .then(data => {
                console.log("Qty updated:", data);
                // bisa tambah notifikasi kecil
            })
            .catch(err => console.error(err));

        });
    });
</script>
@endpush
