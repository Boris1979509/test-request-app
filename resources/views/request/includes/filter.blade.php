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
</form>