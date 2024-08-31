<x-app-layout>

    <div class="container mt-5">
        <h2 class="mb-4">Create Event</h2>
        <form action="{{ route('admin.event.update', $event) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Event Name -->
            <div class="mb-3">
                <label for="eventName" class="form-label">Event Name</label>
                <input type="text" name="name" class="form-control" id="eventName" placeholder="Enter event name"
                    value="{{ $event->name }}" required>
            </div>

            <!-- Event Date -->
            <div class="mb-3">
                <label for="eventDate" class="form-label">Event Date</label>
                <input type="datetime-local" name="date"
                    value="{{ \Carbon\Carbon::parse($event->date)->format('Y-m-d\TH:i') }}" class="form-control"
                    id="eventDate" required>
            </div>



            <!-- Event Time -->
            {{-- <div class="mb-3">
                <label for="eventTime" class="form-label">Event Time</label>
                <input type="time" class="form-control" id="eventTime" required>
            </div> --}}

            <!-- Event Location -->
            <div class="mb-3">
                <label for="eventLocation" class="form-label">Event Location</label>
                <input type="text" name="location" class="form-control" id="eventLocation"
                    placeholder="Enter event location" value="{{ $event->location }}" required>
            </div>

            <!-- Event Description -->
            <div class="mb-3">
                <label for="eventDescription" class="form-label">Event Description</label>
                <textarea class="form-control" name="description" id="eventDescription" rows="4"
                    placeholder="Enter event description" required>{{ $event->description }}</textarea>
            </div>

            <!-- Event Location -->
            <div class="mb-3">
                <label for="eventCapacity" class="form-label">Event Capacity</label>
                <input type="int" name="capacity" class="form-control" id="eventCapacity"
                    value="{{ $event->capacity }}" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Edit Event</button>
        </form>
    </div>


</x-app-layout>
