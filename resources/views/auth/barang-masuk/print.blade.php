<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Barang Masuk - {{ $tahun }}</title>
    <style>
        @page {
            size: A4;
            margin: 1.5cm;
        }
        body { 
            font-family: 'Arial', sans-serif; 
            margin: 0; 
            padding: 0; 
            color: #000;
            line-height: 1.4;
        }
        .header { 
            text-align: center; 
            margin-bottom: 25px; 
            position: relative; 
            padding-bottom: 10px; 
        }
        .line-header {
            border-top: 3.5px solid #000;
            border-bottom: 1px solid #000;
            height: 2px;
            margin-top: 10px;
        }
        .header img { 
            position: absolute; 
            left: 5px; 
            top: 2px; 
            width: 75px; 
            height: auto; 
        }
        .header .instansi {
            margin-left: 80px;
        }
        .header h3 { 
            margin: 0; 
            font-size: 13pt; 
            font-weight: normal;
            text-transform: uppercase; 
            letter-spacing: 0.5px;
        }
        .header h2 { 
            margin: 2px 0; 
            font-size: 16pt; 
            font-weight: bold;
            text-transform: uppercase; 
            letter-spacing: 1px;
        }
        .header p { 
            margin: 2px 0; 
            font-size: 9.5pt; 
        }
        
        .title-container {
            text-align: center;
            margin: 25px 0 20px 0;
        }
        .title-report { 
            font-weight: bold; 
            font-size: 13pt; 
            text-transform: uppercase; 
            letter-spacing: 0.8px;
            display: inline-block;
            border-bottom: 1.5px solid #000;
            padding-bottom: 2px;
        }
        
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 5px; 
            font-size: 10pt; 
            border: 1.5px solid #000;
        }
        th, td { 
            border: 1px solid #000; 
            padding: 9px 5px; 
            text-align: center; 
            vertical-align: middle;
        }
        th { 
            background: #f2f2f2; 
            font-weight: bold; 
            text-transform: uppercase;
            font-size: 9.5pt;
        }
        
        .catatan {
            margin-top: 15px;
            font-size: 9pt;
            font-style: italic;
            font-weight: normal;
        }

        .footer-sign { 
            margin-top: 40px; 
            width: 100%; 
        }
        .footer-sign table { 
            border: none; 
            width: 100%;
        }
        .footer-sign td { 
            border: none; 
            text-align: center; 
            vertical-align: top; 
            width: 33.33%; 
            padding: 0;
            font-size: 10.5pt;
        }
        .sign-title {
            height: 45px;
            line-height: 1.3;
        }
        .sign-box { 
            margin-top: 65px; 
        }
        .name {
            font-weight: bold;
            text-decoration: underline;
            display: block;
        }
        
        @media print {
            body { -webkit-print-color-adjust: exact; }
        }
    </style>
</head>
<body onload="window.print()">
    @php
        $bulanIndo = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];
        $tglIndo = date('d') . ' ' . $bulanIndo[date('m')] . ' ' . date('Y');
    @endphp

    <div class="header">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
        <div class="instansi">
            <h3>PEMERINTAH PROVINSI NUSA TENGGARA TIMUR</h3>
            <h3>DINAS PENDIDIKAN DAN KEBUDAYAAN</h3>
            <h2>SMP NEGERI 11 KUPANG</h2>
            <p>Jl. Jenderal Suharto No. 11, Kota Kupang, NTT. Telp: (0380) 123456</p>
        </div>
        <div class="line-header"></div>
    </div>

    <div class="title-container">
        <div class="title-report">KARTU INVENTARIS BARANG (BARANG MASUK) - TAHUN {{ $tahun }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="14%">Kode Barang</th>
                <th>Nama Barang</th>
                <th width="10%">Jenis KIB</th>
                <th width="13%">Tanggal Masuk</th>
                <th width="8%">Jumlah</th>
                <th width="18%">Guru Penerima</th>
                <th width="10%">Ruang</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->kode_barang }}</td>
                    <td style="text-align: left; padding-left: 8px;">{{ $item->barang->nama_barang ?? '-' }}</td>
                    <td>KIB {{ strtoupper($item->jenis_kib) }}</td>
                    <td>{{ $item->tanggal_masuk }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->guru->nama ?? '-' }}</td>
                    <td>{{ $item->ruang->nama_ruangan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Tidak ada data untuk tahun {{ $tahun }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="catatan">
        Catatan: Semua barang yang terdata tidak diperkenankan berpindah tempat/ruangan tanpa sepengetahuan bendahara barang
    </div>

    <div class="footer-sign">
        <table>
            <tr>
                <td>
                    <div class="sign-title">
                        Mengetahui,<br>
                        Kepala Sekolah
                    </div>
                    <div class="sign-box">
                        <span class="name">Warmansyah, S.Pd</span>
                        NIP. 19701231 199512 2 021
                    </div>
                </td>
                <td>
                    <div class="sign-title">
                        <br>
                        Wakil Kepala Sekolah
                    </div>
                    <div class="sign-box">
                        <span class="name">Agustinus Muni, S.Pd</span>
                        NIP. 19660730 199412 1 003
                    </div>
                </td>
                <td>
                    <div class="sign-title">
                        Kupang, {{ $tglIndo }}<br>
                        Bendahara Barang
                    </div>
                    <div class="sign-box">
                        <span class="name">Oktavianus Tai, S.Pd</span>
                        NIP. 19930109 202012 1 009
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
