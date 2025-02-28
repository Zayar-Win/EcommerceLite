<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Inertia\Inertia;

class SubscriberController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Subscribers/Index', [
            'subscribers' => Subscriber::filterBy(request()->all())->paginate(10)
        ]);
    }

    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();
        return back()->with('success', 'Subscriber deleted success.');
    }
}
