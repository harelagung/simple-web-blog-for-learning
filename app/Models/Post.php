<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    // field yang bisa diisi
    // protected $fillable = ["title", "slug", "author", "body"];

    // field yang tidak dapat diisi
    protected $guarded = ["id"];

    // Agar tidak N + 1 Problem
    protected $with = ["author", "category"];

    // gunakan di model yang belongsTo

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Bisa mencari Post, Author, dan Category dalam 1 search bar
    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when($filters["search"] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query
                    ->where("title", "like", "%" . $search . "%")
                    ->orWhereHas(
                        "category",
                        fn(Builder $query) => $query
                            ->where("name", "like", "%" . $search . "%")
                            ->orWhere("slug", "like", "%" . $search . "%"),
                    )
                    ->orWhereHas(
                        "author",
                        fn(Builder $query) => $query
                            ->where("name", "like", "%" . $search . "%")
                            ->orWhere("username", "like", "%" . $search . "%"),
                    );
            });
        });

        // menggunakan 'Arrow Function'
        $query->when($filters["category"] ?? false, function ($query, $category) {
            return $query->whereHas("category", fn(Builder $query) => $query->where("slug", $category));
        });

        // menggunakan 'Arrow Function'
        $query->when($filters["author"] ?? false, function ($query, $author) {
            return $query->whereHas("author", fn(Builder $query) => $query->where("username", $author));
        });
    }
}
