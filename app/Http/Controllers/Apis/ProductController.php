<?php

namespace App\Http\Controllers\Apis;

use App\Http\Requests\StoreProductRequest;
use App\Services\ProductService;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $service
    ) {}

    public function index()
    {
        return response()->json($this->service->list());
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->service->create($request->validated());

        return response()->json([
            'message' => 'Product created',
            'data' => $product
        ], 201);
    }
}