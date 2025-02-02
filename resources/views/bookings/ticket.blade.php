<!DOCTYPE html>
<html>
<head>
    <title>Tiket - {{ $booking->booking_code }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .ticket {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border: 2px solid #000;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .details {
            margin-bottom: 20px;
        }
        .details table {
            width: 100%;
        }
        .details td {
            padding: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
        }
        @media print {
            body {
                padding: 0;
            }
            .ticket {
                border: none;
            }
        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="header">
            <h1>TIKET BIOSKOP</h1>
            <h2>{{ $booking->movieSchedule->movie->title }}</h2>
        </div>
        
        <div class="details">
            <table>
                <tr>
                    <td width="150"><strong>Kode Booking</strong></td>
                    <td>: {{ $booking->booking_code }}</td>
                </tr>
                <tr>
                    <td><strong>Nama</strong></td>
                    <td>: {{ $booking->customer_name }}</td>
                </tr>
                <tr>
                    <td><strong>Tanggal</strong></td>
                    <td>: {{ $booking->movieSchedule->show_date->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <td><strong>Jam</strong></td>
                    <td>: {{ $booking->movieSchedule->show_time }}</td>
                </tr>
                <tr>
                    <td><strong>Kursi</strong></td>
                    <td>: {{ $booking->seats->pluck('seat_number')->implode(', ') }}</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td>: Rp {{ number_format($booking->total_price) }}</td>
                </tr>
            </table>
        </div>
        
        <div class="footer">
            <p>Tiket ini adalah bukti pembayaran yang sah. Mohon dibawa saat memasuki studio.</p>
            <p>Selamat menikmati film!</p>
        </div>
    </div>
    
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html> 