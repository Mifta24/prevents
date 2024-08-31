<x-app-layout>

    <div class="container mt-5">
        <h2 class="mb-4">Add New Organizer</h2>
        <form action="{{ route('admin.user.organizer') }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Event Name -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter event name" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>


</x-app-layout>
