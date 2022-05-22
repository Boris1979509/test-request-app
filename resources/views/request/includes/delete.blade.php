<form
        method="POST"
        action="{{ route('requests.destroy', $request->id) }}"
        onsubmit="return deleteItem({{ $request->id }})"
>
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger">{{ __('attribute.delete') }}</button>
</form>