<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Services\InvoiceService;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;

class InvoiceController extends Controller
{
    protected $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $invoices = $this->invoiceService->getAll($request);
        return view('pages.invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $invoice = new Invoice();
        $data = $this->invoiceService->getInformationCraete();
        return view('pages.invoices.partials.form', array_merge(['invoice' => $invoice], $data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        $invoice = $this->invoiceService->store($request->validated());
        return redirect()->route('invoices.index')->with('success', __('invoice created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $data = $this->invoiceService->getInformationShow($invoice);
        return view('pages.invoices.partials.show', array_merge(['invoice' => $invoice], $data));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $data = $this->invoiceService->getInformationUpdate($invoice);
        return view('pages.invoices.partials.form', array_merge(['invoice' => $invoice], $data));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $this->invoiceService->update($request->validated(), $invoice);
        return redirect()->route('invoices.index')->with('success', __('invoice updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $this->invoiceService->delete($invoice);
        return redirect()->route('invoices.index')->with('success', __('invoice deleted successfully'));
    }
}
