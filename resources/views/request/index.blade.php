@extends('layouts.main')

@section('content')
    <div class="justify-content-center">
        <h1>{{ __('Requests') }}</h1>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @include('request.includes.filter', $statuses)
                    <table class="table table-light table-striped">
                        <thead>
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Message') }}</th>
                            <th>{{ __('Comment') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Created At') }}</th>
                            <th>{{ __('Updated At') }}</th>
                            <th>{{ __('Delete') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php /** @var Request $request */use App\Models\Request; @endphp
                        @forelse ($paginator as $request)
                            <tr>
                                <td>{{ $request->id }}</td>
                                <td>{{ $request->name }}</td>
                                <td>{{ $request->email }}</td>
                                <td>
                                    {{ $request->message }}
                                </td>
                                <td>
                                @if($request->isActive())
                                    @include('request.includes.update', $request)
                                @else
                                    {{ $request->comment }}
                                @endif
                                <td>
                                    @if($request->isActive())
                                        <span class="badge text-bg-danger">{{ __($request->status->value) }}</span>
                                    @else
                                        <span class="badge text-bg-success">
                                            {{ __($request->status->value) }}
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $request->created_at }}</td>
                                <td>{{ $request->updated_at }}</td>
                                <td>
                                    @include('request.includes.delete', $request)
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-info">{{ __('No requests') }}</div>
                        @endforelse
                        </tbody>
                    </table>
                    @if($paginator->total() > $paginator->count())
                        {{ $paginator->withQueryString()->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var trans = {
            number: "@lang('Please correct the errors in the form!')",
            confirm: "@lang('Do you really want to to delete this item?')",
            required: "@lang('This field is required')"
        };

        /**
         * Delete request
         */
        function deleteItem(id) {
            if (typeof id !== 'number') {
                alert(trans.number);
                return false;
            }
            return confirm(trans.confirm);
        }

        /**
         * Update request
         */
        function update(form) {
            var messageElement = form.querySelector('.text-danger');

            if (form.comment.value) {
                form.submit();
            } else {
                form.reset();
                if (messageElement) return;

                form.comment.classList.add('is-invalid');
                form.insertAdjacentHTML('beforeend', `<span class="text-danger">${trans.required}</span>`);
            }
        }
    </script>
@endpush
