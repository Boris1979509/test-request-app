<form action="{{ route('requests.update', $request, $request->id) }}" method="POST">
    @method('PUT')
    @csrf
    <div class="input-group">
        <input type="text" name="comment" class="form-control @error('comment') is-invalid @enderror"
               aria-label="Text input with checkbox">
        <div class="input-group-text">
            <input class="form-check-input mt-0" type="checkbox"
                   aria-label="Checkbox for following text input"
                   onChange="update(this.form)">
        </div>
        @error('comment')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</form>