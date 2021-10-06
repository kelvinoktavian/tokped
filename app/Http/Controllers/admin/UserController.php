<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::where([
            ['name', '!=', NULL],
            [function ($query) use ($request) {
                if ($search = $request->search) {
                    $query
                        ->orWhere('username', 'LIKE', '%' . $search . '%')
                        ->orWhere('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('email', 'LIKE', '%' . $search . '%')
                        ->get();
                }
            }]
        ]);

        // Filter sort by
        if ($request->sortBy == 'usernameAsc') {
            $users = $users->orderBy('username', 'ASC');
        } elseif ($request->sortBy == 'usernameDesc') {
            $users = $users->orderBy('username', 'DESC');
        } elseif ($request->sortBy == 'latest') {
            $users = $users->orderBy('created_at', 'DESC');
        } elseif ($request->sortBy == 'oldest') {
            $users = $users->orderBy('created_at', 'ASC');
        } else {
            $users = $users->orderBy('created_at', 'DESC');
        }

        $users = $users
            ->paginate(20)
            ->withQueryString();

        return view('admin.user.index', [
            'title' => 'Users',
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create', [
            'title' => 'Add New User',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        if ($request->hasFile('image_path')) {
            $fileNameToStore = Parent::storeImage($request, 'user', 100, 100);
        } else {
            $fileNameToStore = 'default.png';
        }

        User::create(
            [
                'name' => ucwords($request->input('name')),
                'email' => $request->input('email'),
                'username' => $request->input('username'),
                'password' => Hash::make($request->input('password')),
                'is_admin' => $request->input('is_admin'),
                'image_path' => $fileNameToStore,
            ]
        );

        return redirect()
            ->route('user.index')
            ->with('success', 'Data has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        $user = User::firstWhere('username', $username);

        if ($user == NULL) {
            return redirect()
                ->route('user.index')
                ->with('error', 'User not found!');
        }

        return view('admin.user.show', [
            'title' => $user->name,
            'user' => $user
        ]);
    }
}
