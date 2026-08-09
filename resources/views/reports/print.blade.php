<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $transaction->invoice }}</title>

    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            width:300px;
            margin:20px auto;
            color:#000;
            font-size:14px;
        }

        h2{
            text-align:center;
            margin-bottom:5px;
        }

        p{
            margin:3px 0;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:10px;
        }

        th,
        td{
            padding:4px 0;
            font-size:13px;
        }

        .text-right{
            text-align:right;
        }

        hr{
            border:none;
            border-top:1px dashed #000;
            margin:10px 0;
        }

        .footer{
            text-align:center;
            margin-top:20px;
        }
    </style>
</head>

<body>

    <h2>POSify</h2>

    <p style="text-align:center">
        Invoice Penjualan
    </p>

    <hr>

    <p>
        <strong>Invoice :</strong>
        {{ $transaction->invoice }}
    </p>

    <p>
        <strong>Tanggal :</strong>
        {{ $transaction->created_at->format('d/m/Y H:i') }}
    </p>

    <p>
        <strong>Customer :</strong>
        {{ $transaction->customer->nama_customer ?? '-' }}
    </p>

    <hr>

    <table>

        <tbody>

            @foreach($transaction->details as $detail)

            <tr>

                <td colspan="2">
                    {{ $detail->product->nama_produk }}
                </td>

            </tr>

            <tr>

                <td>
                    {{ $detail->qty }} x
                    Rp {{ number_format($detail->harga,0,',','.') }}
                </td>

                <td class="text-right">
                    Rp {{ number_format($detail->subtotal,0,',','.') }}
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

    <hr>

    <table>

        <tr>
            <td>Subtotal</td>
            <td class="text-right">
                Rp {{ number_format($transaction->subtotal,0,',','.') }}
            </td>
        </tr>

        <tr>
            <td>Diskon</td>
            <td class="text-right">
                Rp {{ number_format($transaction->diskon,0,',','.') }}
            </td>
        </tr>

        <tr>
            <td><strong>Total</strong></td>
            <td class="text-right">
                <strong>
                    Rp {{ number_format($transaction->total,0,',','.') }}
                </strong>
            </td>
        </tr>

        <tr>
            <td>Bayar</td>
            <td class="text-right">
                Rp {{ number_format($transaction->bayar,0,',','.') }}
            </td>
        </tr>

        <tr>
            <td>Kembalian</td>
            <td class="text-right">
                Rp {{ number_format($transaction->kembalian,0,',','.') }}
            </td>
        </tr>

    </table>

    <hr>

    <div class="footer">

        <strong>Terima Kasih</strong>

        <br>

        Sudah Berbelanja di POSify

    </div>

<script>
    window.print();

    window.onafterprint = function () {
        window.close();
    };
</script>

</body>
</html>