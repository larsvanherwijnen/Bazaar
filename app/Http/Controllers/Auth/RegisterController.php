<?php

namespace App\Http\Controllers\Auth;

use App\Enum\RolesEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationFormRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RegisterController extends Controller
{


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(RegistrationFormRequest $request): RedirectResponse
    {
        if($request->validated()){
            DB::transaction(function () use ($request) {
                $user = User::create([
                    'name' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::Make($request->password),
                    'type' => RolesEnum::fromString($request->account_type),
                    'url' => $request->url ?? Str::slug($request->username),
                ]);


                if ($user->type == RolesEnum::BUSINESS) {
                    $company = new Company([
                        'name' => $request->companyName,
                        'kvk' => $request->kvk,
                    ]);

                    $user->company()->save($company);
                }
            });
        }

        return redirect()->route('login');
    }
}
