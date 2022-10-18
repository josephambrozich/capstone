<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create A Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form name="create-ticket" id="create-ticket" method="post" action="{{url('store-ticket')}}">
                        @csrf
                            <div class="form-group">
                            <label for="exampleInputEmail1">Title</label><br>
                            <input type="text" id="title" name="title" class="form-control" required="">
                            </div>
                            <br>
                            <div class="form-group">
                            <label for="exampleInputEmail1">Description</label><br>
                            <textarea name="description" class="form-control" required=""></textarea>
                            <br>
                            <label for="exampleInputEmail1">Tags</label><br>
                            <textarea name="tags" class="form-control" required=""></textarea>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


