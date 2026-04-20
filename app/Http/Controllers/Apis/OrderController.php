<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        protected OrderService $service
    ) {}

    public function store(StoreOrderRequest $request)
    {
        $order = $this->service->create($request->validated());

        return response()->json([
            'message' => 'Order placed successfully',
            'data' => $order
        ]);
    }
}