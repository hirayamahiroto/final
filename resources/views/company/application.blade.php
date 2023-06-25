
<x-company-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <h2 class="text-gray-50"> 求職者応募一覧</h2>
    <table class="border-separate border border-slate-500 min-w-full text-gray-50">
        <thead>
          <tr>
            <th class="border border-slate-600 w-96 bg-neutral-300 text-black">応募求人名</th>
            <th class="border border-slate-600 w-96 bg-neutral-300 text-black">メッセージ</th>
        </tr>
        </thead>
        <tbody>


 @foreach ($companies as $company)
    @foreach ($company->appliedOffers as $offer)
        @foreach ($applications as $application)
            @if ($offer->id === $application->offer_id)
                <tr>
                    <th class="border border-slate-600 w-96 bg-neutral-300 text-black">
                            {{ $offer->name }}
                    </th>
                    <th class="border border-slate-600 w-96 text-center">
                        <a href="{{ route('company.show', ['applied_id' => $application->id]) }}">
                            チャットルームはこちら
                        </a>
                    </th>
                </tr>
            @endif
        @endforeach
    @endforeach
@endforeach
            </tbody>
</table>

</x-company-layout>
