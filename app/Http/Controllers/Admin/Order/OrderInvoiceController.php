<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class OrderInvoiceController extends Controller
{
    public function showInvoice(Order $order)
    {
        $order  = Order::with(['orderProducts', 'country', 'user'])->where('id', $order->id)->first();
        return view('admin.orders.invoices.invoice', ['order' => $order]);
    }

    public function invoicePDF(Order $order)
    {
        $order  = Order::with(['orderProducts', 'country'])->where('id', $order->id)->first();

        $pdf    = Pdf::loadView('admin.orders.invoices.generate-pdf', ['order' => $order]);
        return $pdf->download(Carbon::now()->format('d-m-Y') . "-invoice#$order->id.pdf");
    }
}