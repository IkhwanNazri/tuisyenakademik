<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function downloadReceipt(Transaction $transaction)
    {
        // Pastikan hanya user yang berhak boleh akses
        if (Auth::id() !== $transaction->user_id) {
            abort(403);
        }
        $pdf = Pdf::loadView('pdf.receipt', compact('transaction'));
        return $pdf->download('resit-transaction-' . $transaction->id . '.pdf');
    }

    public function generateReceipt($id)
    {
        $transaction = Transaction::with('user')->findOrFail($id);
        
        $pdf = Pdf::loadView('pdf.receipt', compact('transaction'));
        
        return $pdf->stream('resit-pembayaran-' . $transaction->id . '.pdf');
    }
}
