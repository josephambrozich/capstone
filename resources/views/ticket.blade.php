<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <div style="float:right">By: <div style="">{{$ticket->author}}</div><br>
                    
                @if($userRole=='agent')
                    <a href='/ticket/{{$ticket->id}}/editTags'>Tags: <div style="color: #c9c6c6;">{{$ticket->tags}}</div><br></a>
                    <a href='/ticket/{{$ticket->id}}/resolve'><div style="color: #c9c6c6;">{{$ticket->status}}</div><a></div>
                @else
                    Tags: <div style="color: #c9c6c6;">{{$ticket->tags}}</div><br>
                    <div style="color: #c9c6c6;">{{$ticket->status}}</div></div>
                @endif
                <div style="font-size:25px">{{$ticket->title}}</div><br>
                    <div style="font-size:20px">{{$ticket->content}}</div><br>
                    
                    
                </div>

                <div class="p-6 bg-white border-b border-gray-200">
               
                 <ul style="list-style: none;">

                    @foreach ($comments as $comment)
                        @if($comment->isSolution)
                                <li style="border: 2px solid #266DD3;border-radius: 10px;font-size: inherit;padding: 10px;margin: 5px;">
                                <div>{{$comment->content}}</div> <br> <div style="color: #c9c6c6;">{{$comment->author}}</div>
                                @if($userRole=='agent')
                                        <a href='/comment/{{$comment->id}}/answer'><div style="color: #c9c6c6;float: right;margin: 0px;">Remove as solution</div><br></a>
                                    @endif
                            </li> 
                            
                        @else
                                <li style="border: 1px solid #dfdbdb;border-radius: 10px;font-size: inherit;padding: 10px;margin: 5px;">
                                <div>{{$comment->content}}</div> <br> <div style="color: #c9c6c6;">{{$comment->author}}</div>
                                    @if($userRole=='agent')
                                        <a href='/comment/{{$comment->id}}/answer'><div style="color: #c9c6c6;float: right;margin: 0px;">Mark as solution</div><br></a>
                                    @endif
                            </li> 
                            
                        @endif

                    
                        
                    @endforeach

                    
                    </ul>

                </div>
                <form name="create-comment" id="create-comment" method="post" action="{{url('store-comment')}}">
                        @csrf
                            <div style="margin: 24px;" class="form-group">
                            <label style="font-size: 20px; border-bottom: 2px solid #CF5C36; margin: 10px;" for="exampleInputEmail1">Leave A Comment</label><br>
                            <input style="border: 1px solid #dfdbdb;width: 80%;margin: 5px;border-radius: 10px;padding: 10px;" type="text" id="content" name="content" class="form-control" required="">
                            <input type="text" id="ticketID" name="ticketID" style="display:none" value='{{$ticket->id}}'>
                            </div>
                            <button style=" margin: 5px;padding: 7px; border-radius: 12px;font-size: 20px; background-color: #CF5C36;color: white;" type="submit" class="btn btn-primary">Submit</button>
                        </form>
            </div>
        </div>
    </div>
</x-app-layout>
