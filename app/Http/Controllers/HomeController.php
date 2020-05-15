<?php

namespace App\Http\Controllers;

use App\House;
use App\Payment;
use App\PaymentStatus;
use App\PaymentType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = auth()->user()->id;
        $payments = Payment::where('created_by', '=', $id)->get();
        $paymentsArray = array();
        $house = House::where('user_id', '=', $id)->first();

        if(is_null($house)) 
        {
            return view('dashboard.home')->with(['no_house' => true]);
        }

        foreach($payments as $payment) {
            $id = $payment->id;
            $created_at = date_format($payment->created_at, 'D, d M Y H:i:s');
            $status = PaymentStatus::where('id', '=', $payment->payment_status_id)->first()->description;
            $type = PaymentType::where('id', '=', $payment->payment_type_id)->first()->description;
            $amount = $payment->amount;
            $file = $payment->uri_file;

            $paymentObj = array(
                'id' => $id,
                'created_at' => $created_at,
                'status' => $status,
                'status_color' => $type == 'PA' ? 'yellow' : 'green',
                'type' => $type,
                'amount' => $amount,
                'file' => $file
            );

            array_push($paymentsArray, $paymentObj);
        }
        return view('dashboard.home')->with([
            'payments' => $paymentsArray, 
            'balance' => $house->balance, 
            'no_house' => false
        ]);
    }
}
