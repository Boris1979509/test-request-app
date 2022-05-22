@extends('layouts.main')

@section('content')
    <div class="justify-content-center">
        <h1>{{ __('attribute.requests') }}</h1>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @include('request.includes.filter', $statuses)
                    <div class="table-responsive">
                        <table class="table table-sm align-middle">
                            <thead class="table-light">
                            <tr>
                                <th scope="col">{{ __('attribute.id') }}</th>
                                <th scope="col">{{ __('attribute.name') }}</th>
                                <th scope="col">{{ __('attribute.email') }}</th>
                                <th scope="col">{{ __('attribute.message') }}</th>
                                <th scope="col">{{ __('attribute.comment') }}</th>
                                <th scope="col">{{ __('attribute.status') }}</th>
                                <th scope="col">{{ __('attribute.created_at') }}</th>
                                <th scope="col">{{ __('attribute.updated_at') }}</th>
                                <th scope="col">{{ __('attribute.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php /** @var Request $request */use App\Models\Request; @endphp
                            @forelse ($paginator as $request)
                                <tr class="@if($request->deleted_at) table-warning @endif">
                                    <th scope="row">{{ $request->id }}</th>
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
                                            <span class="badge text-bg-danger">{{ __('attribute.' . $request->status->value) }}</span>
                                        @else
                                            <span class="badge text-bg-success">
                                            {{ __('attribute.' . $request->status->value) }}
                                        </span>
                                        @endif
                                    </td>
                                    <td>{{ $request->created_at }}</td>
                                    <td>{{ $request->updated_at }}</td>
                                    <td>
                                        @if(is_null($request->deleted_at))
                                            @include('request.includes.delete', $request)
                                        @else
                                            @include('request.includes.restore', $request)
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-info">{{ __('message.the_list_of_requests_is_empty') }}</div>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
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
            number: "@lang('message.please_correct_the_errors_in_the_form')",
            confirm: "@lang('message.do_you_really_want_to_delete_this_item')",
            required: "@lang('message.this_field_is_required')"
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
