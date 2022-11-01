<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
    use Filterable;
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'book';
    public $timestamps = false;

    protected $filterable = [
        'sort',
        'category',
        'author',
        'star'
    ];

    public function author()
    {
        // return $this->belongsTo(Author::class, 'author_id', 'id')->select('id','author_name','author_bio');
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class, 'book_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'book_id', 'id');
    }


    // Accessor for discount_price

    public function getDiscountPriceAttribute($value)
    {
        return $value !== null ? $value : 0;
    }

    public function scopeGroup($query)
    {
        return $query
            ->leftJoin('review', 'review.book_id', 'book.id')
            ->leftJoin('discount', 'discount.book_id', 'book.id')
            ->groupBy('book.id', 'discount.id')
            ->select('book.id', 'discount.discount_price', 'book.book_price', 'book.category_id', 'book.book_title', 'book.book_cover_photo', 'book.author_id', 'discount.discount_start_date', 'discount.discount_end_date');
    }

    public function scopeDetail($query)
    {
        return $query
            ->leftJoin('review', 'review.book_id', 'book.id')
            ->leftJoin('discount', 'discount.book_id', 'book.id')
            ->groupBy('book.id', 'discount.id')
            ->select('book.id',
                'discount.discount_price',
                'book.book_price',
                'book.category_id',
                'book.author_id',
                'book.book_title',
                'book.book_summary',
                'book.book_cover_photo',
                'discount.discount_start_date',
                'discount.discount_end_date');
    }

    // SORT

    public function sortSale($query)
    {
        return $query
            ->orderByRaw('CASE
                    WHEN (discount_end_date IS NULL AND DATE(NOW()) >= discount_start_date) THEN book_price - discount_price
                    WHEN (discount_end_date IS NOT NULL AND ( DATE(NOW()) >= discount_start_date AND DATE(NOW()) <= discount_end_date ) ) THEN book_price - discount_price
                    ELSE 0
                    END DESC')
            ->orderByRaw('CASE
                    WHEN (discount_end_date IS NULL AND DATE(NOW()) >= discount_start_date) THEN discount_price
                    WHEN (discount_end_date IS NOT NULL AND ( DATE(NOW()) >= discount_start_date AND DATE(NOW()) <= discount_end_date ) ) THEN discount_price
                    ELSE book_price
                    END ASC');
    }

    public function sortPopular($query)
    {
        return $query
            ->orderBy(DB::raw('COUNT(CAST(review.rating_start as INT))'),'DESC')
            ->orderByRaw('CASE
                    WHEN (discount_end_date IS NULL AND DATE(NOW()) >= discount_start_date) THEN discount_price
                    WHEN (discount_end_date IS NOT NULL AND ( DATE(NOW()) >= discount_start_date AND DATE(NOW()) <= discount_end_date ) ) THEN discount_price
                    ELSE book_price
                    END ASC');
    }

    public function sortDesc($query)
    {
        return $query
            ->orderByRaw('CASE
                    WHEN (discount_end_date IS NULL AND DATE(NOW()) >= discount_start_date) THEN discount_price
                    WHEN (discount_end_date IS NOT NULL AND ( DATE(NOW()) >= discount_start_date AND DATE(NOW()) <= discount_end_date ) ) THEN discount_price
                    ELSE book_price
                    END DESC');
    }

    public function sortAsc($query)
    {
        return $query
            ->orderByRaw('CASE
                    WHEN (discount_end_date IS NULL AND DATE(NOW()) >= discount_start_date) THEN discount_price
                    WHEN (discount_end_date IS NOT NULL AND ( DATE(NOW()) >= discount_start_date AND DATE(NOW()) <= discount_end_date ) ) THEN discount_price
                    ELSE book_price
                    END ASC');
    }

    public function sortRecommend($query)
    {
        return $query
            ->havingRaw("COALESCE(AVG(CAST(rating_start as INT)), 0) >= 0")
            ->orderByRaw("COALESCE(AVG(cast(rating_start as INT)), 0) desc");
    }

    // FILTER
    public function filterStar($query, $value)
    {
        if (is_numeric($value)) {
            return $query
                ->havingRaw("COALESCE(AVG(CAST(rating_start as INT)), 0) >= ?", [$value]);
        }
    }

    public function filterCategory($query, $value)
    {
        return $query->where('book.category_id', $value);
    }

    public function filterAuthor($query, $value)
    {
        return $query->where('book.author_id', $value);
    }
}
