<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Resit Pembayaran</title>
    <style>
        body { 
            font-family: DejaVu Sans, sans-serif; 
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #3b82f6;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #1e40af;
            font-size: 28px;
            margin: 0;
            font-weight: bold;
        }
        .header p {
            color: #6b7280;
            margin: 5px 0 0 0;
            font-size: 14px;
        }
        .receipt-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .info-section {
            flex: 1;
        }
        .info-section h3 {
            color: #374151;
            font-size: 16px;
            margin-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 5px;
        }
        .info-row {
            margin-bottom: 8px;
            font-size: 14px;
        }
        .info-label {
            font-weight: bold;
            color: #4b5563;
            display: inline-block;
            width: 120px;
        }
        .info-value {
            color: #1f2937;
        }
        .amount-section {
            background: #f0f9ff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin: 30px 0;
            border: 2px solid #3b82f6;
        }
        .amount-label {
            font-size: 16px;
            color: #1e40af;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .amount-value {
            font-size: 32px;
            color: #1e40af;
            font-weight: bold;
        }
        .status-section {
            text-align: center;
            margin: 20px 0;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
        }
        .status-success {
            background: #dcfce7;
            color: #166534;
            border: 2px solid #22c55e;
        }
        .status-pending {
            background: #fef3c7;
            color: #92400e;
            border: 2px solid #f59e0b;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            color: #6b7280;
            font-size: 12px;
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
        }
        .logo {
            font-size: 24px;
            color: #3b82f6;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">📚</div>
            <h1>RESIT PEMBAYARAN</h1>
            <p>Pusat Tuisyen Akademik Terbilang</p>
        </div>

        <div class="receipt-info">
            <div class="info-section">
                <h3>Maklumat Pelanggan</h3>
                <div class="info-row">
                    <span class="info-label">Nama:</span>
                    <span class="info-value">{{ $transaction->user->name ?? 'N/A' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email:</span>
                    <span class="info-value">{{ $transaction->user->email ?? 'N/A' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">ID Transaksi:</span>
                    <span class="info-value">#{{ $transaction->id }}</span>
                </div>
            </div>

            <div class="info-section">
                <h3>Maklumat Pembayaran</h3>
                <div class="info-row">
                    <span class="info-label">Tarikh:</span>
                    <span class="info-value">{{ $transaction->tarikh ? $transaction->tarikh->format('d/m/Y H:i') : 'N/A' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Bill Code:</span>
                    <span class="info-value">{{ $transaction->bill_code ?? 'N/A' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Status:</span>
                    <span class="info-value">{{ ucfirst($transaction->status) }}</span>
                </div>
            </div>
        </div>

        <div class="amount-section">
            <div class="amount-label">JUMLAH BAYARAN</div>
            <div class="amount-value">RM {{ number_format($transaction->harga_kelas, 2) }}</div>
        </div>

        <div class="info-section">
            <h3>Maklumat Kelas</h3>
            <div class="info-row">
                <span class="info-label">Kelas:</span>
                <span class="info-value">{{ $transaction->kelas }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Jenis:</span>
                <span class="info-value">Yuran Bulanan</span>
            </div>
        </div>

        <div class="status-section">
            <div class="status-badge status-{{ $transaction->status }}">
                {{ ucfirst($transaction->status) }}
            </div>
        </div>

        <div class="footer">
            <p>Terima kasih atas pembayaran anda!</p>
            <p>Resit ini adalah bukti pembayaran rasmi</p>
            <p>Dijana pada: {{ now()->format('d/m/Y H:i:s') }}</p>
        </div>
    </div>
</body>
</html> 