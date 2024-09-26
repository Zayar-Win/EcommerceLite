<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TicketController extends Controller
{

    public function index()
    {
        $tickets = Ticket::filterBy(request()->all())->paginate(10);
        return Inertia::render('Admin/Tickets/Index', [
            'tickets' => $tickets
        ]);
    }

    public function update(Ticket $ticket)
    {
        if ($ticket->status == 'completed') {
            return back()->with('warning', 'Your ticket is already completed.');
        }


        $ticket->update([
            'status' => 'completed'
        ]);

        return back()->with('success', 'Ticket is mark to complete.');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return back()->with('success', 'Ticket deleted successful.');
    }
}
