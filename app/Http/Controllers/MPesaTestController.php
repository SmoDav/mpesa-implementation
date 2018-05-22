<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;
use SmoDav\Mpesa\Laravel\Facades\Simulate;

class MPesaTestController extends Controller
{
    /**
     * Simulate a C2B Request using a fake invoice number.
     *
     * @return \Illuminate\Http\Response
     */
    public function fakeInvoice()
    {
        $response = Simulate::request(2000)
            ->from(254708374149)
            ->usingReference('fakeInvoice')
            ->setCommand(CUSTOMER_PAYBILL_ONLINE)
            ->push();

        return response()->json([
            'response' => $response,
            'next' => 'Please check your ngrok endpoints and validate that ONLY the validate endpoint will be called'
        ]);
    }

    /**
     * Simulate a C2B Request using a real invoice number.
     *
     * @return \Illuminate\Http\Response
     */
    public function realInvoice()
    {
        $invoice = Invoice::first();

        if (!$invoice) {
            return response()->json([
                'error' => 'Please run php artisan db:seed to fake some invoices.'
            ]);
        }

        $response = Simulate::request($invoice->amount)
            ->from(254708374149)
            ->usingReference($invoice->number)
            ->setCommand(CUSTOMER_PAYBILL_ONLINE)
            ->push();

        return response()->json([
            'response' => $response,
            'next' => 'Please check your ngrok endpoints and validate that BOTH the validate and confirm endpoint will be called. Also check the Transactions table.'
        ]);
    }
}
