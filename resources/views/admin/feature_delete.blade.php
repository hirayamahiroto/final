
    <div class="flex justify-center">
        <form action="{{ route('admin.feature.destroy', $feature->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600">削除</button>
        </form>
    </div>
