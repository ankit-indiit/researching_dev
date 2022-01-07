<?php

namespace App\Http\Controllers;

use App\Models\orders;
use Illuminate\Http\Request;
use PDF;

class OrderController extends Controller
{
    public function generateInvoice(Request $request,$id)
    {
        $order = orders::findOrFail($id);
          
        $pdf = PDF::loadView('pdf.invoice', $order);
    
        return $pdf->download('researching-order-invoice.pdf');        
    }
}
