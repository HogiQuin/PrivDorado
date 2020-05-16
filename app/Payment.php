<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'amount',
        'uri_file',
        'payment_status_id',
        'payment_type_id',
        'created_by',
        'authorized_by'
    ];

    public function paymentType () 
    {
        return PaymentType::find($this->payment_type_id);
    }

    public function createTransactions () 
    {
        $flag = true;
        try 
        {
            $config = Config::find(1);
            $main_amount = (int) $config->monthly_payment;
            $payment_amount = (int) $this->amount;
            $no_transactions = $payment_amount / $main_amount;

            $transactions_by_user = Transaction::where('user_id', '=', $this->created_by)->get();

            for($i = 0; $i < $no_transactions; $i++) 
            {
                $count_transactions = count($transactions_by_user) == 0 ? 1 : count($transactions_by_user) + 1;
                $month = Month::where('number', '=', $count_transactions + $i)->first();
                $transaction = new Transaction();
                $transaction->amount = $main_amount;
                $transaction->month_id = $month->id;
                $transaction->user_id = $this->created_by;
                $transaction->payment_id = $this->id;

                if(!$transaction->save()) $flag = false;
            }

            return $flag;

        } catch (Exception $ex) {
            return false;
        }
    }
}
