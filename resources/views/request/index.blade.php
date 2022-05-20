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