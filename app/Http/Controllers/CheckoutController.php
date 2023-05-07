<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\BookCopy;
use App\Models\Checkout;
use App\Services\CheckoutService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CheckoutController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param CheckoutRequest $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $checkouts = Checkout::query()
            ->with(['copy.book'])
            ->where('user_id',$user->id)
            ->orderBy('returned')
            ->orderByDesc('end_date')
            ->get();

        return $this->respondCreated('User Checkouts', ['checkouts' => $checkouts]);
    }

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

        $copy_is_available = ! Checkout::query()
            ->where('book_copy_id',$copy->id)
            ->where('returned',0)->exists();

        if(! $copy_is_available){
            return $this->respondBadRequest('The copy is already rented');
        }

        $checkout = CheckoutService::create($copy, $data['days']);

        return $this->respondCreated('The book has been successfully rented', ['checkout' => $checkout]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CheckoutRequest $request
     * @param Checkout $checkout
     * @return JsonResponse
     */
    public function update(Request $request, Checkout $checkout): JsonResponse
    {
        if($checkout->returned){
            return $this->respondBadRequest('This copy is already returned');
        }

        if($checkout->user_id != $request->user()->id){
            return $this->respondBadRequest('This checkout dont belong to the user');
        }

        $checkout->update(['returned' => true]);

        return $this->respondSuccess('Book returned');
    }
}
