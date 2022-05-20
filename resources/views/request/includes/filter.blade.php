<form action="?">
    <select
            class="form-select mb-3"
            name="status"
            onChange="this.form.submit()"
    >
        <option selected value="">{{ __('Open this select menu') }}</option>
        @foreach ($statuses as $status)
            <option
                    value="{{ $status->value }}"
                    @if ($status->value === request('status')) selected @endif
            >
                {{ $status->name }}
            </option>
        @endforeach
    </select>
    <div class="form-check mb-3">
        <input
                type="checkbox"
                name="trashed"
                class="form-check-input"
                @if(request()->has('trashed')) checked @endif value="yes"
                onchange="this.form.submit()"
                id="trashed"
        >
        <label class="form-check-label" for="trashed">{{ __('Deleted') }}</label>
    </div>
</form>