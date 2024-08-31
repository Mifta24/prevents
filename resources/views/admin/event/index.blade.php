<x-app-layout>
    <a href="{{ route('admin.event.create') }}" class="btn btn-success m-3">Create New Event</a>
    <table class="table table-reponsive table-hover mx-3 my-3 w-80">
        <thead class="">
            <tr class="table-dark">
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Organizer</th>
                <th scope="col">Location</th>
                <th scope="col">Capacity</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>
            @forelse ($events as $event)
                <tr>
                    <th scope="row">1</th>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->organizer->name }}</td>
                    <td>{{ $event->location }}</td>
                    <td>{{ $event->capacity }}</td>
                    <td>{{ $event->date }}</td>
                    <td class="d-flex"><a href="{{ route('admin.event.edit', $event) }}" class="btn btn-warning me-2">Edit</a>
                        <form action="{{ route('admin.event.destroy', $event) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
            @endforelse

        </tbody>
    </table>
</x-app-layout>
