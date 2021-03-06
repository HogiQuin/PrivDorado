<?php

namespace App\Http\Controllers;

use App\Config;
use App\Payment;
use App\PaymentStatus;
use App\PaymentType;
use App\User;
use Exception;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $paymentTypes = PaymentType::all();
        return view('payment.create', compact('paymentTypes'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'amount' => 'required',
            'file' => 'required'
        ]);

        $amount = $request->input('amount');
        $paymentType = $request->input('payment_type');
        $file = $request->file('file');
        $status = PaymentStatus::where('name', '=', 'PA')->first();

        try {
            $destinationPath = 'uploads';
            $date = date('Y-m-d-H-i-s');
            $newFileName = $date.auth()->user()->id.'.'.$file->getClientOriginalExtension();

            $payment = new Payment();
            $payment->amount = $amount;
            $payment->uri_file = '/'.$destinationPath.'/'.$newFileName;
            $payment->payment_type_id = $paymentType;
            $payment->created_by = auth()->user()->id;
            $payment->payment_status_id = $status->id;

            if($payment->save()) {
                $file->move($destinationPath, $newFileName);
                return redirect()->action('PaymentController@create')->with('message', 'Se registro el pago correctamente!');
            } else {
                return redirect()->action('PaymentController@create')->with('message', 'Ocurrio un error al registrar el pago!');
            }
            
            
        } catch (Exception $ex) {
            echo $ex;
        }

        
    }

    public function adminPayments(Request $request)
    {
        $month = isset( $request['month'] ) ?  $request['month']  : (int)date('m');
        $payments = Payment::whereMonth('created_at', '=', $month)->get();
        $ene = $month == 1 ? 'selected' : null;
        $feb = $month == 2 ? 'selected' : null;
        $mar = $month == 3 ? 'selected' : null;
        $abr = $month == 4 ? 'selected' : null;
        $may = $month == 5 ? 'selected' : null;
        $jun = $month == 6 ? 'selected' : null;
        $jul = $month == 7 ? 'selected' : null;
        $ago = $month == 8 ? 'selected' : null;
        $sep = $month == 9 ? 'selected' : null;
        $oct = $month == 10 ? 'selected' : null;
        $nov = $month == 11 ? 'selected' : null;
        $dec = $month == 12 ? 'selected' : null;
        

        $pArray = array();

        foreach($payments as $payment) {
            $user = User::where('id', '=', $payment->created_by)->first();
            $type = PaymentType::where('id', '=', $payment->payment_type_id)->first();
            $status = PaymentStatus::where('id', '=', $payment->payment_status_id)->first();
            $status_color = $status->name == 'PA' ? 'red' : 'green';
            $created_at = date_format($payment->created_at, 'D, d M Y H:i:s');

            $pObject = array(
                'id' => $payment->id,
                'user' => $user->name,
                'amount' => $payment->amount,
                'type' => $type->description,
                'status' => $status->description,
                'status_name' => $status->name,
                'status_color' => $status_color,
                'file' => $payment->uri_file,
                'date' => $created_at
            );

            array_push($pArray, $pObject);
        }

        return view('admin.payments.payments')->with([
            'payments' => $pArray,
            'ene' => $ene,
            'feb' => $feb,
            'mar' => $mar,
            'abr' => $abr,
            'may' => $may,
            'jun' => $jun,
            'jul' => $jul,
            'ago' => $ago,
            'sep' => $sep,
            'oct' => $oct,
            'nov' => $nov,
            'dec' => $dec,
        ]);
    }

    public function approvePayment(Request $request) 
    {
        $payment = Payment::find($request['payment_id']);
        $status = PaymentStatus::where('name', '=', 'A')->first();
        $error = false;
        
        $payment->payment_status_id = $status->id;
        $payment->authorized_by = auth()->user()->id;

        if($payment->paymentType()->name == 'PMM') 
        {
            $error = $payment->createTransactions();
        }
        else 
        {
            $error = true;
        }

        if($payment->save()) {

            
            if($error)
            {
                return redirect('/admin/payments/')
                ->with('status', 0)
                ->with('message', 'El pago se aprovo correctamente');
            }
            else 
            {
                return redirect('/admin/payments/')
                ->with('status', 0)
                ->with('message', 'El pago se aprovo correctamente, pero hubo un problema, por favor contacta al administrador');
            }
        } else {

            return redirect('/admin/payments/')
                    ->with('status', 1)
                    ->with('message', '** ERROR ** Ocurrio un error');
        }
    }
}


