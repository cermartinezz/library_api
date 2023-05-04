<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\BookCopy;
use App\Models\Checkout;
use App\Services\CheckoutService;
use Illuminate\Http\JsonResponse;

class CheckoutController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param CheckoutRequest $request
     * @param BookCopy $copy
     * @return JsonResponse
     */
    public function store(CheckoutRequest $request, BookCopy $copy): JsonResponse
    {
        $data = $request->validated();

        $copy_is_available = !Checkout::query()
            ->where('book_copy_id',$copy->id)
            ->where('returned',0)->exists();

        if(!$copy_is_available){
            return $this->respondBadRequest('The copy is already rented');
        }

        $checkout = CheckoutService::create($copy, $data['days']);

        return $this->respondCreated('The book has been rent', ['checkout' => $checkout]);
    }
}
