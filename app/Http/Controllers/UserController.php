<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
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

    public function create()
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

        $message = [
            'required' => 'Harus diisi',
            'unique' => ':attribute sudah tersedia',
            'max' => ':attribute terlalu panjang'
        ];

        $validator = Validator::make($req->all(), $rules, $message);

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
}
