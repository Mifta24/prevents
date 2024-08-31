<x-app-layout>
    <a href="{{ route('admin.ticket.create') }}" class="btn btn-success m-3">Create New Tickets</a>
    <table class="table table-reponsive table-hover mx-3 my-3 w-80">
        <thead class="">
            <tr class="table-dark">
                <th scope="col">#</th>
                <th scope="col">Event</th>
                <th scope="col">Type</th>
                <th scope="col">Price</th>
                <th scope="col">Available Quantity</th>
                <th scope="col">Create At</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>
            @forelse ($tickets as $ticket)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $ticket->event->name }}</td>
                    <td>{{ $ticket->type }}</td>
                    <td>{{ $ticket->price }}</td>
                    <td>{{ $ticket->available_quantity }}</td>
                    <td>{{ $ticket->created_at }}</td>
                    <td><a href="{{ route('admin.ticket.edit', $ticket) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.ticket.destroy', $ticket) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center text-bold">Data Kosong</td>
            </tr>
            @endforelse

        </tbody>
    </table>
</x-app-layout>
