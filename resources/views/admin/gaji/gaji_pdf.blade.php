<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ public_path('/css/bootstrap.css') }}">
    <title>Slip Gaji Pegawai</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif; /* PERUBAHAN FONT */
            font-size: 12.5px; 
            color: #3C4043; 
            background-color: #ffffff; 
            margin: 0;
            padding: 0; 
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .payslip-container {
            width: 100%; 
            margin: 0 auto; 
            background-color: #fff;
            border: 1px solid #E0E0E0; 
            overflow: hidden; 
        }

        @page {
            size: A4;
            margin: 20mm 15mm; 
        }


        .payslip-header {
            background-color: #2A3B47; 
            color: #FFFFFF;
            padding: 20px 25px; 
            text-align: center;
        }

        .payslip-header h1 {
            margin: 0;
            font-size: 20px; 
            font-weight: 500; 
            letter-spacing: 0.5px;
        }
        .payslip-header .company-name-header {
            font-size: 14px;
            margin-top: 5px;
            opacity: 0.9;
        }

        .payslip-body {
            padding: 20px 25px; 
        }

        .company-employee-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px; 
            padding-bottom: 15px; 
            border-bottom: 1px solid #E8E8E8; 
        }

        .company-employee-info > div {
            width: 48.5%; 
        }

        .company-employee-info h3 {
            font-size: 15px; 
            color: #2A3B47; 
            margin-top: 0;
            margin-bottom: 8px; 
            padding-bottom: 3px;
        }

        .info-table {
            width: 100%;
            margin-bottom: 5px; 
        }

        .info-table td {
            padding: 4px 0; 
            vertical-align: top;
            line-height: 1.4; 
        }

        .info-table td:first-child {
            font-weight: 500; 
            width: 110px; 
            color: #5F6368; 
        }
        .info-table td:nth-child(2) {
            width: 8px; 
            text-align: center;
        }

        .financial-details {
            display: flex;
            justify-content: space-between; 
            gap: 20px; 
            margin-bottom: 20px; 
        }

        .financial-section {
            flex: 1; 
        }
        
        .section-title {
            font-size: 14px;
            padding: 8px 0px; 
            margin:0 0 8px 0;
            color: #FFFFFF;
            font-weight: 500;
            text-align: center; 
            border-radius: 3px; 
        }

        .earnings-title {
            background-color: #387C6D; 
        }

        .deductions-title {
            background-color: #B55A4B; 
        }

        .details-table {
            width: 100%;
            border-collapse: collapse; 
        }

        .details-table td {
            padding: 6px 3px; 
            border-bottom: 1px solid #F1F1F1; 
            line-height: 1.3; 
        }
        .details-table tr:last-child td {
            border-bottom: none; 
        }

        .details-table .label {
            text-align: left;
        }

        .details-table .amount {
            text-align: right;
            font-weight: 500;
        }
        .details-table .currency-prefix { /* Ini untuk titik dua pada rincian pemasukan/potongan */
            text-align: left; 
            width: 10px; /* Sedikit lebih lebar untuk titik dua agar tidak terlalu mepet */
            padding-right: 5px;
        }

        .total-row td {
            font-weight: bold;
            padding-top: 8px !important; 
            color: #202124; 
        }
        .total-row .currency-prefix { /* Kosongkan padding untuk baris total jika tidak ada titik dua */
            padding-right: 0;
        }


        .net-pay-section {
            margin-top: 15px; 
            padding: 12px; 
            background-color: #E8F0FE; 
            border: 1px solid #D1E0FF; 
            border-radius: 4px;
            /* text-align: center; Dihapus agar tabel bisa diatur lebarnya */
        }

        .net-pay-section table {
            width: auto; /* Agar tabel tidak full width dan bisa di tengah */
            margin: 0 auto; /* Untuk menengahkan tabel */
        }

        .net-pay-section .label {
            font-size: 14px; 
            font-weight: bold;
            color: #2A3B47; 
            text-align: left;
            padding-right: 0; /* Dihapus karena ada kolom titik dua sendiri */
            padding-top: 10px;
        }

        /* PENYESUAIAN UNTUK KESEJAJARAN GAJI BERSIH */
        .net-pay-section .colon {
            font-size: 14px;
            font-weight: bold;
            color: #2A3B47;
            text-align: center;
            padding: 0 5px 0 5px; /* Atur padding kiri kanan untuk titik dua */
        }

        .net-pay-section .amount {
            font-size: 16px; 
            font-weight: bold;
            color: #2A3B47; 
            text-align: right;
            padding: 0 5px 0 5px;
        }

        .payslip-footer {
            padding: 15px 25px; 
            text-align: right;
            font-size: 11px; 
            color: #70757A; 
            border-top: 1px solid #E8E8E8;
            margin-top: 10px; 
        }
        .payslip-footer .signature-title {
            margin-bottom: 2px;
        }
        .payslip-footer .signature-position {
             margin-bottom: 25px; 
        }
        .payslip-footer .signature-name {
            font-weight: 500;
        }

    </style>
</head>

