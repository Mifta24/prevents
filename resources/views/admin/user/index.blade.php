<x-app-layout>

    <form action="{{ route('admin.user.index') }}" method="get" class="d-flex align-items-center justify-content-end ">
        <input type="text" name="search" placeholder="Search event or ticket" value="{{ request('search') }}"
            class="search form-control" />
        <button type="submit" class="btn btn-search d-flex justify-content-center align-items-center p-0" type="button">
            <img src="{{ asset('assets') }}/images/ic_search.svg" width="20px" height="20px" />
        </button>

    </form>


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
            @forelse ($users as $user)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->occupation }}</td>
                    <td>
                        <form action="{{ route('admin.user.destroy',$user) }}" method="POST">
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

    {{ $users->links() }}
</x-app-layout>
