@extends('admin.layouts.main')

@section('content')
<div class="right_col" role="main">
    <h1>Inbox</h1>
    <p><a href="{{ route('admin.inbox.index', ['kind' => 'message']) }}">Messages</a> · <a href="{{ route('admin.inbox.index', ['kind' => 'subscription']) }}">Subscriptions</a></p>
    <div class="table-responsive"><table class="table table-striped">
        <thead><tr><th>Date</th><th>Name</th><th>Email</th><th>Message</th></tr></thead>
        <tbody>@forelse ($entries as $entry)
            <tr><td>{{ $entry->created_at }}</td><td>{{ $entry->name }}</td><td>{{ $entry->email }}</td><td style="white-space:pre-wrap">{{ $entry->message }}</td></tr>
        @empty <tr><td colspan="4">No {{ $kind === 'message' ? 'messages' : 'subscriptions' }} yet.</td></tr> @endforelse</tbody>
    </table></div>
    {{ $entries->links() }}
</div>
@endsection
