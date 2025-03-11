<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
    public function index()
    {
        return response()->json(
            Order::where('status', 'completed')
                ->with(['orderItems.menuItem'])
                ->orderBy('updated_at', 'desc')
                ->get()
        );
    }

    public function show(Order $order)
    {
        if ($order->status !== 'completed') {
            return response()->json(['message' => 'Order not found in history'], 404);
        }
        return response()->json($order->load(['orderItems.menuItem']));
    }

    public function getByDateRange(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);

        return response()->json(
            Order::where('status', 'completed')
                ->whereBetween('created_at', [$validated['start_date'], $validated['end_date']])
                ->with(['orderItems.menuItem'])
                ->orderBy('created_at', 'desc')
                ->get()
        );
    }
}