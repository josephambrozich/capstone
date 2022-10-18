<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Ticket;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;


class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {
        $ticket = new Ticket;
        $ticket->title = $request->title;
        $ticket->content = $request->description;
        //$ticket->author = $request->author;
        $ticket->author = Auth::user()['email'];
        //$ticket->agent = $request->agent;
        $ticket->agent = 'test user';
        $ticket->tags = $request->tags;
        $ticket->save();
        return redirect('/tickets');
    }
    



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */

    public function show(int $id)
    {
        //controller action typically returns view
        $ticket = $this->getTicketById($id);
        if ($ticket == null) {
            return view('dashboard');
        }

        $comments = Comment::all()->whereIn('ticketID', $id);


        return view('ticket', ['ticket'=> $ticket, 'comments'=>$comments]);
    }




    public function getTicketById(int $id): ?Ticket
    {
        $tickets = Ticket::all();
        foreach ($tickets as $ticket) {
            if ($ticket->id === $id) {
                return $ticket;
            }
        }
        return null;
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicketRequest  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }

    public function showList(){
        $data = Ticket::all();
        return view('tickets', ['tickets' => $data]);
    }

    public function toString(){
        return "I am a string";
    }
}
