<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\Shop;
use App\Models\VerificationToken;
use Carbon\Carbon;
use constDefaults;
use constGuards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use function Laravel\Prompts\password;

class SellerController extends Controller
{
    public function login(Request $request)
    {
        $data = [
            'pageTitle' => 'seller login'
        ];
        return view('back.pages.seller.auth.login', $data);
    }

    public function register(Request $request)
    {
        $data = [
            'pageTitle' => 'Create seller account'
        ];
        return view('back.pages.seller.auth.register', $data);

    }

    public function home(Request $request)
    {
        $data = [
            'pageTitle' => 'Create seller account'
        ];
        return view('back.pages.seller.home', $data);
    }

    public function createSeller(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:sellers',
            'password' => 'min:5|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:5',
        ]);
        $seller = new Seller();
        $seller->name = $request->name;
        $seller->email = $request->email;
        $seller->password = Hash::make($request->password);
        $saved = $seller->save();

        if ($saved) {
            $token = base64_encode(Str::random(64));
            VerificationToken::create([
                'user_type' => 'seller',
                'email' => 'seller',
                'token' => $token,
            ]);
            $actionLink = route('seller.verify', ['token' => $token]);
            $data['action_link'] = $actionLink;
            $data['seller_name'] = $request->name;
            $data['seller_email'] = $request->email;

            $mail_body = view('email-templates.seller-verify-template', $data)->render();
            $mailConfig = array(
                'mail_from_email' => env('EMAIL_FROM_ADDRESS'),
                'mail_from_name' => env('EMAIL_FROM_NAME'),
                'mail_recipient_email' => $request->email,
                'mail_recipient_name' => $request->name,
                'mail_subject' => 'Verify seller account',
                'mail_body' => $mail_body
            );
            if (sendEmail($mailConfig)) {
                return redirect()->route('seller.register-success');

            } else {
                return redirect()->route('seller.register')->with('fail', 'something went wrong while sending verification link');
            }
        } else {
            return redirect()->route('seller.register')->with('fail', 'something went wrong');
        }
    }

    public function verifyAccount(Request $request, $token)
    {
        $veifyToken = VerificationToken::where('token', $token)->first();
        if (!is_null($veifyToken)) {
            $seller = Seller::where('email', $veifyToken->email)->first();
            if (!$seller->verifed) {
                $seller->verified = 1;
                $seller->email_verified_at = Carbon::now();
                $seller->save();
                return redirect()->route('seller.login')->with('success', 'your email is verified');
            } else {
                return redirect()->route('seller.login')->with('info', 'your emails is now verified');
            }
        } else {
            return redirect()->route('seller.register')->with('fail' . 'invalid token');
        }
    }

    public function registerSuccess(Request $request)
    {
        return view('back.pages.seller.register-success');

    }

    public function loginHandler(Request $request)
    {
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if ($fieldType == 'email') {
            $request->validate([
                'login_id' => 'required|email|exists:sellers,email',
                'password' => 'required|min:5|max:45',
            ], [
                'login_id.required' => 'email or username is required',
                'login_id.email' => 'invalid email address',
                'login_id.exists' => ' email is not exist',
                'password.required' => ' password is  required',
            ]);
        } else {
            $request->validate([
                'login_id' => 'required|exists:sellers,username',
                'password' => 'required|min:5|max:45',
            ], [
                'login_id.required' => 'email or username is required',
                'login_id.exists' => ' username is not exist',
                'password.required' => ' password is  required',
            ]);
            $creds = array(
                $fieldType => $request->login_id,
                'password' => $request->password
            );
            if (Auth::guard('seller')->attempt($creds)) {
                if (!auth('seller')->user()->verified){

                    auth('seller')->logout();
                    return redirect()->route('seller.login')->with('fail','your account is not verifies');
                }else{
                    return redirect()->route('seller.home');

                }
            } else {
                return redirect()->route('seller.login')->withInput()->with('fail', 'incorrect credentials');
            }
        }
    }

    public function logoutHandler(Request $request)
    {
        Auth::guard('seller')->logout();
        return redirect()->route('seller.login')->with('fail', 'you are logged out');
    }

    public function forgotPassword(Request $request)
    {
    $data = [
        'pageTitle' => 'forfot password'
    ];
    return view('back.pages.seller.auth.forgot', $data);
    }
    public function sendPasswordResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:sellers,email'
        ], [
            'email.required' => 'email :attribute is required',
            'email.email' => 'invalid email address',
            'email.exists' => 'The :attribute is not exist to our system'
        ]);
        $seller = Seller::where('email', $request->email)->first();
        $token = base64_encode(Str::random(64));
        $oldToken = DB::table('password_reset_tokens')->where(['email' => $seller->email, 'guard' => constGuards::SELLER])->
        first();
        if ($oldToken) {
            DB::table('password_reset_tokens')->where(['email' => $seller->email, 'guard' => constGuards::SELLER])->update([
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        } else {
            DB::table('password_reset_tokens')->insert([
                'email' => $seller->email,
                'guard' => constGuards::SELLER,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        }
        $actionLink = route('seller.reset-password', ['token' => $token, 'email' => urlencode($seller->email)]);
        $data['actionLink'] = $actionLink;
        $data['seller'] = $seller;
        $mail_body = view('email-templates.seller-forgot-email-template', $data)->render();
        $emailConfig = array(
            'mail_from_email' => env('EMAIL_FROM_ADDRESS'),
            'mail_from_name' => env('EMAIL_FROM_NAME'),
            'mail_recipient_email' => $seller->email,
            'mail_recipient_name' => $seller->name,
            'mail_subject' => 'reset password',
            'mail_body' => $mail_body
        );
        if(sendEmail($emailConfig)){
            return redirect()->route('seller.forgot-password')->with('success','we have email to your password to link');
        }else{
            return redirect()->route('seller.forgot-password')->with('fail','something went wrong');
        }
    }

    public function showResetForm(Request $request,$token = null){
    $get_token = DB::table('password_reset_token')->where(['token' => $token,'guard'=> constGuards::SELLER])->first();

   if ($get_token){
    $diffMins = Carbon::createFromFormat('Y-m-d H:i:s',$get_token->created_at)->diffInMinutes(Carbon::now());
    if ($diffMins > constDefaults::tokenExpiredMinutes){
        return redirect()->route('seller.forgot-password')->with('fail','token expired');
    }else{
        return view('back.pages.seller.auth.reset')->with(['token' => $token]);
    }
   }else{
       return redirect()->route('seller.forgot-password',[$token => $token])->with('fail','invalid token');

   }
    }

    public function resetPasswordHandler(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:5|max:45|required_with:confirm_new_password|same:confirm_new_password',
            'confirm_new_password' => 'required'
        ]);
        $token = DB::table('password_reset_tokens')
            ->where(['token' => $request->token,'guard' => constGuards::SELLER])->first();
        $seller = Seller::where('email',$token->email)->first();
        Seller::where('email',$seller->email)->update([
            'password' => Hash::make($request->new_password)
        ]);
        DB::table('password_reset_tokens')->where([
            'email' => $seller->email,
            'token' => $seller->token,
            'guard' => constGuards::SELLER
        ])->delete();
        $data['seller'] = $seller;
        $data['new_password'] = $request->new_password;
        $mail_body= view('email-templates.seller-reset-email-template',$data);
        $mailConfig = array(
            'mail_from_email' => env('EMAIL_FROM_ADDRESS'),
            'mail_from_name' => env('EMAIL_FROM_NAME'),
            'mail_recipient_email' => $seller->email,
            'mail_recipient_name' => $seller->name,
            'mail_subject' => ' password changed',
            'mail_body' => $mail_body
        );
        sendEmail($mailConfig);
        return redirect()->route('seller.login')->with('success','your passwordhas been changed');

    }

    public function profileView(Request $request)
    {
        $data = [
            'pageTitle' => 'Profile'
        ];
        return view('back.pages.seller.profile',$data);
    }

    public function changeProfilePicture(Request $request)
    {
        $seller = Seller::findOrFail(auth('seller')->id());
        $path = 'images/users/sellers/';
        $file = $request->file('sellerProfilePictureFile');
        $old_picture = $seller->getAttributes('picture');
        $filename = 'SELLER_IMG_'.$seller->id.'.jpg';
        $upload = Kropify::getFile($file,$filename)->maxWoh(325)->save($path);
        $infos = $upload->getInfo();
        if($upload){
            if($old_picture != null && File::exists(public_path($path,$old_picture))){
                File::delete(public_path($path,$old_picture));
            }
            $seller->update(['picture' => $infos->getName]);
            return response()->json(['status' => 1,'msg' => 'your profile picture has successfully updated']);
        }else{
            return response()->json(['status' => 0,'msg' => 'something went wrong']);
        }
    }
    public function shopSettings(Request $request){
        $seller = Seller::findOrFail(auth('seller')->id());
        $shop = Shop::where('seller_id',$seller->id)->first();
        $shopInfo = '';
        if(!$shop){
            Shop::create(['seller_id' => $seller->id]);
            $nshop = Shop::where('seller_id', $seller->id)->first();
            $shopInfo = $nshop;
        }else{
            $shopInfo = $shop;
        }
        $data = [
            'pageTitle' => 'Shop Setting',
            'shopInfo' => $shopInfo
        ];
        return view('back.pages.seller.shop-settings',$data);
    }
    public function shopSetup(Request $request){
        $seller = Seller::findOrFail(auth('seller')->id());
        $shop = Shop::where('seller_id',$seller->id)->first();
        $old_logo_name = $shop->shop_logo;
        $logo_name = '';
        $path = 'images/shop/';

        $request->validate([
            'shop_name' => 'required|unique:shops,shop_name,'.$shop->id,
            'shop_phone' => 'required|numeric',
            'shop_address' => 'required',
            'shop_description' => 'required',
            'shop_logo' => 'nullable|mimes:jpg,jpeg,png',
        ]);
        if($request->hasFile('shop_logo')){
            $file = $request->file('shop_logo');
            $filename = 'SHOPLOGO_ '.$seller->id.uniqid().'.'.
                $file->getClientOriginalExtension();

                  $upload = $file->move(public_path($path),$filename);
                  if($upload){
                    $logo_name= $filename;

                    if($old_logo_name != null && File::exists(public_path($path.$old_logo_name))){
                        File::delete(public_path($path.$old_logo_name));
                    }
                  }
        }
        $data = array(
            'shop_name' => $request->shop_name,
            'shop_phone' => $request->shop_phone,
            'shop_address' => $request->shop_address,
            'shop_description' => $request->shop_description,
            'shop_logo' => $logo_name != null ? $logo_name : $old_logo_name

        );
        $update = $shop->update($data);
        if($update){
            return redirect()->route('seller.shop-settings')->with('success','your shop info has been updated');
        }else{
            return redirect()->route('seller.shop-setting')->with('fail','error on updating your shop info');
        }
      
    }



}
