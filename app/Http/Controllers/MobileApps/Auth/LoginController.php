<?php

namespace App\Http\Controllers\MobileApps\Auth;

use App\Events\SendOtp;
use App\Models\Customer;
use App\Models\OTPModel;
use App\Services\SMS\Msg91;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function userId(Request $request, $type='password')
    {
        if(filter_var($request->user_id, FILTER_VALIDATE_EMAIL))
            return 'email';
        else
            return 'mobile';
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'user_id' => $this->userId($request)=='email'?'required|email|string|exists:customers,email':'required|digits:10|string|exists:customers,mobile',
            'password' => 'required|string',
        ], ['user_id.exists'=>'This account is not registered with us. Please signup to continue']);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($token=$this->attemptLogin($request)) {
            return $this->sendLoginResponse($this->getCustomer($request), $token);
        }
        return [
            'status'=>'failed',
            'token'=>'',
            'message'=>'Credentials are not correct'
        ];

    }


    protected function attemptLogin(Request $request)
    {
        return Auth::guard('customerapi')->attempt(
            [$this->userId($request)=>$request->user_id, 'password'=>$request->password]
        );
    }

    protected function getCustomer(Request $request){
        $customer=Customer::where($this->userId($request),$request->user_id)->first();
       // $customer->notification_token=$request->notification_token;
        $customer->save();
        return $customer;
    }

    protected function sendLoginResponse($user, $token){
        if($user->status==0){
            $otp=OTPModel::createOTP('customer', $user->id, 'login');
            $msg=str_replace('{{otp}}', $otp, config('sms-templates.login'));
           // Msg91::send($user->mobile,$msg);
            return ['status'=>'success', 'message'=>'otp verify', 'token'=>''];
        }
        else if($user->status==1)
            return ['status'=>'success', 'message'=>'Login Successfull', 'token'=>$token];
        else
            return ['status'=>'failed', 'message'=>'This account has been blocked', 'token'=>''];
    }


    /**
     * Handle a login request to the application with otp.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function loginWithOtp(Request $request){
        $this->validateOTPLogin($request);

        $user=Customer::where('mobile', $request->mobile)->first();
        
        if(!$user) {
            $user = $this->create($request->all());           
            $otp = OTPModel::createOTP('customer', $user->id, 'login');
            $msg = str_replace('{{otp}}', $otp, config('sms-templates.login'));
            $dltid=env('OTP_DLT_ID'); //get dlt id from env file
            event(new SendOtp($user->mobile, $msg,'login'));
            Msg91::send($user->mobile, $msg,$dltid);
            return ['status' => 'success', 'message' => 'Please verify OTP to continue'];
            }else {
                 
            $customerActive=Customer::where('mobile',$request->mobile)->first();
            
            // if($customerActive->id==3){
                
            // }
            
            
            if($customerActive->isactive ==1){
                if (!in_array($user->status, [0, 1]))
                return ['status' => 'failed', 'message' => 'This account has been blocked'];               
                $otp = OTPModel::createOTP('customer', $user->id, 'login');
                $msg = str_replace('{{otp}}', $otp, config('sms-templates.login'));
                $dltid=env('OTP_DLT_ID');  //get dlt id from env file
                event(new SendOtp($user->mobile, $msg,'login'));
                Msg91::send($user->mobile, $msg,$dltid);
            return ['status' => 'success', 'message' => 'Please verify OTP to continue'];
            }else{
                return ['status' => 'success', 'message' => 'You are inactive please contact to admin'];
            }
            
        }
    }


    protected function create(array $data)
    {
        return Customer::create([
            'password' => Hash::make($data['mobile']),
            'mobile'=>$data['mobile'],
        ]);
    }


    protected function validateOTPLogin(Request $request)
    {
        $request->validate([
            'mobile' => 'required|digits:10|string',
        ]);
    }


}
