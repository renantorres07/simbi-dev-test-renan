<?php
namespace App\Http\Resources\Library;

use App\Core\Domain\Library\Entities\Book;
use Illuminate\Http\Resources\Json\JsonResource;

final class BookDetailsResource extends JsonResource
{
    public function __construct(private Book $book)
    {
    }

    public function toArray($request = null)
    {
        return [
            'id' => $this->book->id,
            'title' => $this->book->title,
            'publisher' => $this->book->publisher,
            'author' => (new AuthorDetailsResource($this->book->author))->resolve(),
        ];
    }
}