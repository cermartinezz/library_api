<?php

namespace App\Http\Controllers;

use App\Models\Role;

class RoleController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->respondSuccess('Role List', ['roles' => Role::query()->get(['id','name'])]);
    }
}
