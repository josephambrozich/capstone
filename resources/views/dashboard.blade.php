<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                     <br>

                    <form name="search-tickets" id="search-tickets" method="post" action="{{url('search-query')}}">
                        @csrf
                            <div class="form-group">
                            <input style="border: 1px solid #dfdbdb;width: 80%;margin: 5px;margin-left:7%;border-radius: 10px;padding: 10px;" type="text" id="search" name="search" class="form-control" required="">
                            <button style=" margin: 5px;padding: 7px; border-radius: 12px;font-size: 20px; background-color: #CF5C36;color: white;" type="submit" class="btn btn-primary">Search</button>    
                        </div>
                           
                        </form>
                    <br>
                    
                    <a style="margin: 5px;margin-left:45%; padding: 7px;border-radius: 12px;font-size: 20px;background-color: inherit;color: #565656;filter: drop-shadow(5px 5px 5px lightgray);border: 1px solid #dfdbdb;" href="{{ route('tickets') }}">View All Posts</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
