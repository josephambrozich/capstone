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
                    You're logged in! <br>

                    <form name="search-tickets" id="search-tickets" method="post" action="{{url('search-query')}}">
                        @csrf
                            <div class="form-group">
                            <label for="exampleInputEmail1">Search</label><br>
                            <input style="border: 1px solid #dfdbdb;width: 80%;margin: 5px;border-radius: 10px;padding: 10px;" type="text" id="search" name="search" class="form-control" required="">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    <br>
                    <a href="{{ route('createPost') }}">Create A Post</a> <br>
                    <a href="{{ route('tickets') }}">View All Posts</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
