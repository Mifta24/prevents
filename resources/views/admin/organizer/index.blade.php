<x-app-layout>

    <form action="{{ route('admin.organizer.index') }}" method="get" class="d-flex align-items-center justify-content-end ">
        <input type="text" name="search" placeholder="Search event or ticket" value="{{ request('search') }}"
            class="search form-control" />
        <button type="submit" class="btn btn-search d-flex justify-content-center align-items-center p-0" type="button">
            <img src="{{ asset('assets') }}/images/ic_search.svg" width="20px" height="20px" />
        </button>

    </form>

    <a href="{{ route('admin.organizer.create') }}" class="btn btn-success m-3">Create New Event</a>
    <table class="table table-reponsive table-hover mx-3 my-3 w-80">
        <thead class="">
            <tr class="table-dark">
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Occupation</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>
            @forelse ($organizers as $organizer)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $organizer->name }}</td>
                    <td>{{ $organizer->email }}</td>
                    <td>{{ $organizer->occupation }}</td>
                    <td>
                        <form action="{{ route('admin.organizer.destroy',$organizer) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class=" btn btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <p>Data Kosong</p>
            @endforelse

        </tbody>
    </table>

    {{ $organizers->links() }}
</x-app-layout>
