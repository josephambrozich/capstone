<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Ticket;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Object_;

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


    public function search(StoreTicketRequest $request){
        //$tickets = Ticket::all()->orWhere('tags', 'like', '%'.$keywords->search.'%');
        $tickets = Ticket::all();
        $ans = [];
        $requestKeywords = explode(',', $request->search);
        foreach($tickets as $ticket){
            $ticketKeywords = explode(',', $ticket->tags);
            //go through each ticket keyword to see if they match
            if(count($requestKeywords) > count($ticketKeywords)){
                foreach($requestKeywords as $keywordA){
                    foreach($ticketKeywords as $keywordB){
                        if(str_contains(trim($keywordA), trim($keywordB))){
                            array_push($ans, $ticket);
                            continue;//end this iteration, the ticket has already been added
                        }
                    }
                }
            }else{
                foreach($ticketKeywords as $keywordB){
                    foreach($requestKeywords as $keywordA){
                        if(str_contains(trim($keywordA), trim($keywordB))){
                            array_push($ans, $ticket);
                            continue;//end this iteration, the ticket has already been added
                        }
                    }
                }
            }


            if(str_contains($ticket->tags, $request->search) ){
                array_push($ans, $ticket);
            }
        }
        $ans = array_unique(($ans));
        return view('search', ['tickets'=>$ans]);

    }

    public function searchAdv(StoreTicketRequest $request){
        //getting dates first revolves around knowing what queries to use for dateTime

        if(str_contains($request->status, 'open')){
            if(empty($request->dateStart) && empty($request->dateEnd)){
                $tickets = Ticket::all()->where('status','=','open');
            }
            else if(empty($request->dateStart)){
                $tickets = Ticket::all()->where('created_at','<', $request->dateEnd)->where('status','=','open');
            }
            else if(empty($request->dateEnd)){
                $tickets = Ticket::all()->where('created_at','>', $request->dateStart)->where('status','=','open');
            }
            else{
                $tickets = Ticket::all()->where('status','=','open')->where('created_at','<', $request->dateEnd)->where('created_at','>', $request->dateStart);
            }
        }
        else if(str_contains($request->status, 'resolved')){
            if(empty($request->dateStart) && empty($request->dateEnd)){
                $tickets = Ticket::all()->where('status','=','resolved');
            }
            else if(empty($request->dateStart)){
                $tickets = Ticket::all()->where('created_at','<', $request->dateEnd)->where('status','=','resolved');
            }
            else if(empty($request->dateEnd)){
                $tickets = Ticket::all()->where('created_at','>', $request->dateStart)->where('status','=','resolved');
            }
            else{
                $tickets = Ticket::all()->where('status','=','resolved')->where('created_at','<', $request->dateEnd)->where('created_at','>', $request->dateStart);
            } 
        }
        else if(str_contains($request->status, '')){
            if(empty($request->dateStart) && empty($request->dateEnd)){
                $tickets = Ticket::all();
            }
            else if(empty($request->dateStart)){
                $tickets = Ticket::all()->where('created_at','<', $request->dateEnd);
            }
            else if(empty($request->dateEnd)){
                $tickets = Ticket::all()->where('created_at','>', $request->dateStart);
            }
            else{
                $tickets = Ticket::all()->where('created_at','<', $request->dateEnd)->where('created_at','>', $request->dateStart);
            } 
        }

        


        //$tickets = Ticket::all();
        $ans = [];
        $requestKeywords = explode(',', $request->tagsInclude);

        //inclusive
        foreach($tickets as $ticket){
            $ticketKeywords = explode(',', $ticket->tags);
            //go through each ticket keyword to see if they match
            if(count($requestKeywords) > count($ticketKeywords)){
                foreach($requestKeywords as $keywordA){
                    foreach($ticketKeywords as $keywordB){
                        if(str_contains(trim($keywordA), trim($keywordB))){
                            array_push($ans, $ticket);
                            continue;//end this iteration, the ticket has already been added
                        }
                    }
                }
            }else{
                foreach($ticketKeywords as $keywordB){
                    foreach($requestKeywords as $keywordA){
                        if(str_contains(trim($keywordA), trim($keywordB))){
                            array_push($ans, $ticket);
                            continue;//end this iteration, the ticket has already been added
                        }
                    }
                }
            }


            if(str_contains($ticket->tags, $request->tagsInclude) ){
                array_push($ans, $ticket);
            }
        }
        $ans = array_unique(($ans));


        //exclude
        $excludeKeywords = explode(',', $request->tagsExclude);
        $excludeKeywords = array_filter($excludeKeywords);//remove empty array values

        //exclude with FOR I
        for ($i = 0; $i < count($ans); $i++) {
            for($j = 0; $j < count($excludeKeywords); $j++){
                if(str_contains(trim($ans[$i]), trim($excludeKeywords[$j]))){
                    //unset($ans[$i]);
                    $ans[$i]="";//unset gives some volatile results
                    $i=$i-1;
                }
            }
        }



        /*Done with query
        $before = date($request->dateStart);
        $after = date($request->dateEnd);

        for($i=0;$i<count($ans);$i++){
            if($before > $ans[$i]['created_at']){
                unset($ans[$i]);
                $i--;
            }
        }
        */

        $ans=array_filter($ans);
        return view('searchAdvRes', ['tickets'=>$ans]);

    }

    public function show(int $id)
    {
        //controller action typically returns view
        $ticket = $this->getTicketById($id);
        if ($ticket == null) {
            return view('dashboard');
        }

        $comments = Comment::all()->whereIn('ticketID', $id);


        return view('ticket', ['ticket'=> $ticket, 'comments'=>$comments, 'userRole'=> Auth::user()['role']]);
    }

    public function editTags(int $id)
    {
        //controller action typically returns view
        $ticket = $this->getTicketById($id);
        if ($ticket == null) {
            return view('dashboard');
        }

        //$comments = Comment::all()->whereIn('ticketID', $id);


        return view('editTags', ['ticket'=> $ticket, 'userRole'=> Auth::user()['role']]);
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


    public function updateTags(UpdateTicketRequest $request)
    {
        //Ticket::find($request->ticketID)->update(['tags' => $request->tags]);
        $ticket = $this->getTicketById($request->ticketID);
        $ticket->tags = $request->tags;
        $ticket->save();
        
        return view('dashboard');
    }


    public function resolve(int $id)
    {
       //Ticket::find($request->ticketID)->update(['tags' => $request->tags]);
       $ticket = $this->getTicketById($id);
       if(str_contains($ticket->status, 'open')){
        $ticket->status="resolved";
        $ticket->resolved_at=date('Y-m-d');
       }
       else{
        $ticket->status="open";
       }
       $ticket->save();
       
       return self::show($id);
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
