@extends('layouts.admin')

@section('title', 'Data Reservasi')

@section('content')

<h2 class="page-title">Data Reservasi</h2>

<div class="top-actions">
    <button class="btn-primary">Download</button>

    <div class="search-box">
        <input type="text" placeholder="Search">
    </div>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal Reservasi</th>
                <th>Jumlah Tamu</th>
                <th>Ruangan</th>
                <th>Meja</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($reservasi as $r)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td style="text-align: left;">{{ $r->nama_pelanggan }}</td>
                    <td>{{ $r->waktu }}</td>
                    <td>{{ $r->jumlah_tamu }}</td>
                    <td>{{ $r->ruangan }}</td>
                    <td>{{ $r->nomor_meja }}</td>
                    <td>
                        <div class="aksi">     
                            {{-- HAPUS RESERVASI --}}
                            <form action="{{ route('hapusReservasi', $r->id_reservasi) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                    @csrf
                                    @method('DELETE')
                                <button type="submit"
                                    class=" aksi-btn delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                            <button type="button" onclick="openModal({{ $r->id_reservasi }})"
                            class="aksi-btn edit">
                                <i class="bi bi-eye"></i> Detail
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    
    
    <!-- MODAL DETAIL -->
    <div id="modalDetail"
        class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50 overflow-auto">

        <div id="modalContentWrapper"
            class="bg-white w-full max-w-xl rounded-lg shadow-lg p-6 relative transform scale-95 opacity-0 transition-all duration-200 ease-in-out">
            <!-- CLOSE BUTTON -->
            <button onclick="closeModal()"
                class="absolute top-3 right-3 text-gray-500 hover:text-red-500 text-xl">
                &times;
            </button>

            <h2 class="text-lg font-semibold mb-4">Detail Pesanan</h2>

            <!-- CONTENT -->
            <div id="modalContent" class="space-y-2 text-sm">
                <p class="text-gray-500">Memuat data...</p>
            </div>
        </div>
    </div>


</div>

<div class="pagination">
    <div class="show-entries">
        Show
        <select>
            <option>4</option>
            <option>8</option>
            <option>12</option>
        </select>
        entries
    </div>

    <div class="page-controls">
        <button>Previous</button>
        <span>1</span>
        <button>Next</button>
    </div>
</div>

@endsection

@push('extra-script')
<script>
function openModal(id) {
    const modal = document.getElementById('modalDetail');
    const wrapper = document.getElementById('modalContentWrapper');
    const content = document.getElementById('modalContent');

     // Tampilkan overlay
    modal.classList.remove('hidden');

    // Animasi masuk
    setTimeout(() => {
        wrapper.classList.remove('scale-95', 'opacity-0');
        wrapper.classList.add('scale-100', 'opacity-100');
    }, 10);


    content.innerHTML = '<p class="text-gray-500">Memuat data...</p>';

    fetch(`/admin/data-reservasi/${id}/detail-json`)
        .then(async res => {
            if (!res.ok) {
                const text = await res.text();
                throw new Error(text);
            }
            return res.json();
        })
        .then(data => {

            if (data.message) {
                content.innerHTML =
                    `<p class="text-red-500">${data.message}</p>`;
                return;
            }

            let html = `
                <p><strong>Nama:</strong> ${data.nama_pelanggan}</p>
                <p><strong>Waktu:</strong> ${data.waktu}</p>
                <p><strong>Jumlah Tamu:</strong> ${data.jumlah_tamu}</p>
                <hr class="my-2">
            `;

            // Tampilkan transaksi
            if (data.transaksi && data.transaksi.length > 0) {
                data.transaksi.forEach(trx => {
                    let statusText = 'Belum Dibayar';
                    let statusColor = 'text-red-500';

                    if (trx.status === 'menunggu') {
                        statusText = 'Belum Tervalidasi';
                        statusColor = 'text-yellow-500';
                    } else if (trx.status === 'tervalidasi') {
                        statusText = 'Tervalidasi';
                        statusColor = 'text-green-600';
                    }

                    html += `
                        <div class="my-2 p-2 border rounded">
                            <p><strong>Status:</strong> <span class="${statusColor} font-semibold">${statusText}</span></p>
                            <p><strong>Total:</strong> Rp ${Number(trx.total || 0).toLocaleString()}</p>
                            <p><strong>Metode:</strong> ${trx.metode_pembayaran || '-'}</p>
                    `;

                    // Pesanan terkait
                    const pesananTerkait = data.pesanan.filter(p => p.id_transaksi === trx.id_transaksi);
                    if (pesananTerkait.length > 0) {
                        html += `<strong>Pesanan:</strong><ul class="list-disc ml-5">`;
                        pesananTerkait.forEach(p => {
                            html += `<li>(x${p.qty}) ${p.nama_menu} - Rp ${Number(p.harga).toLocaleString()}</li>`;
                        });
                        html += `</ul>`;
                    } else {
                        html += `<p class="text-gray-400">Tidak ada pesanan</p>`;
                    }

                    // Tambahkan tombol Validasi & Hapus
                    html += `
                        <div class="mt-3 flex justify-end gap-2">
                            <button onclick="validasiTransaksi(${trx.id_transaksi})"
                                class="bg-green-500 text-white px-4 py-1 rounded hover:bg-green-600">
                                Validasi
                            </button>
                            <button onclick="hapusTransaksi(${trx.id_transaksi})"
                                class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600">
                                Hapus
                            </button>
                        </div>
                    `;

                    html += `</div>`; // tutup div transaksi
                });
            } else {
                html += `<p class="text-gray-400">Tidak ada transaksi</p>`;
            }

            content.innerHTML = html;
        })
        .catch(err => {
            console.error(err);
            content.innerHTML =
                `<p class="text-red-500">Gagal mengambil data</p>`;
        });
}

// Tutup modal
function closeModal() {
    const modal = document.getElementById('modalDetail');
    const wrapper = document.getElementById('modalContentWrapper');
 // Animasi keluar
    wrapper.classList.add('scale-95', 'opacity-0');

    setTimeout(() => {
        modal.classList.add('hidden');
    }, 200); // durasi sama dengan transition

}


// Klik di luar modal untuk menutup
document.getElementById('modalDetail').addEventListener('click', function(e) {
    const wrapper = document.getElementById('modalContentWrapper');
    if (!wrapper.contains(e.target)) {
        closeModal();
    }
});


function validasiTransaksi(id) {
    if (!confirm('Yakin ingin melakukan validasi transaksi ini?')) return;

    fetch(`/admin/transaksi/${id}/validasi`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(async res => {
        if (!res.ok) {
            const text = await res.text();
            throw new Error(text);
        }
        return res.json();
    })
    .then(data => {
        alert(data.message);
        closeModal();
        location.reload(); // refresh halaman agar status terbaru terlihat
    })
    .catch(err => {
        console.error(err);
        alert('Gagal melakukan validasi transaksi');
    });
}


// ARAHKAN KE MENGHAPUS PESANAN
function hapusTransaksi(id) {
    if (!confirm('Yakin ingin menghapus transaksi ini?')) return;

    fetch(`/admin/transaksi/${id}/hapus`, { method: 'DELETE', headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'} })
        .then(res => {
            if (!res.ok) throw new Error('Gagal hapus');
            alert('Transaksi berhasil dihapus');
            closeModal();
            location.reload();
        })
        .catch(err => {
            console.error(err);
            alert('Gagal menghapus transaksi');
        });
}
</script>
@endpush



