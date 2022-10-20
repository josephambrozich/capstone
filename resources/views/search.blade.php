<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search Results') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul>
                   @foreach($tickets as $ticket)
                   <a href="/ticket/{{$ticket->id}}">
                    <li style="border: 1px solid gray;border-radius: 10px;margin: 10px;padding: 10px;">
                        <div style="font-size: 25px;font-weight: bold;">{{$ticket->title}}</div> 
                        <div>{{$ticket->author}}</div>
                        <div style="color:#c9c6c6">{{$ticket->tags}}</div>
                </li></a>
                   @endforeach
                   </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
