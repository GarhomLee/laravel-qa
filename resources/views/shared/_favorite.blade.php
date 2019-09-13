<form id="favorite-question-{{ $model->id }}" action="" method="post" style="display:none;">
    @csrf
    @if ($model->is_favorited)
        @method('DELETE')
    @endif
</form>