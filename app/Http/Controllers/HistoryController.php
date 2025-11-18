<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HistoryController extends Controller
{
    public function history(Request $request)
    {
        $user = Auth::user();

        $filter = $request->get('filter', 'today');

        if ($filter === 'today') {
            $transactions = $user->transactions()
                ->whereDate('created_at', Carbon::today())
                ->get();
        } elseif ($filter === 'week') {
            $transactions = $user->transactions()
                ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->get();
        } else { // month (default)
            $transactions = $user->transactions()
                ->whereMonth('created_at', Carbon::now()->month)
                ->get();
        }

        return view('profile.history', compact('user', 'transactions', 'filter'));
    }
}
