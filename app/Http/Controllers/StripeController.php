<?php


namespace App\Http\Controllers;
//use Illuminate\Http\Client\Request;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Billable;
class StripeController extends Controller
{

    private $user =null;
    public function __construct()
    {
        $this->user = Auth::user();
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function createPaymentIntent()
    {
        $user = Auth::user();
        $intent=Cashier::findBillable($user->stripe_id);
      //  $intent=Cashier::findBillable('cus_J4SRKA3pae7MKf');
       // dd($intent->paymentMethods());
        echo json_encode(array('client_secret' => $intent->client_secret));
    }

    public function setPaymentMethod(Request $request)
    {
        $paymentMethod = $request->payment;
        $user = Auth::user();
        $stripeID = $user->stripe_id;
        Cashier::findBillable($stripeID)->addPaymentMethod($paymentMethod);
        return $this->createSubscription($stripeID);
    }
    public function createSubscription($stripeID)
    {
       $stripeCustomer = Cashier::findBillable($stripeID);
       $customerPaymentMethods = $stripeCustomer->paymentMethods();
       $customerPaymentMethod = $customerPaymentMethods[0]->asStripePaymentMethod();
        $stripeCustomer->newSubscription('default','price_1ISmcLAfWfA60FhKJUqaCs8b')->create($customerPaymentMethod);
        echo 'done';
    }

    public function updgradeSubscription()
    {

    }
}
