<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Enum;
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
    public function store(Request $req): RedirectResponse
    {
        $rules = [
            'name' => 'required|unique:users|max:255',
            'username' => 'required|unique:users|max:20',
            'password' => 'required|max:50',
            'email' => 'nullable|email:rfc,dns',
            'phone' => 'nullable'
        ];

        $validator = Validator::make($req->all(), $rules, $this->validate_message);

        if ($validator->fails()) {
            return redirect('/user/create')
                ->withErrors($validator)
                ->withInput();
        }
        $user_data = $validator->getData();
        $user_data['password'] = bcrypt($user_data['password']);

        $user = new User($user_data);
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

    public function update(Request $request): RedirectResponse
    {
        $rules = [
            'id' => 'required',
            'name' => 'required|max:255',
            'username' => 'required|max:20',
            'email' => 'nullable|email:rfc,dns',
            'phone' => 'nullable',
            'role' => [new Enum(UserRole::class), 'required']
        ];

        $validator = Validator::make($request->all(), $rules, $this->validate_message);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->getData();

        $user = User::find($data['id']);

        unset($data['id']);

        $user->update($data);

        return redirect('/user')->with(['success' => 'User ' . $user['username'] . ' berhasil diubah']);
    }
}
