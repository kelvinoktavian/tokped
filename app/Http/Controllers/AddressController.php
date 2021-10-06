<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressRequest;
use App\Models\{Address, City, User, Province};

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->has_address == 0) {
            return redirect()
                ->route('address.create');
        }

        return view('address.index', [
            'title' => 'Address',
            'user' => $user,
            'provinces' => Province::all(),
        ]);
    }

    public function ajax($id)
    {
        $cities = City::where('province_id', $id)->pluck('city_name', 'id');
        return json_encode($cities);
    }

    public function ajax2($id)
    {
        $postal_code = City::where('id', $id)->pluck('postal_code');
        return json_encode($postal_code);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();

        if ($user->has_address == 1) {
            return redirect()
                ->route('address.index');
        }

        return view('address.create', [
            'title' => 'My Address',
            'provinces' => Province::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAddressRequest $request)
    {
        $user = auth()->user();

        Address::create(
            [
                'user_id' => $user->id,
                'province_id' => $request->input('province_id'),
                'city_id' => $request->input('city_id'),
                'street_name' => $request->input('street_name'),
                'postal_code' => $request->input('postal_code'),
            ]
        );

        $user = User::where(
            'username',
            $user->username
        )->update(
            [
                'has_address' => 1,
            ]
        );

        return redirect()
            ->route('address.index')
            ->with('success', 'Your address has been added successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAddressRequest $request, $id)
    {
        $address = Address::firstWhere('id', $id);

        $address->update(
            [
                'province_id' => $request->input('province_id'),
                'city_id' => $request->input('city_id'),
                'street_name' => $request->input('street_name'),
                'postal_code' => $request->input('postal_code'),
            ]
        );

        return redirect()
            ->route('address.index')
            ->with('success', 'Your address has been updated successfully');
    }
}