<body>
    <div class="payslip-container">
        <header class="payslip-header">
            <h1>SLIP GAJI PEGAWAI</h1>
            <div class="company-name-header">{{ $perusahaan->nama }}</div>
        </header>

        <div class="payslip-body">
            <section class="company-employee-info">
                <div class="company-details">
                    <h3>Informasi Umum</h3>
                    <table class="info-table">
                        <tr>
                            <td>Periode Gaji</td>
                            <td>:</td>
                            <td>{{ date('d M Y', strtotime($period_dari)) . ' - ' . date('d M Y', strtotime($period_ke)) }}</td>
                        </tr>
                         <tr>
                            <td>Tanggal Cetak</td>
                            <td>:</td>
                            <td>{{ date('d M Y') }}</td>
                        </tr>
                        <tr>
                            <td>Divisi</td>
                            <td>:</td>
                            <td>{{ $pegawai->divisi->nm_divisi }}</td>
                        </tr>
                    </table>
                </div>

                <div class="employee-details-section"> 
                    <h3>Data Pegawai</h3>
                    <table class="info-table">
                        <tr>
                            <td>ID Pegawai</td>
                            <td>:</td>
                            <td>{{ $pegawai->id }}</td>
                        </tr>
                        <tr>
                            <td>Nama Pegawai</td>
                            <td>:</td>
                            <td>{{ $pegawai->nama }}</td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>:</td>
                            <td>{{ $pegawai->jabatan->nm_jabatan }}</td>
                        </tr>
                    </table>
                </div>
            </section>

            <section class="financial-details">
                <div class="financial-section earnings-section">
                    <h4 class="section-title earnings-title">RINCIAN PEMASUKAN</h4>
                    <table class="details-table">
                        <tr>
                            <td class="label">Gaji Pokok</td>
                            <td class="currency-prefix">:</td>
                            <td class="amount">@currency($gaji_pokok)</td>
                        </tr>
                        @foreach ($att_tunjangan as $p)
                            @if ($p->is_active != 0)
                                <tr>
                                    <td class="label">{{ $p->nama }}</td>
                                    <td class="currency-prefix">:</td>
                                    <td class="amount">@currency($p->jumlah)</td>
                                </tr>
                            @endif
                        @endforeach
                        @if ($tunj_status != 0)
                            <tr>
                                <td class="label">{{ 'Tunjangan Keluarga' }}</td>
                                <td class="currency-prefix">:</td>
                                <td class="amount">@currency($tunj_status)</td>
                            </tr>
                        @endif
                        @if ($tunj_anak != 0)
                            <tr>
                                <td class="label">{{ 'Tunjangan Anak' }}</td>
                                <td class="currency-prefix">:</td>
                                <td class="amount">@currency($tunj_anak)</td>
                            </tr>
                        @endif
                        @if ($tunj_kinerja != 0)
                            <tr>
                                <td class="label">{{ 'Tunjangan Kinerja' }}</td>
                                <td class="currency-prefix">:</td>
                                <td class="amount">@currency($tunj_kinerja)</td>
                            </tr>
                        @endif
                        <tr class="total-row total-row-pemasukan">
                            <td class="label">Total Pemasukan</td>
                            <td class="currency-prefix"></td> <td class="amount">@currency($tot_pemasukan)</td>
                        </tr>
                    </table>
                </div>

                <div class="financial-section deductions-section">
                    <h4 class="section-title deductions-title">RINCIAN POTONGAN</h4>
                    <table class="details-table">
                        @if ($jml_ptgn_telat != 0)
                            <tr>
                                <td class="label">Potongan Keterlambatan</td>
                                <td class="currency-prefix">:</td>
                                <td class="amount">@currency($jml_ptgn_telat)</td>
                            </tr>
                        @endif
                        @if ($jml_ptgn_bolos != 0)
                            <tr>
                                <td class="label">Potongan Membolos</td>
                                <td class="currency-prefix">:</td>
                                <td class="amount">@currency($jml_ptgn_bolos)</td>
                            </tr>
                        @endif
                        @if ($pot_bpjs_kes != 0)
                            <tr>
                                <td class="label">{{ 'Iuran BPJS Kesehatan' }}</td>
                                <td class="currency-prefix">:</td>
                                <td class="amount">@currency($pot_bpjs_kes)</td>
                            </tr>
                        @endif
                        @if ($pot_bpjs_ket != 0)
                            <tr>
                                <td class="label">{{ 'Iuran BPJS Ketenagakerjaan (JHT)' }}</td>
                                <td class="currency-prefix">:</td>
                                <td class="amount">@currency($pot_bpjs_ket)</td>
                            </tr>
                        @endif
                        @if ($pot_pph != 0)
                            <tr>
                                <td class="label">{{ 'Potongan PPH 21' }}</td>
                                <td class="currency-prefix">:</td>
                                <td class="amount">@currency($pot_pph)</td>
                            </tr>
                        @endif
                        @foreach ($att_potongan as $p)
                            <tr>
                                <td class="label">{{ $p->nama }}</td>
                                <td class="currency-prefix">:</td>
                                <td class="amount">@currency($p->jumlah)</td>
                            </tr>
                        @endforeach
                        <tr class="total-row total-row-potongan">
                            <td class="label">Total Potongan</td>
                            <td class="currency-prefix"></td> <td class="amount">@currency($jml_ptgn)</td>
                        </tr>
                    </table>
                </div>
            </section>

            <section class="net-pay-section">
                <table>
                    <tr>
                        <td class="label">GAJI BERSIH DITERIMA</td>
                        <td class="colon">:</td> 
                        <td class="amount">@currency($tot_gaji_diterima)</td>
                    </tr>
                </table>
            </section>
        </div>

        <footer class="payslip-footer">
            <div class="signature-title">Dibuat Oleh,</div>
            <div class="signature-position">{{ Auth::user()->jabatan->nm_jabatan }}</div>
            <div class="signature-name">{{ Auth::user()->nama }}</div>
        </footer>
    </div>
</body>
</html>