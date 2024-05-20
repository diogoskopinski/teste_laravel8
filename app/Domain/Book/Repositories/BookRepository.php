<?

namespace App\Domain\Book\Repositories;

use App\Domain\Book\Models\Book;

class BookRepository
{
    public function getAll()
    {
        return Book::all();
    }

    public function getById($id)
    {
        return Book::find($id);
    }

    public function create(array $data)
    {
        return Book::create($data);
    }

    public function update($id, array $data)
    {
        $book = Book::find($id);
        $book->update($data);
        return $book;
    }

    public function delete($id)
    {
        return Book::destroy($id);
    }
}
