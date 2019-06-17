<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Invoice</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: #fff;
            background-image: none;
            font-size: 12px;
        }

        address {
            margin-top: 15px;
        }

        h2 {
            font-size: 28px;
            color: #cccccc;
        }

        .container {
            padding-top: 30px;
        }

        .invoice-head td {
            padding: 0 8px;
        }

        .invoice-body {
            background-color: transparent;
        }

        .logo {
            padding-bottom: 10px;
        }

        .table th {
            vertical-align: bottom;
            font-weight: bold;
            padding: 8px;
            line-height: 20px;
            text-align: left;
        }

        .table td {
            padding: 8px;
            line-height: 20px;
            text-align: left;
            vertical-align: top;
            border-top: 1px solid #dddddd;
        }

        .well {
            margin-top: 15px;
        }
    </style>
</head>

<body>
<div class="container">
    <table style="margin-left: auto; margin-right: auto" width="550">
        <tr>
            <td width="160">
                &nbsp;
            </td>

            <!-- Organization Name / Image -->
            <td align="right">
                {{ config ('app.name') }}
            </td>
        </tr>
        <tr valign="top">
            <td style="font-size:28px;color:#cccccc;">
                Factura emitida
            </td>

            <!-- Organization Name / Date -->
            <td>
                <br><br>
                <strong>To:</strong> {{ $user->name }}
                <br>
                <strong>Date:</strong> {{ \Carbon\Carbon::now() }}
            </td>
        </tr>
        <tr valign="top">
            <!-- Organization Details -->
            <td style="font-size:9px;">
                Cliente: {{ $user->name }}<br>
                Dirección: {{ $user->address }}<br>
                Correo: {{ $user->email }}<br>
                Teléfono: {{ $user->phone }}

            </td>
            <td>
                <!-- Invoice Info -->
                <p>
                    <strong>Vendedor:</strong> {{ config ('app.name') }}<br>
                    <strong>Nº Factura:</strong> 2112<br>
                </p>

                <br><br>

                <!-- Invoice Table -->
                <table width="100%" class="table" border="0">
                    <tr>
                        <th align="left">Nombre</th>
                        <th align="right">Precio</th>
                        <th align="right">Unidades</th>
                        <th align="right">Subtotal</th>
                    </tr>

                    @foreach ($cart->details as $detail)
                        <tr>
                            <td>{{ $detail->product->name }}</td>
                            <td>{{ $detail->price }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ $detail->subtotal }}</td>
                        </tr>
                @endforeach

                <!-- Display The Final Total -->
                    <tr style="border-top:2px solid #000;">
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td style="text-align: right;"><strong>Subtotal</strong></td>
                        <td>{{ $cart->total }}</td>
                    </tr>
                    <tr style="border-top:2px solid #000;">
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td style="text-align: right;"><strong>IVA 21%</strong></td>
                        <td>{{ $cart->iva(0.21) }}</td>
                    </tr>
                    <tr style="border-top:2px solid #000;">
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td style="text-align: right;"><strong>Total</strong></td>
                        <td>{{ $cart->total + $cart->iva(0.21) }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
