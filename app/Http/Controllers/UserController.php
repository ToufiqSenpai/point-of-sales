<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    private array $validate_message =  [
        'required' => 'Harus diisi',
        'unique' => ':attribute sudah tersedia',
        'max' => ':attribute terlalu panjang'
    ];

    public function index(Request $request): View
    {
        $search = $request->query->get('search');
        $users = User::latest();

        if($search) {
            $users->where('name', 'like', "%$search%");
        }

        return view('user.index', [
            'users' => $users->paginate(10)
        ]);
    }

    public function create(): View
    {
        return view('user.create');
    }
    public function store(UserStoreRequest $req): RedirectResponse
    {
        $body = $req->all();
        $body['password'] = bcrypt($body['password']);

        $user = new User($body);
        $user->save();

        return redirect('/user')->with([
            'success' => 'User telah ditambahkan.'
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $user = User::find($request->get('id'));

        if($user) {
            $user->delete();
            return redirect('/user')->with(['success' => 'User berhasil dihapus']);
        } else {
            return redirect('/user')->with(['error' => 'User tidak ada']);
        }
    }

    public function edit(Request $request, string $id): View
    {
        return view('user.edit', [
            'user' => User::find($id)
        ]);
    }

    public function update(UserUpdateRequest $request): RedirectResponse
    {
        $body = $request->body;
        $user = User::find($body['id']);

        unset($body['id']);

        $user->update($body);

        return redirect('/user')->with(['success' => 'User ' . $user['username'] . ' berhasil diubah']);
    }
}
