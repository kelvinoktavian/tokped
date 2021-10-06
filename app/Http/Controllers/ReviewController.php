<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Requests\StoreReviewRequest;

class ReviewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReviewRequest $request)
    {
        Review::create(
            [
                'user_id' => auth()->user()->id,
                'product_id' => $request->input('product_id'),
                'body' => $request->input('body'),
            ]
        );

        return redirect('product/' . $request->input('slug'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review = Review::where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->first();

        if ($review == NULL) {
            return back()->with('error', 'Data not found!');
        } else {
            $review->delete();
        }

        return back()->with('success', 'Your review has been deleted successfully');
    }
}
