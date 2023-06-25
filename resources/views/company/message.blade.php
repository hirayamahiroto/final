<x-company-layout>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto shadow-lg rounded-lg" style="width:800px;">

        @if ($application && $application->offer)
    <!-- header -->
    <div class="px-5 py-5 flex justify-between items-center bg-white border-b-2">
        <div class="font-semibold text-2xl">
            <h2>応募求人名: {{ $application->offer->name }}</h2>
        </div>
        <div class="h-12 w-12 p-2 bg-yellow-500 rounded-full text-white font-semibold flex items-center justify-center"></div>
    </div>
@endif
        <!-- Chatting -->
        <div class="flex flex-row justify-between bg-white" style="width:800px;">

            <!-- message -->
            <div class="w-full px-5 flex flex-col justify-between" style="padding-inline: 10%;">
                <div class="flex flex-col mt-5">
                    <ul id="list_message">
                        @if ($messages)
    @forelse ($messages as $message)
        <li class="flex justify-start mb-4">
            @if ($message->sender == 'user')
                <div class="mr-2 py-3 px-4 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-black">
                    User:{{ $message->content }}
                </div>
            @elseif ($message->sender == 'company')
                <div class="mr-2 py-3 px-4 bg-red-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl" style="color:red;">
                    Compny:{{ $message->content }}
                </div>
            @else
                <div class="mr-2 py-3 px-4 bg-gray-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-black">
                    {{ $message->content }}
                </div>
            @endif
        </li>
    @empty
        <li>No messages available</li>
    @endforelse
@else
    <li>No messages available</li>
@endif



                                        </ul>
                </div>
                <div class="py-5">
                    <form class="py-5" method="post" action="{{ route('company.sendMessage', $application->id) }}">
                        @csrf
                        <input type="text" id="input_message" name="input_message" autocomplete="off" placeholder="メッセージを入力してください。" style="width:100%;" required>
                        <input type="hidden" name="application_id" value="{{ $application->id }}">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" style="display:block; margin-inline:auto;">送信</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</x-company-layout>
