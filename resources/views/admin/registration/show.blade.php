<x-app-layout>
    <div class="container my-3">
        <h1>Manage Registration</h1>
        <div class="card mt-2">
            <div class="card-header">
                Registration Details
            </div>
            <div class="card-body">
            <p><strong>Participant Name:</strong> {{ $registration->participant->name }}</p>
                <p><strong>Event:</strong> {{ $registration->event->name }}</p>
                <p><strong>Ticket:</strong> {{ $registration->ticket->type }}</p>
                <p><strong>Amount:</strong> {{ $registration->payment->amount }}</p>
                <p><strong>Payment Method:</strong> {{ $registration->payment->payment_method }}</p>
                <p><strong>Payment Date:</strong> {{ $registration->payment->payment_date }}</p>
                <p><strong>Status:</strong> <span class="bg-success text-white p-1">{{ $registration->payment->status }}</span></p>

            </div>
        </div>
        @if (!$registration->payment_status=='paid')
        <div class="mt-3">
            <form action="{{ route('admin.registration.approve', $registration->id) }}" method="POST" style="display: inline-block;">
                @csrf
                <button type="submit" class="btn btn-success">Approve</button>
            </form>
            <form action="{{ route('admin.registration.reject', $registration->id) }}" method="POST" style="display: inline-block;">
                @csrf
                <button type="submit" class="btn btn-danger">Reject</button>
            </form>
        </div>
        @endif
    </div>
</x-app-layout>
