@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
        <style>
            @media print {
                @page {
                    size: A4;
                    margin: 1cm;
                }
                body {
                    print-color-adjust: exact;
                    -webkit-print-color-adjust: exact;
                }
                .print-hidden {
                    display: none !important;
                }
                .shadow-lg {
                    box-shadow: none !important;
                }
            }
        </style>
        </head>
        <body class="bg-gray-100">
            <div class="min-h-screen p-8">
                <!-- Print/Download buttons -->
                <div class="print-hidden mb-4 flex gap-4 justify-end">
                    <button onclick="window.print()" class="flex items-center gap-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 9V2h12v7"></path>
                            <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                            <path d="M6 14h12v8H6z"></path>
                        </svg>
                        Print
                    </button>
                    <a href="{{ route('export.excel', $sender->id) }}" class="flex items-center gap-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Export to Excel
                    </a>
                    <a href="{{ route('invoice.print', $sender->id) }}" class="flex items-center gap-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Print Invoice
                    </a>
                  
                </div>
                <!-- Invoice Content -->
                <div class="bg-white p-8 shadow-lg">
                    <table id="invoice-table" class="w-full border-collapse border border-gray-300">
                        <div id="invoice-content">
                            <thead>
                                <tr>
                                    <th colspan="8" class="border border-gray-300 p-2 text-center bg-gray-50 font-bold text-lg">
                                        INVOICE & PACKING LIST
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="3" class="border border-gray-300 p-2">
                                        <div>COUNTRY OF ORIGIN: NEPAL</div>
                                        <div>INVOICE DATE: {{$sender->created_at }}</div>
                                        <div>INVOICE NO: {{ $invoice->number ?? 'INV-001' }}</div>
                                        <div>TOTAL Box: {{ $invoice->total_boxes ?? '2' }}</div>
                                    </td>
                                    <td colspan="4" class="border border-gray-300 p-2">
                                        @foreach($shipments as $shipment)
                                        <div>SHIPMENT VIA: {{ $shipment->shipment_via  }}</div>
                                        <div>ACTUAL WEIGHT: {{ $shipment->actual_weight }}</div>
                                        <div>Dimension: {{ $shipment->dimension }}</div>
                                        @endforeach
                                    </td>
                                </tr>
                                <!-- Shipper Details -->
                                <tr>
                                    <td colspan="3" class="border border-gray-300 p-2">
                                        <div class="font-bold">SHIPPER</div>
                                        <div>OM X. GLOBAL PVT. LTD. (TRADE NAME- PRIME GORKHA SER</div>
                                        <div>Sender Name : {{ $sender->senderName }}
                                        </div>
                                        <div>PAN NO: 615794828</div>
                                        <div>Aloknagor-310 Kathmandu</div>
                                        <div>Email: werep@primegorkha.com</div>
                                        <div>Phone: +977 9708072372</div>
                                    </td>
                                    <td colspan="4" class="border border-gray-300 p-2">
                                        <div class="font-bold">CONSIGNEE</div>
                                        @foreach($receivers as $receiver)
                                        <div>Name: {{ $receiver->receiverName }}</div> <!-- Adjust column name if needed -->
                                        <div>Phone: {{ $receiver->receiverPhone  }}</div>
                                        <div>Email: {{ $receiver->receiverEmail  }}</div>
                                        <div>Complete Address: {{ $receiver->receiverAddress  }}</div>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </div>
                        <div>
                            <table class="table-auto w-full border-collapse">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="border border-gray-300 p-2">BOXES</th>
                                        <th class="border border-gray-300 p-1">SR NO</th>
                                        <th class="border border-gray-300 p-2">DESCRIPTION</th>
                                        <th class="border border-gray-300 p-2">HS CODE</th>
                                        <th class="border border-gray-300 p-2">QUANTITY</th>
                                        <th class="border border-gray-300 p-2">UNIT RATE (US$)</th>
                                        <th class="border border-gray-300 p-2">AMOUNT (US$)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sender->boxes as $box)
                                    <tr>
                                        <!-- Merging box number with first column -->
                                        <td rowspan="{{ count($box->items) + 1 }}" class="border border-gray-300 p-2 text-center font-bold">
                                            {{ $box->box_number }}
                                        </td>
                                    </tr>
                                    @foreach($box->items as $index => $item)
                                    <tr>
                                        <td class="border border-gray-300 p-2">{{ $index + 1 }}</td>
                                        <td class="border border-gray-300 p-1">{{ $item->item }}</td>
                                        <td class="border border-gray-300 p-2">{{ $item->hs_code }}</td>
                                        <td class="border border-gray-300 p-2">{{ $item->quantity }}</td>
                                        <td class="border border-gray-300 p-2 text-right">{{ '$' . number_format($item->unit_rate, 2) }}</td>
                                        <td class="border border-gray-300 p-2 text-right ">{{ '$' . number_format($item->amount, 2) }}</td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                    <!-- Totals -->
                                    <tr>
                                        <td colspan="2" class="border border-gray-300 p-2 text-right font-bold"></td>
                                        <td colspan="2" class="border border-gray-300 p-2 text-right font-bold">Total Quantity</td>
                                        <td class="border border-gray-300 p-2">{{ $totalQuantity  ?? '18' }}</td>
                                        <td colspan="1" class="border border-gray-300 p-2  font-bold">Grand total</td>
                                        <td class="border border-gray-300 p-2 font-bold text-right "> $ {{$grandTotal ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="border border-gray-300 p-2">
                                        </td>
                                        <td colspan="2" class="border border-gray-300 p-2 font-bold"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="border border-gray-300 p-2">
                                            <div class="font-bold">NOTES</div>
                                            <div>We declare that the above mentioned goods are made in Nepal and other descriptions are true.</div>
                                        </td>
                                        <td colspan="4" flex flex justify-between class="border border-gray-300 p-2">
                                            <div class="font-bold flex justify-between items-center">
                                                <div>SIGNATURE</div>
                                                <span class="font-bold text-right">STAMP</span>
                                            </div>
                                            <div class="h-20"></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        </tbody>
                    </table>
                </div>
            </div>
    </div> <!-- container-fluid -->
</div>
<script>
    function printInvoice() {
        // Open a new window
        var printWindow = window.open('', '', 'width=800,height=600');
        // Add the invoice content dynamically to the new window
        var content = document.getElementById('invoice-content').innerHTML;
        printWindow.document.write('<html><head><title>Print Invoice</title><link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet"></head><body>');
        printWindow.document.write(content);
        printWindow.document.write('<script>window.onload = function() { window.print(); window.close(); };<\/script>');
        printWindow.document.write('</body></html>');
        printWindow.document.close(); // Close the document to ensure the content is properly loaded
    }
</script>
@endsection