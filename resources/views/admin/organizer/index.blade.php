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
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>@mdo</td>
            <td>@mdo</td>
            {{-- <td><a href="{{ route('admin.event.edit',$events) }}" class="btn btn-warning">Edit</a> <a href="{{ route('admin.event.destroy',$events) }}" class="btn btn-danger">Delete</a></td> --}}
          </tr>

        </tbody>
      </table>
</x-app-layout>

