<?php

namespace App\Http\Controllers\admin;

use App\Models\Carousel;
use App\Http\Controllers\Controller;
use App\Http\Requests\{StoreCarouselRequest, UpdateCarouselRequest};

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.carousel.index', [
            'title' => 'Carousels',
            'carousels' => Carousel::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.carousel.create', [
            'title' => 'Add Carousel',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarouselRequest $request)
    {
        $fileNameToStore = Parent::storeImage($request, 'carousel', 1400, 900);

        Carousel::create(
            [
                'title' => $request->input('title'),
                'body' => $request->input('body'),
                'image_path' => $fileNameToStore,
            ]
        );

        return redirect()
            ->route('carousel.index')
            ->with('success', 'Data has been added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carousel = Carousel::firstWhere('id', $id);

        if ($carousel == NULL) {
            return redirect()
                ->route('carousel.index')
                ->with('error', 'Data not found!');
        }

        return view('admin.carousel.edit', [
            'title' => 'Edit Carousel',
            'active' => 'carousel',
            'carousel' => $carousel
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarouselRequest $request, $id)
    {
        $carousel = Carousel::firstWhere('id', $id);

        if ($carousel == NULL) {
            return redirect()
                ->route('carousel.index')
                ->with('error', 'Data not found!');
        }

        if ($request->hasFile('image_path')) {
            $fileNameToStore = Parent::storeImage($request, 'carousel', 1400, 900);

            unlink('images/carousel/' . $carousel->image_path);

            $carousel->update(
                [
                    'title' => $request->input('title'),
                    'body' => $request->input('body'),
                    'image_path' => $fileNameToStore,
                ]
            );
        } else {
            $carousel->update(
                [
                    'title' => $request->input('title'),
                    'body' => $request->input('body')
                ]
            );
        }

        return redirect()
            ->route('carousel.index')
            ->with('success', 'Data has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carousel = Carousel::firstWhere('id', $id);

        if ($carousel == NULL) {
            return redirect()
                ->route('carousel.index')
                ->with('error', 'Data not found!');
        } else {
            unlink('images/carousel/' . $carousel->image_path);

            $carousel->delete();
        }

        return redirect()
            ->route('carousel.index')
            ->with('success', 'Data has been deleted successfully');
    }
}
