<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceFormRequest;
use App\Invoice;
use Auth;
use PDF;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class InvoicesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['boss','auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all invoices
        $invoices = Invoice::all();
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Create new invoice
        return view('invoices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceFormRequest $request)
    {
        // Save the new invoice
        $invoice = Invoice::create($request->all());
        flash('New invoice has been added!', 'success');
        return redirect('invoices');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        // Show invoice of $id
        $user = Auth::user();
        return view('view-invoice', compact('invoice','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        // Edit existing invoice
        return view('invoices.edit', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InvoiceFormRequest $request, Invoice $invoice)
    {
        // Update the existing invoice
        $invoice->update($request->all());
        flash('Invoice has been successfully updated!', 'success');
        return redirect('invoices');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        // Delete a invoice
        $invoice->delete();
        flash('Invoice has been deleted!', 'success');
        return redirect('invoices');
    }

    // Generate PDF invoice
    public function printInvoice($id)
    {
        // Get user info from Session
        $user = Auth::user();

        $invoice = Invoice::findOrFail($id);

        $data=['invoice'=>$invoice, 'user'=>$user];
        $pdf = PDF::loadView('pdf.invoice', $data);

        return $pdf->download($invoice->created_at->format('YmdHis').'-invoice-'.$invoice->id.'.pdf');
    }
}
