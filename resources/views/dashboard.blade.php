@extends('main')
@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    @if (Auth::user()->role == 'admin')
        <div class="container mt-5">
            <h1 class="text-center mb-4">Selamat Datang, Administrator!</h1>
            <div class="col-md-4">
                <div class="card shadow-sm p-4">
                    <h5>Total Penjualan Hari Ini</h5>
                    <h2 class="fw-bold">{{ $count }}</h2>
                    <p class="text-muted small">
                        @if ($updated && $updated->created_at)
                            Terakhir diperbarui: {{ $updated->created_at->format('d-m-Y H:i:s') }}
                        @else
                            Tidak ada Transaksi Hari ini
                        @endif
                    </p>
                </div>
            </div>
            {{-- <div class="col-md-8">
                <div class="card shadow-sm p-4">
                    <h5 class="text-center">Jumlah Penjualan (7 Hari Terakhir)</h5>
                    <canvas id="barChart"></canvas>
                </div>
            </div> --}}
        </div>

        {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const penjualanData = @json($penjualanPerBulan);
    const barLabels = Object.keys(penjualanData);
    const barData = Object.values(penjualanData);

    const pieLabels = @json($persentaseProduk->pluck('nama'));
    const pieData = @json($persentaseProduk->pluck('penjualan_count'));

    // Bar Chart
    const ctxBar = document.getElementById('barChart').getContext('2d');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: barLabels,
            datasets: [{
                label: 'Total Penjualan',
                data: barData,
                backgroundColor: 'rgba(75, 192, 192, 0.6)'
            }]
        }
    });

    // Pie Chart
    const ctxPie = document.getElementById('pieChart').getContext('2d');
    new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: pieLabels,
            datasets: [{
                label: 'Penjualan Produk',
                data: pieData,
                backgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'
                ]
            }]
        }
    });
</script> --}}

    @endif

    @if (Auth::user()->role == 'kasir')
        <div class="container mt-5">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h4 class="mb-3">Selamat Datang, Petugas!</h4>
                    <div class="card bg-light p-4">
                        <h6 class="text-muted">Total Penjualan Hari Ini</h6>
                        <h2 class="fw-bold">{{ $count }}</h2>
                        <p class="text-muted">Jumlah total penjualan yang terjadi hari ini.</p>
                        <p class="text-muted small">
                            @if ($updated && $updated->created_at)
                                Terakhir diperbarui: {{ $updated->created_at->format('d-m-Y H:i:s') }}
                            @else
                                Tidak ada Transaksi Hari ini
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

