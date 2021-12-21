<?php

namespace App\Http\Controllers;
//require_once('stripe-php-sdk/init.php');

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Stripe\Error\Card;
use Cartalyst\Stripe\Stripe;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentMethodController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_payment_card(Request $request)
    {
        $userid = Auth::user()->id;
        if(!empty($request->card_number)){

            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                try {
                    $token = \Stripe\Token::create([
                        'card' => [
                        'number' => $request->card_number,
                        'exp_month' => $request->expiry_month,
                        'exp_year' => $request->expiry_year,
                        'cvc' => $request->cvv_number
                        ],
                    ]);
                    if (!isset($token['id'])) {
                        $data['status'] = 0;
                        $data['msg'] = "Stripe token not created.";
                    }

                    $customer = \Stripe\Customer::create(array(
                        'name' => Auth::User()->first_name.' '.Auth::User()->last_name,
                        'email' => Auth::User()->email,
                        'source' => $token['id']
                    ));

                    if (!empty($customer) && !empty($customer["id"])) {
                        $customerId = $customer["id"];
                        $stripe_card_id = $customer["default_source"];
                        $last_four = substr($request->card_number,-4);
                        $user_data = array(
                            'user_id' => Auth::id(),
                            'card_number' => $last_four,
                            'card_holder_name' => $request->holder_name,
                            'card_type' => $request->card_type,
                            'customer_id' => $customerId,
                            'stripe_card_id' => $stripe_card_id
                        );
                        if(!empty($request->card_id)){
                            $update = DB::table('card_details')->insert($user_data);
                            $data['msg'] = 'Card added successfully.';
                        }
                        else{
                            $user_data['is_default'] = 1;
                            $update = DB::table('card_details')->where('is_default','0')->where('user_id', Auth::id())->update($user_data);
                            $update = DB::table('card_details')->insert($user_data);
                            $data['msg'] = 'Card added successfully.';
                        }
                        $data['status'] = 1;
                        $data['card_id'] = $update;
                    }
                    else {
                        $data['msg'] = $this->response->responseServerError();
                        $data['status'] = 0;
                    }
                }
                catch (Exception $e) {
                    $data['msg'] = $e->getMessage();
                    $data['status'] = 0;
                } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
                    $data['msg'] = $e->getMessage();
                    $data['status'] = 0;
                } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                    $data['msg'] = $e->getMessage();
                    $data['status'] = 0;
                }

        }
        else{
            $data['status'] = 0;
            $data['msg'] = " שגיאה בהוספת כרטיס, נסה מאוחר יותר. ";
        }
        return response()->json(['success' => true, 'value' => $data,'user_data' => $user_data]);
    }

     public function remove_payment_card(Request $request){
        if(!empty($request->card_id)){
            $deleted_card = DB::table('card_details')->select('*')->where('id',$request->card_id)->first();
            if($deleted_card->is_default == '1'){
                $rest_of_cards = DB::table('card_details')->where('user_id',Auth::id())->orderBy('id','DESC')->get();
                if(count($rest_of_cards) > 0){
                    $last_card_id = $rest_of_cards[0]->id;
                    $update = DB::table('card_details')->where('id', $last_card_id)->update(array('is_default' => 1));
                }
            }
            $delete = DB::table('card_details')->where('id', $request->card_id)->delete();
            $data['msg'] = ' הכרטיס הוסר בהצלחה. ';
            $data['status'] = 1;
        }
        else{
            $data['status'] = 0;
        }
        return response()->json(['success' => true, 'value' => $data]);
    }
}
