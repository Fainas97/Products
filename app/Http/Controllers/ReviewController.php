<?php

namespace App\Http\Controllers;

use App\Review;
use App\Product;
use App\Rules\MaxWordsReview;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    private $review, $product;

    public function __construct(Review $review, Product $product)
    {
        $this->review = $review;
        $this->product = $product;
    }

    public function store(Request $request)
    {
        $this->product->findOrFail($request['product_id']);
        $dataValid = $this->validate($request, [
            'author' => 'required|max:30',
            'product_id' => 'required|numeric',
            'review' => ['required', new MaxWordsReview()]
        ]);

        
        $this->review->create($dataValid);
        $product = $this->product->with('review')->findOrFail($dataValid['product_id']);
        return \Redirect::route('review', $product);
    }
}
