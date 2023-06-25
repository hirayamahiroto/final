<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <h2 class="text-gray-50">募集求人一覧</h2>
    <table class="border-separate border border-slate-500 min-w-full text-gray-50">
        <thead>
            <tr>
                <th class="border border-slate-600 w-96 bg-neutral-300 text-black">求人名</th>
                <th class="border border-slate-600 w-96 bg-neutral-300 text-black">給与</th>
                <th class="border border-slate-600 w-96 bg-neutral-300 text-black">応募ボタン</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($offers as $offer)
            <tr>
                <td class="border border-slate-600 w-96 text-center">{{ $offer->name }}</td>
                <td class="border border-slate-600 w-96 text-center">{{ $offer->salary }}</td>
                <td class="border border-slate-600 w-96 text-center">
                    <div class="flex justify-center">
                        @if (!Auth::guest() && in_array($offer->id, $offer_id))
                            <a href="{{ route('user.message', $offer->id) }}" class="text-gray-500">応募済み</a>
                        @elseif (!Auth::guest())
                            <form action="{{ route('offer.apply', $offer->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">応募する</button>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2 class="text-gray-50">応募済み求人</h2>
    <table class="border-separate border border-slate-500 min-w-full text-gray-50">
        <thead>
            <tr>
                <th class="border border-slate-600 w-96 bg-neutral-300 text-black">求人名</th>
                <th class="border border-slate-600 w-96 bg-neutral-300 text-black">メッセージ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($applications as $application)
            <tr>
                <td class="border border-slate-600 w-96 text-center">
                    {{ $application->offer->name }}
                </td>
                <td class="border border-slate-600 w-96 text-center">
                    <a href="{{ route('user.message', ['applied_id' => $application->id]) }}">チャットルームはこちら</a>
                </td>

            </tr>
            @endforeach
                    </tbody>
    </table>



</x-app-layout>
