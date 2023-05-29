<form action="/admin/companies/{{ $company->id }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-red-600">削除</button>
</form>
