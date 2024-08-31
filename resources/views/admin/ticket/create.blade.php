<x-app-layout>

    <div class="container mt-5">
        <h2 class="mb-4">Create Ticket</h2>
        <form action="{{ route('admin.ticket.store') }}" method="POST">
            @csrf
            @method('POST')
            <!-- ticket Name -->
            <div class="mb-3">
              <select name="event_id" id="">
                <option value="">Select your events</option>
                @forelse ( $events as $event)
                <option value="{{ $event->id }}">{{ $event->name }}</option>
                @empty

                @endforelse
              </select>
            </div>

            {{-- type Ticket --}}
            <div class="mb-3">
                <label for="typeTicket" class="form-label">Type Ticket</label>
                <input type="text" name="type" class="form-control" id="typeTicket" placeholder="Enter Type of ticket"
                    required>
            </div>

            <div class="mb-3">
                <label for="priceTicket" class="form-label">ticket Location</label>
                <input type="number" name="price" class="form-control" id="priceTicket" placeholder="Enter price of ticket"
                    required>
            </div>

            <div class="mb-3">
                <label for="available" class="form-label">ticket Location</label>
                <input type="number" name="available_ticket" class="form-control" id="available" placeholder="Enter Available of ticket"
                    required>
            </div>



            <!-- ticket Date -->
            <div class="mb-3">
                <label for="ticketDate" class="form-label">ticket Date</label>
                <input type="date" name="date" class="form-control" id="ticketDate" required>
            </div>


            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Create ticket</button>
        </form>
    </div>


</x-app-layout>
