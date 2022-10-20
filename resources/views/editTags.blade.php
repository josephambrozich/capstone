<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <div style="float:right">By: <div style="">{{$ticket->author}}</div><br>
                </div>
                <form name="create-comment" id="create-comment" method="post" action="{{url('update-ticket-tags')}}">
                        @csrf
                            <div class="form-group">
                            <label for="exampleInputEmail1">Comment</label><br>
                            <input style="border: 1px solid #dfdbdb;width: 80%;margin: 5px;border-radius: 10px;padding: 10px;" value='{{$ticket->tags}}' type="text" id="tags" name="tags" class="form-control" required="">
                            <input type="text" id="ticketID" name="ticketID" style="display:none" value='{{$ticket->id}}'>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
            </div>
        </div>
    </div>
</x-app-layout>
