<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\BankAccount;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$transactions = DB::table('transactions')
						->select('transactions.id',
							'transactions.payor_acc',
							'u1.name as payor_name',
							'transactions.payee_acc',
							'u2.name as payee_name',
							'transactions.amount')
						->join('users as u1', function($join) {
								$join->whereRaw(
									'u1.id IN (select user_id from bank_accounts 
										where bank_accounts.id = transactions.payor_acc)'
								); })
						->join('users as u2', function($join) {
								$join->whereRaw(
									'u2.id IN (select user_id from bank_accounts 
										where bank_accounts.id = transactions.payee_acc)'
								); })
						->orderBy('transactions.created_at','ASC')
						->get();
		
        return view ('transactions.index')->with('transactions', $transactions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$accounts = DB::table('bank_accounts')
            ->join('users', 'bank_accounts.user_id', '=', 'users.id')
            ->select('bank_accounts.id', 'users.name')
            ->get();
        return view('transactions.create')->with('accounts', $accounts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		// validate the input
		$input = $request->all();
		$balance = BankAccount::find($input['payor_acc'])->balance;
		$validator = Validator::make($request->all(), [
            'payor_acc' => 'required',
			'payee_acc' => 'required|different:payor_acc',
			'amount' => 'required|numeric|min:0|max:'.$balance,
			'description' => 'required'
        ]);
		if ($validator->fails()) {
            return redirect('transaction/create')
                        ->withErrors($validator)
                        ->withInput();
        }
		$validated = $validator->validated();
		
		$payor_acc = $validated['payor_acc'];
		$payee_acc = $validated['payee_acc'];
		$amount = $validated['amount'];
		
		// Posting to the database in a transaction
		DB::beginTransaction();
		$payor = BankAccount::find($payor_acc);
		$payee = BankAccount::find($payee_acc);

		$payor->update(["balance" => $payor->balance - $amount]);
		$payee->update(["balance" => $payee->balance + $amount]);
        Transaction::create($validated);
		
		DB::commit();
		
        return redirect('transaction')->with('success', 'Transaction posted to the system!');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$transaction = DB::table('transactions')
						->select('transactions.id',
							'transactions.payor_acc',
							'u1.name as payor_name',
							'transactions.payee_acc',
							'u2.name as payee_name',
							'transactions.amount',
							'transactions.description',
							'transactions.created_at',
							'transactions.updated_at')
						->join('users as u1', function($join) {
								$join->whereRaw(
									'u1.id IN (select user_id from bank_accounts 
										where bank_accounts.id = transactions.payor_acc)'
								); })
						->join('users as u2', function($join) {
								$join->whereRaw(
									'u2.id IN (select user_id from bank_accounts 
										where bank_accounts.id = transactions.payee_acc)'
								); })
						->where('transactions.id', $id)
						->get()->first();
								
        return view('transactions.show')->with('transaction', $transaction);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = Transaction::find($id);
        return view('transactions.edit')->with('transaction', $transaction);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$transaction = Transaction::find($id);
        $input = $request->all();
        $transaction->update($input);
        return redirect('transaction')->with('success', 'Transaction Updated!');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transaction::destroy($id);
        return redirect('transaction')->with('success', 'Transaction deleted from the system!');
    }
}
