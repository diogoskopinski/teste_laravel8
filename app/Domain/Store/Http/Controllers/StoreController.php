<?php

namespace App\Domain\Store\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domain\Store\Repositories\StoreRepository;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    protected $storeRepository;

    public function __construct(StoreRepository $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    public function index()
    {
        return response()->json($this->storeRepository->getAll());
    }

    public function show($id)
    {
        return response()->json($this->storeRepository->getById($id));
    }

    public function store(Request $request)
    {
        $data = $request->only(['name', 'address', 'active']);
        return response()->json($this->storeRepository->create($data));
    }

    public function update(Request $request, $id)
    {
        $data = $request->only(['name', 'address', 'active']);
        return response()->json($this->storeRepository->update($id, $data));
    }

    public function destroy($id)
    {
        $this->storeRepository->delete($id);
        return response()->json(['message' => 'Store deleted successfully']);
    }
}
