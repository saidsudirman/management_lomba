@extends('layout.landing.app')
@section('content')
    @push('styles')
        <style>
            /* Improved Print Styles */
            @media print {
                @page {
                    margin: 2cm;
                }
                body * {
                    visibility: hidden;
                }
                .print-container, .print-container * {
                    visibility: visible;
                }
                .print-container {
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 100%;
                    padding: 0;
                    margin: 0;
                }
                .no-print {
                    display: none !important;
                }
            }
            
            /* Enhanced Styling */
            .print-container {
                max-width: 800px;
                margin: 0 auto;
                padding: 40px;
                font-family: 'Times New Roman', serif;
                line-height: 1.6;
                color: #333;
            }
            
            .letter-header {
                text-align: center;
                margin-bottom: 30px;
                border-bottom: 2px solid #eee;
                padding-bottom: 20px;
            }
            
            .letter-header h3 {
                font-size: 24px;
                font-weight: bold;
                margin-bottom: 5px;
                color: #2c3e50;
            }
            
            .letter-content {
                margin: 30px 0;
            }
            
            .letter-content p {
                margin-bottom: 15px;
            }
            
            .text-left ul {
                padding-left: 20px;
                margin: 15px 0;
            }
            
            .text-left li {
                margin-bottom: 8px;
                list-style-type: none;
                position: relative;
                padding-left: 20px;
            }
            
            .text-left li:before {
                content: "•";
                position: absolute;
                left: 0;
                color: #2c3e50;
                font-weight: bold;
            }
            
            .ttd-container {
                margin: 40px 0 20px;
                text-align: right;
            }
            
            .ttd {
                height: 100px;
                margin-bottom: 10px;
            }
            
            .letter-footer {
                text-align: center;
                margin-top: 40px;
                font-size: 12px;
                color: #777;
                border-top: 1px solid #eee;
                padding-top: 15px;
            }
            
            .btn-print {
                position: fixed;
                right: 30px;
                bottom: 30px;
                z-index: 1000;
            }
        </style>
    @endpush

    <div class="main-content no-print">
        <section class="section">
            <div class="section-header">
                <h1>Bukti Pendaftaran</h1>
                <button onclick="window.print()" class="btn btn-primary btn-print">
                    <i class="fas fa-print"></i> Cetak
                </button>
            </div>
        </section>
    </div>

    <div class="print-container">
        <div class="letter-header">
            <h3>BUKTI PENDAFTARAN</h3>
            <p>Tanggal: {{ date('d M Y') }}</p>
        </div>

        <div class="letter-content">
            <p>Kepada Yth.</p>
            <p style="font-weight: bold;">{{ $pendaftaran->nama_peserta }}</p>
            <p>{{ $pendaftaran->email }}</p>
            <p>{{ $pendaftaran->no_hp }}</p>
            
            <br>
            
            <p>Dengan hormat,</p>
            
            @if($pendaftaran->lomba)
            <p>Surat ini adalah konfirmasi pendaftaran Anda untuk acara Lomba <strong>{{ $pendaftaran->lomba->nama }}</strong> yang
                akan diselenggarakan pada tanggal 
                <strong>{{ $pendaftaran->lomba->tanggal_mulai_formatted ?? 'TBD' }}</strong> sampai dengan
                <strong>{{ $pendaftaran->lomba->tanggal_selesai_formatted ?? 'TBD' }}</strong>.
            </p>
            @endif
            
            <p>Detail informasi sebagai berikut:</p>
            <ul class="text-left">
                <li><strong>Nama Peserta:</strong> {{ $pendaftaran->nama_peserta }}</li>
                <li><strong>Email:</strong> {{ $pendaftaran->email }}</li>
                <li><strong>No. HP:</strong> {{ $pendaftaran->no_hp }}</li>
                <li><strong>Tanggal Lahir:</strong> {{ $pendaftaran->tanggal_lahir }}</li>
                <li><strong>Alamat:</strong> {{ $pendaftaran->alamat }}</li>
                <li><strong>Asal Sekolah:</strong> {{ $pendaftaran->asal_sekolah }}</li>
                <li><strong>NISN:</strong> {{ $pendaftaran->nisn }}</li>
                @if($pendaftaran->lomba)
                <li><strong>Biaya Administrasi:</strong> Rp {{ number_format($pendaftaran->lomba->harga, 0, ',', '.') }}</li>
                @endif
                <li><strong>Status Pembayaran:</strong> 
                    <span style="color: {{ $pendaftaran->status_pembayaran == 2 ? '#e74c3c' : '#27ae60' }}">
                        {{ $pendaftaran->status_pembayaran == 2 ? 'Belum Bayar' : 'Sudah Bayar' }}
                    </span>
                </li>
                <li><strong>Tanggal Pendaftaran:</strong> {{ $pendaftaran->tanggal_pendaftaran->format('d M Y H:i') }}</li>
            </ul>
            
            <p>Mohon untuk mempersiapkan diri dengan baik dan hadir pada lomba tersebut.</p>
            <p>Terima kasih atas partisipasi Anda.</p>
            
            <div class="ttd-container">
                <img src="{{ asset('img/ttd.png') }}" alt="ttd" class="ttd">
                <br>
                <p>Hormat kami,</p>
                @if($pendaftaran->lomba)
                <p><strong>Penyelenggara Lomba {{ $pendaftaran->lomba->nama }}</strong></p>
                @endif
            </div>
        </div>
        
        <div class="letter-footer">
            <p>Surat ini dicetak secara otomatis dan tidak memerlukan tanda tangan basah</p>
        </div>
    </div>

    @push('scripts')
        <script>
            // Improved print handling
            document.addEventListener('DOMContentLoaded', function() {
                // Auto-print only when coming from registration
                @if(request('print') == 'true')
                    setTimeout(function() {
                        window.print();
                    }, 500);
                @endif
                
                // Better print button handling
                document.querySelector('.btn-print').addEventListener('click', function() {
                    window.print();
                });
            });
        </script>
    @endpush
@endsection