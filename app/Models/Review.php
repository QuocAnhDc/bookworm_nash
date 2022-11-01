<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Review extends Model
{
    use Filterable;
    use HasFactory;

    public $timestamps = false;
    protected $table = 'review';

    protected $filterable = [
        'sort',
        'star'
    ];

    protected $casts = [
        'rating_start' => 'integer',
    ];
    public function Book()
    {
        return $this->belongsTo(Book::class);
    }

    public function scopeGroup($query, $book)
    {
        return $query
            ->where('book_id', $book)
            ->selectRaw("count(case when rating_start = 1 then 1 else null end) as one_star")
            ->selectRaw("count(case when rating_start = 2 then 1 else null end) as two_star")
            ->selectRaw("count(case when rating_start = 3 then 1 else null end) as three_star")
            ->selectRaw("count(case when rating_start = 4 then 1 else null end) as four_star")
            ->selectRaw("count(case when rating_start = 5 then 1 else null end) as five_star")
            ->selectRaw("count(rating_start) as count_star")
            ->selectRaw("ROUND(AVG(rating_start),2) as avg_star");
    }
    public function sortDesc($query)
    {
        return $query
            ->orderBy('review_date', 'DESC');
    }
    public function sortAsc($query)
    {
        return $query
            ->orderBy('review_date', 'ASC');
    }
    public function filterStar($query, $value)
    {
        if (is_numeric($value)) {
            if ($value == 0) {
                return $query
                    ->where(DB::raw('CAST(rating_start as INT)'),'>=',$value);
            }
            return $query
                ->where(DB::raw('CAST(rating_start as INT)'),'=',$value);
        }
        return $query;
    }
}
