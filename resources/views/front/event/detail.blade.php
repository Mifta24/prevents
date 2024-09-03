<x-front-layout>
    <br>
    <br>
    <br>
    <!-- Event Detail Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <!-- Event Image and Overview -->
                <div class="col-lg-7 col-md-6">
                    <div class="wow fadeInUp" data-wow-delay="0.1s">
                        <img class="img-fluid w-100 mb-4" src="img/destination-2.jpg" alt="Event Image">
                        <h1 class="mb-4">{{ $event->name }}</h1>
                        <p>{{ $event->description }}</p>
                        <p class="text-muted"><i class="fa fa-map-marker-alt me-2"></i> {{ $event->location }}</p>
                        <p class="text-muted"><i class="fa fa-calendar-alt me-2"></i>
                            {{ \Carbon\Carbon::parse($event->date)->format('d F Y') }}</p>
                    </div>
                </div>

                <!-- Event Details and Buy Ticket -->
                <div class="col-lg-5 col-md-6">
                    <div class="wow fadeInUp" data-wow-delay="0.3s">
                        <h4 class="section-title bg-white text-primary px-3">Event Details</h4>
                        <div class="border rounded p-4 mt-4">
                            <ul class="list-unstyled">
                                <li class="mb-3"><strong>Date:</strong>
                                    {{ \Carbon\Carbon::parse($event->date)->format('d F Y, H:i') }}</li>
                                <li class="mb-3"><strong>Location:</strong> {{ $event->location }}</li>
                                <li class="mb-3"><strong>Capacity:</strong> {{ $event->capacity }}</li>
                                <li class="mb-3"><strong>Organizer:</strong> {{ $event->organizer->name }}</li>
                                <li class="mb-3"><strong>Available Tickets:</strong>
                                    <ul>
                                        @forelse ($event->tickets as $ticket)
                                            <li><span>{{ $ticket->type }}: </span>{{ $ticket->available_quantity }}</li>
                                        @empty
                                            <li>Ticket Kosong</li>
                                        @endforelse
                                    </ul>

                                </li>
                            </ul>
                            <a href="{{ route('registration', $event->slug) }}" class="btn btn-primary w-100 py-2">Buy
                                Ticket</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Event Detail End -->
</x-front-layout>
