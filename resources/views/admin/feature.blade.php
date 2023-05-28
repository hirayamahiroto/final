<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{--　業界一覧 --}}
    <h2 class="text-gray-50">特徴一覧</h2>
    <table class="border-separate border border-slate-500 min-w-full text-gray-50">
        <thead>
          <tr>
            <th class="border border-slate-600 w-96 bg-neutral-300 text-black">求人登録企業No.</th>
            <th class="border border-slate-600 w-96 bg-neutral-300 text-black">特徴</th>
            <th class="border border-slate-600 w-96 bg-neutral-300 text-black">編集</th>
        </tr>
        </thead>
        <tbody>

            @foreach ($features as  $feature)
          <tr>
            <td class="border border-slate-600 w-96 text-center">{{ $feature->offer_id}}</td>
            <td class="border border-slate-600 w-96 text-center">{{ $feature->name}}</td>
            <td class="border border-slate-600 w-96 text-center">
                <div class="flex justify-center">
                    @include("admin.feature_delete")
                </div>
            </td>
          </tr>
        @endforeach
    </tbody>
    </table>

    <div>
        <h2 class="text-gray-50 mt-10">企業情報登録フォーム</h2>
        @include("admin.feature_register")
    </div>

</x-admin-layout>
