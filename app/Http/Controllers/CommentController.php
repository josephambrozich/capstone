<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
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
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request)
    {
        $comment = new Comment;
        $comment->content = $request->content;
        $comment->ticketID = $request->ticketID;
        $comment->author = Auth::user()['email'];
        $comment->save();
        //return redirect('dashboard');
        return back();
    }

    public function answer($id){
        //Ticket::find($request->ticketID)->update(['tags' => $request->tags]);
        $comment = $this->getCommentById($id);
        if($comment->isSolution == 0){
        $comment->isSolution=1;
        }
        else{
        $comment->isSolution=0;
        }
        $comment->save();
        
        return back();
    }

    public function getCommentById(int $id): ?Comment
    {
        $comments = Comment::all();
        foreach ($comments as $comment) {
            if ($comment->id === $id) {
                return $comment;
            }
        }
        return null;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
