<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get ticket
        $ticket = Ticket::latest()->paginate(5);
        //render view with posts
        return view('ticket.index', compact('ticket'));
    }

    public function create()
    {
        return view('ticket.create');
    }
    /**
     * store
     *
     * @param Request $request
     * @return void
     */

    public function store(Request $request)
    {
        //Validasi Formulir
        $this->validate($request, [
            'id_movie' => 'required',
            'class' => 'required',
            'price' => 'required'
        ]);


        //Fungsi Simpan Data ke dalam Database
        Ticket::create([
            'id_movie' => $request->id_movie,
            'class' => $request->class,
            'price' => $request->price,

        ]);
        try {
            return redirect()->route('ticket.index');
        } catch (Exception $e) {
            return redirect()->route('ticket.index');
        }
    }
    /**
     * edit
     *
     * @param int $id
     * @return void
     */
}
