<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Model\Owners;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Auth;
use Illuminate\Support\Str;
use DateTime;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showOwnerRegisterForm()
    {
        $script = [
            'js/auth/register.js',
        ];
        return view(
            'auth.owner.register',
            [
                'url'           => 'owner',
                'screen_title'  => '新規登録画面',
                'script'        => $script
            ]
        );
    }

    protected function createOwner(RegisterRequest $request)
    {
        $request->all();
        $profile_image_flg = $request['profile_image'] ? true : false;
        $owners = Owners::insertGetId([
            'owner_id'          => Str::random(32),
            'created_at'        => now(),
            'name'              => $request['name'],
            'address'           => $request['address'],
            'tel'               => $request['tel'],
            'email'             => $request['email'],
            'profile'           => $request['profile'],
            'profile_image_flg' => $profile_image_flg,
            'password'          => Hash::make($request['password']),
        ]);
        $this->createOwnerProfileImage($request['profile_image']);
        return redirect()->intended('register/owner');
    }

    protected function createOwnerProfileImage($file)
    {
        $insert_id = Owners::max('id');
        $profile_image_path = public_path('/storage/owner/profile/'.$insert_id);
        $file_name = 'pfrofile_img.jpg';
        $file->move($profile_image_path,$file_name);
    }
}
