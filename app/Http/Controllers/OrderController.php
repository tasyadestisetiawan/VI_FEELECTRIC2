<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Dompdf\Dompdf;
use Dompdf\Options;

class OrderController extends Controller
{
    public function print(Request $request)
    {
        $query = Order::query();

        if ($request->date) {
            $query->whereDate('created_at', $request->date);
        }

        if ($request->month) {
            $query->whereMonth('created_at', date('m', strtotime($request->month)))
                  ->whereYear('created_at', date('Y', strtotime($request->month)));
        }

        if ($request->year) {
            $query->whereYear('created_at', $request->year);
        }

        $orders = $query->get();

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($pdfOptions);
        $dompdf->loadHtml(view('admin.orders.print', compact('orders')));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return $dompdf->stream('orders.pdf');
    }
}
