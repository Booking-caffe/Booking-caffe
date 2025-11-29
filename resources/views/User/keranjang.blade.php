@extends('layouts.user')

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

                    {{-- Delete --}}
                    <div class="delete-btn">
                        <form action="{{ route('remove-item', $index) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none; border:none; cursor:pointer; color:red; font-size:25px;">
                                🗑
                            </button>
                            {{-- Qty --}}
                            <div class="qty-box">
                                <span>{{ $item['qty'] }} +</span>
                            </div>
                        </form>
                    </div>

                </div>

                {{-- Checkbox --}}
                <input type="checkbox" class="item-check">
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
