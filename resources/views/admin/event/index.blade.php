<x-app-layout>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <form action="{{ route('admin.event.index') }}" method="get" class="d-flex align-items-center justify-content-end ">
            <input type="text" name="search" placeholder="Search event or ticket"  value="{{ request('search') }}" class="search form-control" />
            <button type="submit" class="btn btn-search d-flex justify-content-center align-items-center p-0" type="button">
                <img src="{{ asset('assets') }}/images/ic_search.svg" width="20px" height="20px" />
            </button>

    </form>

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
                    <td class="d-flex"><a href="{{ route('admin.event.edit', $event) }}"
                            class="btn btn-warning me-2">Edit</a>
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

    {{ $events->links() }}
</x-app-layout>
