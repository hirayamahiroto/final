<form action="/admin/companies" method="post">
@csrf

    <table class="border-separate border border-slate-500 min-w-full text-gray-50">
        <thead>
          <tr>
            <th class="border border-slate-600 w-96 bg-neutral-300 text-black">企業名</th>
            <th class="border border-slate-600 w-96 bg-neutral-300 text-black">メールアドレス</th>
            <th class="border border-slate-600 w-96 bg-neutral-300 text-black">パスワード</th>
            <th class="border border-slate-600 w-96 bg-neutral-300 text-black">代表取締役</th>
            <th class="border border-slate-600 w-96 bg-neutral-300 text-black">編集</th>

        </tr>
        </thead>
        <tbody>

          <tr>
            <td class="border border-slate-600 w-96 text-center">
                <input class="text-black" type="text" name="name">
            </td>
            <td class="border border-slate-600 w-96 text-center">
                <input class="text-black" type="text" name="email">
            </td>
            <td class="border border-slate-600 w-96 text-center">
                <input class="text-black" type="text" name="password">
            </td>
            <td class="border border-slate-600 w-96 text-center">
                <input class="text-black" type="text" name="human_name">
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
