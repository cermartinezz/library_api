<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\BookCopy;
use App\Services\CheckoutService;
use Illuminate\Http\JsonResponse;

class CheckoutController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param CheckoutRequest $request
     * @return JsonResponse
     */
    public function store(CheckoutRequest $request, BookCopy $copy): JsonResponse
    {
        $data = $request->validated();

        $checkout = CheckoutService::create($copy, $data['days']);

        return $this->respondCreated('The book has been rent', ['checkout' => $checkout]);
    }
}
