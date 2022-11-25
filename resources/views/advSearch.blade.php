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
                            <input style="border: 1px solid #dfdbdb;width: 80%;margin: 5px;border-radius: 10px;padding: 10px;" type="text" id="tagsInclude" name="tagsInclude" class="form-control">
                            </div>
                            <br>
                            <div class="form-group">
                            <label for="exampleInputEmail1">Tags (exclude)</label><br>
                            <textarea style="border: 1px solid #dfdbdb;width: 80%;margin: 5px;border-radius: 10px;padding: 10px;" name="tagsExclude" class="" ></textarea>
                            <br>
                            <label for="exampleInputEmail1">Start Date</label><br>
                            <input style="border: 1px solid #dfdbdb;width: 80%;margin: 5px;border-radius: 10px;padding: 10px;" type="date" id="start" name="dateStart">
                            <br>
                            <label for="exampleInputEmail1">End Date</label><br>
                            <input style="border: 1px solid #dfdbdb;width: 80%;margin: 5px;border-radius: 10px;padding: 10px;" type="date" id="start" name="dateEnd">

                            <br>
                            <label for="exampleInputEmail1">Status</label><br>

                            <select style="border: 1px solid #dfdbdb;width: 80%;margin: 5px;border-radius: 10px;padding: 10px;" name="status" id="status">
                            <option value="">Any</option>
                            <option value="open">Open</option>
                            <option value="resolved">Resolved</option>
                            </select>
                            </div>
                            <br>
                            <button style=" margin: 5px;padding: 7px; border-radius: 12px;font-size: 20px; background-color: #CF5C36;color: white;" type="submit" class="btn btn-primary">Submit</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
