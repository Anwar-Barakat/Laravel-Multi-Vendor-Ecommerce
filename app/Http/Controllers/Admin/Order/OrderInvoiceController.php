<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class OrderInvoiceController extends Controller
{
    public function showInvoice(Order $order)
    {
        $order  = Order::with(['orderProducts', 'country', 'user'])->where('id', $order->id)->first();
        return view('admin.orders.invoice', ['order' => $order]);
    }
}