<?php
   
namespace App\Http\Controllers\Auth;
   
use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use Exception;
use App\Models\User;
use App\Models\Degrees;
use App\Models\Universities;
use Illuminate\Http\Request;
use Session;

   
class GoogleSocialiteController extends Controller
{
	public $redirect_to;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
	{
	    if(!session()->has('redirect_to'))
		{
			session()->put('redirect_to', url()->previous()); 
		}
    }
	
    public function redirectToGoogle()
    {
        //redirect to google redirect method.
        return Socialite::driver('google')->redirect();
    }
       
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
            $socialuser = Socialite::driver('google')->stateless()->user();
        } catch (InvalidStateException $e) {
            dd($e);
        }
        $splitName = explode(' ', $socialuser->name, 2);
        $first_name = $splitName[0];
        $last_name = !empty($splitName[1]) ? $splitName[1] : '';
        //find user for login in db
        $finduser = User::where('provider_id', $socialuser->id)->first();
            if($finduser){
                Auth::login($finduser);
				$redirect_to = session()->get('redirect_to');
				session()->forget('redirect_to');
                return redirect()->intended($redirect_to);
     
            }else{ 
                $user = User::where('email', '=', $socialuser->email)->first();
                if ($user) {
                    $redirect_to = session()->get('redirect_to');
                    session()->forget('redirect_to');
                    return redirect()->intended($redirect_to)->with('social_errmsg', 'כתובת דוא"ל זו כבר קיימת. אנא השתמש בסיסמה לדוא"ל זה.');
                }
                else
                {
                    //if user not found
                    $newUser = User::create([
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'email' => $socialuser->email,
                        'provider_id'=> $socialuser->id
                    ]);  
                    $reffer_code = strtolower($newUser->first_name).$newUser->id.rand(100,999);
                    $newUser->reffer_code = $reffer_code;
                    $newUser->save ();                        
                    Auth::login($newUser);
                    return redirect()->route('front.getinstitute');
                }
            }
    
    
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFacebook()
    {
        //redirect to facebook redirect method.
        return Socialite::driver('facebook')->redirect();
    }
       
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
        try {
            $socialuser = Socialite::driver('facebook')->stateless()->user();
        } catch (InvalidStateException $e) {
            dd($e);
        }
        $splitName = explode(' ', $socialuser->name, 2);
        $first_name = $splitName[0];
        $last_name = !empty($splitName[1]) ? $splitName[1] : '';
        //find user for login in db
        $finduser = User::where('provider_id', $socialuser->id)->first();
        if($finduser){
                Auth::login($finduser);
                $redirect_to = session()->get('redirect_to');
                session()->forget('redirect_to');
                return redirect()->intended($redirect_to);
    
        }else{
            $user = User::where('email', '=', $socialuser->email)->first();
            if ($user) {
                $redirect_to = session()->get('redirect_to');
                session()->forget('redirect_to');
                return redirect()->intended($redirect_to)->with('social_errmsg', 'כתובת דוא"ל זו כבר קיימת. אנא השתמש בסיסמה לדוא"ל זה.');
            }
            else
            {                
                //if user not found
                $newUser = User::create([
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $socialuser->email,
                    'provider_id'=> $socialuser->id
                ]);
                $reffer_code = strtolower($newUser->first_name).$newUser->id.rand(100,999);
                $newUser->reffer_code = $reffer_code;
                $newUser->save ();                   
                Auth::login($newUser);
                return redirect()->route('front.getinstitute');
            }
        }
    
    }

    public function getinstitute(){
		if(!Auth::user()) return redirect('/');
        $id = Auth::user()->id;
        $university_name = '';
        $degree_id = '';
        $degrees_name = array();
        $degree_name = array();
        $users_data = User::select('academic_institution','student_degree')->where('id',$id)->get();
        foreach($users_data as $data){
            $degree_id = $data->student_degree;
            $university_id = $data->academic_institution;
        }
        if($degree_id != NULL){
            $degrees_name = Degrees::select('*')->where('id',$degree_id)->pluck('degree_name');
            $degree_name = $degrees_name[0];
        }
        
        return view('includes.getinstitute',compact('degree_id','university_id','degree_name'));
    }
    
    public function institute_update(Request $request){
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        $user->academic_institution = $request->profile_university;
        $user->student_degree = $request->profile_degree;
        $user->save();
		$redirect_to = session()->get('redirect_to');
		session()->forget('redirect_to');
		return redirect()->intended($redirect_to);
    }
}