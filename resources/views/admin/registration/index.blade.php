<x-app-layout>

    <table class="table table-reponsive table-hover mx-3 my-3 w-80">
        <thead class="">
            <tr class="table-dark">
                <th scope="col">#</th>
                <th scope="col">Name Participant</th>
                <th scope="col">Event</th>
                <th scope="col">Ticket</th>
                <th scope="col">Payment Status</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>
            @forelse ($registrations as $registration)
                <tr>
                    <th scope="row">1</th>
                    <td>{{ $registration->user->name }}</td>
                    <td>{{ $registration->event->name }}</td>
                    <td>{{ $registration->ticket }}</td>
                    <td> <span class="bg-warning rounded-circle">{{ $registration->payment_status }}</span></td>
                    <td><a href="{{ route('admin.registration.show', $registration->id) }}"
                            class="btn btn-warning">Manage</a></td>
                </tr>
            @empty
            @endforelse
                <tr>
                    <td colspan="6" class=" text-center">Data Kosong</td>
                </tr>
        </tbody>
    </table>
</x-app-layout>
