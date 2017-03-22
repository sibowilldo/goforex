<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceFormRequest;
use App\Invoice;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Payment;
use App\Task;
use Unglued\LavaImage\Facades\LavaImage;

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
        return view('backend.invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Create new invoice
        $proof=null;
        return view('backend.invoices.create', compact('proof'));
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
        if($request->hasFile('proof')) {
            $fileHash = LavaImage::save($request->file('proof'));
            $request['proof']=$fileHash;
        }

        $request['password']=bcrypt($request['password']);
        $request['verified']=0;
        $request['code']=str_random(6);

        $invoice = Invoice::create($request->except(['proof']));

        // Save proof string if upload was successful
        if(isset($fileHash)) {
            $invoice->update(['proof'=>$fileHash]);
        }

        flash('New invoice has been added!', 'success');
        return redirect('/admin/invoices');
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
        return view('backend.invoices.show', compact('invoice'));
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
        $proof = null;

        if(!is_null($invoice->proof)) {
            $proof = LavaImage::getImage($invoice->proof);
        }

        return view('backend.invoices.edit', compact('invoice','proof'));
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
        if(strlen($request['password'])>6) {
            $request['password']=bcrypt($request['password']);
        } else {
            $request['password']=$invoice->password;
        }

        if($request->hasFile('proof')) {
            $fileHash = LavaImage::save($request->file('proof'));
            $request['proof']=$fileHash;
        }

        // Update other data except proof
        $invoice->update($request->except(['proof']));

        // Save proof string if upload was successful
        if(isset($fileHash)) {
            $invoice->update(['proof'=>$fileHash]);
        }

        flash('Invoice has been successfully updated!', 'success');
        return redirect('/admin/invoices');
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
        return redirect('/admin/invoices');
    }

    // Delete a invoice file
    public function deleteInvoiceFile($id)
    {
        $invoice = Invoice::where('proof',$id)->first();
        $invoice->update(['proof'=>null]);
        return redirect()->back();
    }

    // Pay an invoice and change status_is to 'Paid'
    public function payInvoice($id)
    {
        $invoice = Invoice::findOrFail($id);

        if($invoice->status_is=='Pending') {
            // Change status to 'Paid'
            $invoice->status_is='Paid';
            $invoice->update(['status_is']);

            // Create payment
            $payment = Payment::create([
                'user_id'=>$invoice->user_id,
                'invoice_id'=>$invoice->id,
                'status_is'=>'Paid',
                'amount'=>$invoice->amount,
            ]);

            if($payment) {
                // Create tasks from items of the invoice
                foreach ($invoice->items as $item) {
                    for ($x = 0; $x <= $item->quantity; $x++) {
                        if(!is_null($item->url)) {
                            $task = Task::create([
                                'name'=>$item->name,
                                'user_id'=>$invoice->user_id,
                                'status_is'=>'Queueing',
                                'item_is'=>$item->id,
                                'notes'=>$item->description,
                                'url'=>$item->url,
                            ]);
                        } else {
                            $task = Task::create([
                                'name'=>$item->name,
                                'user_id'=>$invoice->user_id,
                                'status_is'=>'Queueing',
                                'item_is'=>$item->id,
                                'notes'=>$item->description,
                            ]);
                        }
                    }
                }
            }

            flash('This Invoice payment has been successfully processed!', 'success');
        } else {
            flash('This Invoice has to be "Pending" to process its payment!', 'success');
        }

        return redirect()->back();
    }
}
