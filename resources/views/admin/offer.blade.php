<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{--　業界一覧 --}}
    <h2 class="text-gray-50">登録求人一覧</h2>
    <table class="border-separate border border-slate-500 min-w-full text-gray-50">
        <thead>
          <tr>
            <th class="border border-slate-600 w-96 bg-neutral-300 text-black">登録企業ID</th>
            <th class="border border-slate-600 w-96 bg-neutral-300 text-black">求人名</th>
            <th class="border border-slate-600 w-96 bg-neutral-300 text-black">給与</th>
            <th class="border border-slate-600 w-96 bg-neutral-300 text-black">編集</th>
        </tr>
        </thead>
        <tbody>

            @foreach ($offers as $offer)<tr>
                <td class="border border-slate-600 w-96 text-center">{{ $offer->company_id}}</td>
                <td class="border border-slate-600 w-96 text-center">{{ $offer->name}}</td>
            <td class="border border-slate-600 w-96 text-center">{{ $offer->salary}}</td>

            <td class="border border-slate-600 w-96 text-center">
                <div class="flex justify-center">
                    @include("admin.offer_delete")
                </div>
            </td>
          </tr>
        @endforeach
    </tbody>
    </table>


</x-admin-layout>
