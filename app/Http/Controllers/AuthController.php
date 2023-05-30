<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $repo;

    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
    }

    public function login(Request $request)
    {
        $cek = $this->repo->getUserByEmail($request->email);
        if ($cek !== null) {
            if (Hash::check($request->password, $cek->password)) {
                session()->put('auth', true);
                return redirect()->route("product-list");
            } else {
                return back()->with("error", "Email or password is wrong!");
            }
        }
    }

    public function logout() 
    {
        session()->flush();
        return redirect()->route('login');
    }
}
