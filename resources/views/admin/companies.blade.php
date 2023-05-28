<x-admin-layout>
    <h2 class="text-gray-50">登録企業一覧</h2>
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
        @foreach ($companies as $company)
          <tr>
            <td class="border border-slate-600 w-96 text-center">{{ $company->name }}</td>
            <td class="border border-slate-600 w-96 text-center">{{ $company->email }}</td>
            <td class="border border-slate-600 w-96 text-center">{{ $company->password }}</td>
            <td class="border border-slate-600 w-96 text-center">{{ $company->human_name }}</td>
            <td class="border border-slate-600 w-96">
                <div class="flex justify-center">
                    <a href="/admin/companies/{{ $company->id }}/edit" class="text-blue-600">編集</a>
                    <form action="/admin/companies/{{ $company->id }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600">削除</button>
                    </form>
                </div>
            </td>
          </tr>
        @endforeach
    </tbody>
    </table>

    <div>
        <h2 class="text-gray-50 mt-10">企業情報登録フォーム</h2>
        @include("admin.companies_register")
    </div>
</x-admin-layout>
