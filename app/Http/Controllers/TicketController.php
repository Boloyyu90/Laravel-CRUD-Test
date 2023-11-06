<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Ticket;
use App\Models\Movie;
use Illuminate\Http\Request;

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
        $movie =  Movie::all();
        return view('ticket.create', compact('movie'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_movie' => 'required',
            'class' => 'required',
            'price' => 'required',
        ]);
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
     * @param  int $id 
     * @return void 
     */
    public function edit($id)
    {
        $ticket = Ticket::with('movie')->find($id);
        $movies = Movie::all();
        return view('ticket.edit', compact('ticket', 'movies'));
    }

    /** 
     * update 
     * 
     * @param  mixed $request 
     * @param  int $id 
     * @return void 
     */
    public function update(Request $request, $id)
    {
        //validate form 
        $this->validate($request, [
            'id_movie' => 'required|exists:movies,id',
            'class' => 'required',
            'price' => 'required',
        ]);
        $ticket = Ticket::with('movie')->find($id);

        $ticket->update([
            'id_movie' => $request->id_movie,
            'class' => $request->class,
            'price' => $request->price,
        ]);

        return redirect()->route('ticket.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /** 
     * destroy 
     * 
     * @param  int $id 
     * @return void 
     */
    public function destroy($id)
    {
        $ticket = Ticket::find($id);
        $ticket->delete();
        return redirect()->route('ticket.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
