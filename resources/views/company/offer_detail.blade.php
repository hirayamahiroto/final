<x-company-layout>
    <div style="width:300px; border:1px solid white; background:whitesmoke; border-radius: 20px;">
        <form class="grid grid-cols-1 gap-6 m-16" style="width:80%; margin-inline:auto;" action="{{ route('company.offer_update', ['offer_id' => $offer->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <label class="block">
                <span class="text-black">求人名</span>
                <input type="text"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    name="name" value="{{ $offer->name }}">
            </label>

            <label class="block">
                <span class="text-black">給与</span>
                <input type="text"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    name="salary" value="{{ $offer->salary }}">
            </label>

            <label class="block">
                <span class="text-black">求人作成</span>
                <input type="text"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    value="{{ $offer->created_at }}" readonly>
            </label>

            <label class="block">
                <span class="text-black">給与</span>
                <input type="text"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    value="{{ $offer->updated_at }}" readonly>
            </label>

            <button type="submit" class="mt-4 px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-700" style="width:100px; height:35px; display:block; text-align:center; background: blue; font-weight:600;">更新</button>
        </form>
    </div>
</x-company-layout>
