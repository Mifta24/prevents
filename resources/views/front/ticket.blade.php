 <x-front-layout>

     <!-- Ticket Start -->
     <div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Packages</h6>
            <h1 class="mb-5">Awesome Tickets</h1>
        </div>
        <div class="row g-4 justify-content-center">
            @forelse ($tickets as $ticket)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="package-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/package-1.jpg" alt="">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i
                                class="fa fa-map-marker-alt text-primary me-2"></i>{{ $ticket->event->location }}</small>
                                <small class="flex-fill text-center border-end py-2"><i
                                    class="fa fa-calendar-alt text-primary me-2"></i>{{ $ticket->event->date }}</small>
                                    <small class="flex-fill text-center py-2"><i
                                        class="fa fa-user text-primary me-2"></i>{{ $ticket->event->capacity }}
                                        Person</small>
                                    </div>
                                    <div class="text-center p-4">
                            <h3 class="mb-0">Rp.{{ $ticket->price }}</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                            <p>{{ $ticket->event->description }}</p>
                            <div class="d-flex justify-content-center mb-2">
                                <a href="{{ route('detail.event',$ticket->event->slug) }}" class="btn btn-sm btn-primary px-3 border-end"
                                style="border-radius: 30px 0 0 30px;">Read More</a>
                                <a href="{{ route('registration',$ticket->event->slug) }}" class="btn btn-sm btn-primary px-3"
                                style="border-radius: 0 30px 30px 0;">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
            <p>Kosong</p>
            @endforelse
        </div>
    </div>
</div>
<!-- Ticket End -->

</x-front-layout>
