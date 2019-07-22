<?php

namespace App\Http\Controllers;

use App\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    private $rating;

    public function __construct(Rating $rating)
    {
        $this->rating = $rating;
    }

    public function index($id)
    {
        $rating = $this->rating->where('product_id', $id)->get();
        return response()->json(array('success' => true,
            'votes' => $rating->count(),
            'avg' => round($rating->avg('rating'))));
    }

    public function store(Request $request)
    {
        $id = $request->input('widget_id');
        $this->rating->product_id = $id;
        $this->rating->rating = $request->input('clicked_on');
        $this->rating->save();
        return $this->index($id);
    }
}
