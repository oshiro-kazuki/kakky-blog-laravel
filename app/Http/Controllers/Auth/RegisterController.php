<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Model\Owners;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectToReg   = RouteServiceProvider::OWNERREGISTER;  // リダイレクト先をオーナー登録画面を設定
    protected $redirectToLog   = RouteServiceProvider::OWNERLOGIN;     // リダイレクト先をオーナーログイン画面を設定

    public function __construct()
    {
        $this->max_length           = config('const.MAX_LENGTH');
        $this->password_regex       = config('const.PASSWORD_REGIX');
        $this->not_half_regex       = config('const.NOT_HALF_REGIX');
        $this->tel_regex            = config('const.TELL_REGIX');
        $this->input_text           = config('const.INPUT_TEXT_LENGTH');
        $this->image_upload_path    = config('const.IMAGE_PATH');
        $this->middleware('guest');
    }

    protected function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'company_name'          => 'required|string|max:'.$this->max_length,
            'address'               => 'required|string|max:'.$this->max_length.'|regex:'.$this->not_half_regex,
            'tel'                   => 'required|string|regex:'.$this->tel_regex,
            'email'                 => 'required|string|email|max:'.$this->max_length,
            'profile'               => 'string|nullable|max:'.$this->input_text,
            'image'                 => 'bail|file|max:3000|image|mimes:jpeg,png,jpg',
            'password'              => 'bail|required|string|confirmed|regex:'.$this->password_regex,
            'password_confirmation' => 'required|string|regex:'.$this->password_regex,
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

    protected function createOwner(Request $request)
    {
        $validator = $this->validator($request);
        if($validator->fails()){
            return redirect($this->redirectToReg)->withErrors($validator)->withInput();
        }

        $profile_image_flg = false;
        $request->all();
        if(!is_null($request['image'])){
            $profile_image_flg = true;
            $file = $request['image'];
            $this->createOwnerProfileImage($file);
        }
        Owners::insertGetId([
            'owner_id'          => Str::random(32),
            'created_at'        => now(),
            'name'              => $request['company_name'],
            'address'           => $request['address'],
            'tel'               => $request['tel'],
            'email'             => $request['email'],
            'profile'           => $request['profile'],
            'profile_image_flg' => $profile_image_flg,
            'password'          => Hash::make($request['password']),
        ]);
        return redirect()->intended($this->redirectToLog);
    }

    private function createOwnerProfileImage($file)
    {
        $insert_id = Owners::max('id') + 1;
        $profile_image_path = public_path($this->image_upload_path.$insert_id);
        $file_name = 'pfrofile_img.jpg';
        $file->move($profile_image_path,$file_name);
    }
}
