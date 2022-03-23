<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="yoriadiatma">
    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Purchase Order Logistik</title>
    <style>
        @page {
            margin: 0
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12;
        }

        .table-kop tr td {
            padding: 5px;
        }

        .italic {
            font-style: italic;
        }

        .sheet {
            overflow: hidden;
            position: relative;
            display: block;
            margin: 0 auto;
            box-sizing: border-box;
            page-break-after: always;
        }

        /** Paper sizes **/
        body.A3 .sheet {
            width: 297mm;
            height: 419mm
        }

        body.A3.landscape .sheet {
            width: 420mm;
            height: 296mm
        }

        body.A4 .sheet {
            width: 210mm;
            height: 296mm
        }

        body.struk .sheet {
            width: 100mm;
        }

        body.A4.landscape .sheet {
            width: 297mm;
            height: 209mm
        }

        body.A5 .sheet {
            width: 148mm;
            height: 209mm
        }

        body.A5.landscape .sheet {
            width: 210mm;
            height: 147mm
        }

        /** Padding area **/
        .sheet.padding-1mm {
            padding: 1mm
        }

        .sheet.padding-10mm {
            padding: 10mm
        }

        .sheet.padding-15mm {
            padding: 15mm
        }

        .sheet.padding-20mm {
            padding: 20mm
        }

        .sheet.padding-25mm {
            padding: 25mm
        }

        /** For screen preview **/
        @media screen {
            body {
                background: #e0e0e0
            }

            .sheet {
                background: white;
                box-shadow: 0 .5mm 2mm rgba(0, 0, 0, .3);
                margin: 5mm auto;
                display: block;
            }
        }

        /** Fix for Chrome issue #273306 **/
        @media print {
            body.A3.landscape {
                width: 420mm
            }

            body.A3,
            body.A4.landscape {
                width: 297mm
            }

            body.A4,
            body.A5.landscape {
                width: 210mm
            }

            body.A5 {
                width: 148mm
            }
        }

    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-3 body-main">
                <div class="col-md-12">
                    <div class="card shadow" id="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="dashboard-logo">
                                        <img src="{{url('/img/logo/yazfi.png ')}}" alt="Image" />
                                    </div>
                                </div>
                                <div class="col-md-8 text-right">
                                    <h6><strong>Fomulir:</strong></h6>
                                    <input type="checkbox" />
                                    <label style="font-size:.80em;">Material Delivered</label>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h2><span class="purchase-order">Purchase Order</span></h2>
                                </div>
                            </div> <br />
                            <div class="payment-details">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p style="font-size: 12px">Supplier/ Vendor :
                                            <a style="font-size: 12px">
                                                {{ $purchase->supplier->nama }}
                                            </a>
                                        </p style="font-size: 12px">
                                        <p style="font-size: 12px">Contact Person:
                                            <a style="font-size: 12px">
                                                {{ $purchase->admin->name }} -{{ $purchase->admin->phone_number }}
                                            </a>
                                        </p>
                                        <p style="font-size: 12px">Location :
                                            <a style="font-size: 12px">
                                                {{ $purchase->supplier->nama }}
                                            </a>
                                        </p>
                                        <p style="font-size: 12px">Delevery On Site :
                                            <a style="font-size: 12px">
                                                {{ $purchase->project->nama_project }}
                                                <p style="text-indent: 100px; margin-top:-10px;  font-size:12px;">
                                                    {{ $purchase->lokasi }}</p>
                                            </a>
                                        </p>
                                    </div>
                                    <div class="col-sm-6 tex-right">
                                        <div class="form-group">
                                            <p style="font-size: 12px">Date :
                                                <a style="font-size: 12px">
                                                    {{ Carbon\Carbon::parse($purchase->created_at)->format('d/m/Y') }}
                                                </a>
                                            </p>
                                            <p style="font-size: 12px">Contact Penerimaan:
                                                <a style="font-size: 12px">
                                                    {{ $purchase->admin->name }}-{{ $purchase->admin->phone_number }}
                                                </a>
                                            </p>
                                            <p style="font-size: 12px">PO Number :
                                                <a style="font-size: 12px">
                                                    {{ $purchase->invoice }}
                                                </a>
                                            </p>
                                            <p style="font-size: 12px">Project :
                                                <a style="font-size: 12px">
                                                    {{ $purchase->project->nama_project }}
                                                </a>
                                            </p>
                                            <p style="font-size: 12px">Project Code :
                                                <a style="font-size: 12px">
                                                    {{ $purchase->project->project_code }}
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered  report">
                                            <tr style="font-size:12px;" class="bg-success">
                                                <th class="text-light">Acc.</th>
                                                <th class="text-light">No.</th>
                                                <th class="text-light">Description</th>
                                                <th class="text-light">Qty</th>
                                                <th class="text-light">Unit</th>
                                                <th class="text-light">Unit price</th>
                                                <th class="text-light">Total Price</th>
                                            </tr>
                                            <tbody>
                                                @php
                                                $total = 0
                                                @endphp
                                                @foreach(App\Purchase::where('invoice', $purchase->invoice)->get() as
                                                $barang)
                                                <tr style="font-size:12px;">
                                                    <td class=" dynamic-hidden-col">
                                                    </td>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $barang->barang->nama_barang }}</td>

                                                    <td>{{ $barang->qty }}</td>

                                                    <td>{{ $barang->unit }}</td>
                                                    <td>@currency($barang->harga_beli)</td>
                                                    <td>@currency($barang->total)</td>

                                                </tr>
                                                @php
                                                $total += $barang->total
                                                @endphp
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr style="font-size:12px;">
                                                    <td></td>
                                                    <td colspan="4"></td>
                                                    <td>SUB TOTAL </td>
                                                    <td><b>@currency($total)</b></td>
                                                </tr>
                                                <tr style="font-size:12px;">
                                                    <td></td>
                                                    <td colspan="4"></td>
                                                    <td>PPN</td>
                                                    <td><b>{{ $purchase->PPN}}%</b></td>
                                                </tr>
                                                <tr style="font-size:12px;">
                                                    <td></td>
                                                    <td colspan="4"></td>
                                                    <td><strong>TOTAL<strong> </td>
                                                    <td><b>@currency($purchase->grand_total)</b></td>
                                                </tr>
                                                <tr style="font-size:12px;">
                                                    <td rowspan="20"></td>
                                                    <td colspan="4" rowspan="20">
                                                        <p class="text-left">Note :</p>
                                                    </td>
                                                    <td>
                                                        <p style="margin-top:20px;" class="text-center">PURCHASING</p>
                                                    </td>
                                                    <td>
                                                        <p class="text-center">MANAGER <br> PROCUREMENT </p>
                                                    </td>
                                                </tr>
                                                <tr style="font-size:12px;">
                                                    <td rowspan="2">
                                                        <p style="margin-top: 40px;" class="text-center m-b-2">
                                                            (............................)</p>
                                                    </td>
                                                    <td rowspan="2">
                                                        <p style="margin-top: 40px;" class="text-center m-b-2">
                                                            (............................)</p>
                                                    </td>
                                                </tr>
                                                <tr style="font-size:12px;">

                                                </tr>
                                                <tr style="font-size:12px;">
                                                    <td colspan="4">
                                                        <p class="text-center">DIRECTURE</p>
                                                    </td>
                                                </tr>
                                                <tr style="font-size:12px;">
                                                    <td colspan="4">
                                                        <p style="margin-top: 40px;" class="text-center m-b-2">
                                                            (............................)</p>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script>
        window.print()

    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>