<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Advanced Search') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form name="advancedSearch" id="advancedSearch" method="post" action="{{url('search-query-adv')}}">
                        @csrf
                            <div class="form-group">
                            <label for="exampleInputEmail1">Tags (include)</label><br>
                            <input type="text" id="tagsInclude" name="tagsInclude" class="form-control">
                            </div>
                            <br>
                            <div class="form-group">
                            <label for="exampleInputEmail1">Tags (exclude)</label><br>
                            <textarea name="tagsExclude" class="" ></textarea>
                            <br>
                            <label for="exampleInputEmail1">Start Date</label><br>
                            <input type="date" id="start" name="dateStart">
                            <br>
                            <label for="exampleInputEmail1">End Date</label><br>
                            <input type="date" id="start" name="dateEnd">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
