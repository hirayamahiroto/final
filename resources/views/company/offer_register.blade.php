<form action="{{ route('company.offer.offer_create') }}" method="post">
    @csrf

    <!-- 隠しフィールド -->
    <input type="hidden" name="company_id" value="{{ Auth::id() }}">

    <table class="border-separate border border-slate-500 min-w-full text-gray-50">
        <thead>
            <tr>
                <th class="border border-slate-600 w-96 bg-neutral-300 text-black">求人名</th>
                <th class="border border-slate-600 w-96 bg-neutral-300 text-black">給与</th>
                <th class="border border-slate-600 w-96 bg-neutral-300 text-black">編集</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border border-slate-600 w-96 text-center">
                    <input class="text-black" type="text" name="name">
                </td>
                <td class="border border-slate-600 w-96 text-center">
                    <input class="text-black" type="text" name="salary" required>
                </td>
                <td class="border border-slate-600 w-96">
                    <div class="flex justify-center">
                        <input class="mx-6 bg-slate-900 text-center" value="登録" type="submit">
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</form>
