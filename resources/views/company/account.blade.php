
<h2 class="text-gray-50">登録アカウント一覧</h2>

    <table class="border-separate border border-slate-500 min-w-full text-gray-50">
        <thead>
            <tr>
                <th class="border border-slate-600 w-96 bg-neutral-300 text-black">アカウント名</th>
                <th class="border border-slate-600 w-96 bg-neutral-300 text-black">パスワード</th>
                <th class="border border-slate-600 w-96 bg-neutral-300 text-black">メールアドレス</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($companyUsers as $companyUser)
            <tr>
                <td class="border border-slate-600 w-96 text-center">
                    {{ $companyUser->name }}
                </td>
                <td class="border border-slate-600 w-96 text-center">
                    {{ $companyUser->password }}
                </td>

                <td class="border border-slate-600 w-96 text-center">
                    {{ $companyUser->email }}
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
