<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Uploader;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Inertia\Inertia;

class PaymentController extends Controller
{

    public function __construct(public Uploader $uploader) {}
    public function index()
    {
        $payments = Payment::where('name', 'LIKE', '%' . request('search') . '%')->paginate(10);
        return Inertia::render('Admin/Payments/Index', [
            'payments' => $payments
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Payments/Create');
    }

    public function store()
    {
        $validatedData = request()->validate([
            'name' => ['required'],
            'username' => ['required'],
            'qr_code' => ['required'],
            'icon' => ['required'],
            'acc_number' => ['required'],
            'description' => ['nullable']
        ]);

        $qr_code = $this->uploader->upload($validatedData['qr_code'], 'screenshot');
        $validatedData['qr_code'] = $qr_code;
        $icon = $this->uploader->upload($validatedData['icon'], 'screenshot');
        $validatedData['icon'] = $icon;

        Payment::create($validatedData);
        return redirect(route('admin.payments.index'))->with('success', 'New Payment created.');
    }

    public function edit(Payment $payment)
    {
        return Inertia::render('Admin/Payments/Edit', [
            'payment' => $payment
        ]);
    }

    public function update(Payment $payment)
    {
        $validatedData = request()->validate([
            'name' => ['required'],
            'username' => ['required'],
            'qr_code' => ['required'],
            'icon' => ['required'],
            'acc_number' => ['required'],
            'description' => ['nullable']
        ]);

        $qr_code = $this->uploader->upload($validatedData['qr_code'], 'screenshot');
        $validatedData['qr_code'] = $qr_code;
        $icon = $this->uploader->upload($validatedData['icon'], 'screenshot');
        $validatedData['icon'] = $icon;

        $payment->update($validatedData);
        return redirect(route('admin.payments.index'))->with('success', 'Payment updated successful.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return back()->with('success', 'Payment delete successful.');
    }
}
