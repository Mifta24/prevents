<x-front-layout>
    <br>
    <br>
    <!-- My Tickets Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">My Tickets</h6>
                <h1 class="mb-5">Your Event Tickets</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    @forelse ($registrations as $registration)
                        <div class="card mb-4 shadow-lg border-0 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="card-body">
                                <h5 class="card-title">{{ $registration->event->name }}</h5>
                                <p class="card-text">
                                    <strong>Date:</strong> {{ $registration->event->date }} <br>
                                    <strong>Location:</strong> {{ $registration->event->location }} <br>
                                    <strong>Ticket Type:</strong> {{ $registration->ticket->name }} <br>
                                    <strong>Price:</strong> ${{ $registration->ticket->price }}
                                </p>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('event.details', ['id' => $registration->event->id]) }}" class="btn btn-primary">Event Details</a>
                                    <a href="{{ route('receipt', ['idReg' => $registration->id]) }}" class="btn btn-secondary">View Receipt</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>No tickets found.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <!-- My Tickets End -->
</x-front-layout>
