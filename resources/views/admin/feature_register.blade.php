<form action="{{ route('admin.feature.create') }}" method="post">
@csrf

    <table class="border-separate border border-slate-500 min-w-full text-gray-50">
        <thead>
          <tr>
            <th class="border border-slate-600 w-96 bg-neutral-300 text-black">求人No.</th>
            <th class="border border-slate-600 w-96 bg-neutral-300 text-black">特徴</th>
            <th class="border border-slate-600 w-96 bg-neutral-300 text-black">編集</th>

        </tr>
        </thead>
        <tbody>

          <tr>
            <td class="border border-slate-600 w-96 text-center">
                <input class="text-black" type="text" name="offer_id" required>
            </td>

            <td class="border border-slate-600 w-96 text-center">
                <input class="text-black" type="text" name="name" required>
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
