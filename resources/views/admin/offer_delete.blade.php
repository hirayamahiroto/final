
    <div class="flex justify-center">
        <form action="{{ route('admin.offer.destroy', $offer->id) }}" method="POST" onsubmit="return confirm('この求人を本当に削除しますか？')">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600">削除</button>
        </form>
    </div>
