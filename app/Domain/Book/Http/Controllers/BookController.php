<?php

namespace App\Domain\Book\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domain\Book\Repositories\BookRepository;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function index()
    {
        return response()->json($this->bookRepository->getAll());
    }

    public function show($id)
    {
        return response()->json($this->bookRepository->getById($id));
    }

    public function store(Request $request)
    {
        $data = $request->only(['name', 'isbn', 'value']);
        return response()->json($this->bookRepository->create($data));
    }

    public function update(Request $request, $id)
    {
        $data = $request->only(['name', 'isbn', 'value']);
        return response()->json($this->bookRepository->update($id, $data));
    }

    public function destroy($id)
    {
        $this->bookRepository->delete($id);
        return response()->json(['message' => 'Book deleted successfully']);
    }
}
