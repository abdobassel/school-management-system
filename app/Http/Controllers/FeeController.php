<?php

namespace App\Http\Controllers;

use App\Fee;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFeesRequest;
use App\Repository\FeeRepositoryInterface;

class FeeController extends Controller
{
    protected $fee;
    public function __construct(FeeRepositoryInterface $fee)
    {
        $this->fee = $fee;
    }
    public function index()
    {
        return $this->fee->index();
    }


    public function create()
    {
        return $this->fee->create();
    }

    public function store(StoreFeesRequest $request)
    {
        return $this->fee->store($request);
    }


    public function show(Fee $fee)
    {
    }


    public function edit($fee_id)
    {
        return $this->fee->edit($fee_id);
    }

    public function update(StoreFeesRequest $request)
    {
        return $this->fee->update($request);
    }

    public function destroy(Fee $fee)
    {
    }
}
