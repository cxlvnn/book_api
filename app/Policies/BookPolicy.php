<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BookPolicy
{
    public function viewOrModify(User $user, Book $book): Response
    {
        return $user->id === $book->user_id ? Response::allow() : Response::denyAsNotFound();
    }
}
