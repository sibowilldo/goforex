<?php

namespace App\Http\Controllers;

use App\Http\Requests\BankAccountFormRequest;
use Auth;
use App\BankAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'boss', 'profile']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('bank_accounts.index')->with('bank_accounts', BankAccount::get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('bank_accounts.create')
            ->with('statuses', BankAccount::$statuses)
            ->with('banks', BankAccount::$banks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BankAccountFormRequest $request)
    {
        //
        BankAccount::create($request->all());
        flash('Bank Account saved successfully', 'success');
        return redirect(route('bank_accounts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function show(BankAccount $bankAccount)
    {
        //
        return view('bank_accounts.show')->with('bank_account', $bankAccount);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(BankAccount $bankAccount)
    {
        //
        return view('bank_accounts.edit')->with('bank_account', $bankAccount)
            ->with('statuses', BankAccount::$statuses)
            ->with('banks', BankAccount::$banks);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function update(BankAccountFormRequest $request, BankAccount $bankAccount)
    {
        //
        $bankAccount->update($request->all());
        flash('Bank Account updated successfully', 'success');
        return redirect(route('bank_accounts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankAccount $bankAccount)
    {
        //
        $bankAccount->delete();
        flash('Bank Account deleted successfully', 'success');
        return redirect(route('bank_accounts.index'));

    }
}
