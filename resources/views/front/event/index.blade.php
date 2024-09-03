<x-front-layout>
    <br>
    <br>
    <!-- Destination Start -->
    <div class="container-xxl py-5  destination">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Destination</h6>
                <h1 class="mb-5">Popular Destination</h1>
            </div>
            <div class="row g-3">
                <div class="col-lg-7 col-md-6">

                    @forelse ($events as $event)
                        <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                            <a class="position-relative d-block overflow-hidden" href="">
                                <img class="img-fluid" src="img/destination-2.jpg" alt="">
                                <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">
                                    {{ $event->location }}</div>
                                <div
                                    class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">
                                    {{ $event->name }}</div>
                            </a>

                            <a href="{{ route('detail.event',$event->slug) }}" class="btn btn-primary m-3">Detail</a>
                        </div>

                    @empty
                    <p>Kosong</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
    </div>
    <!-- Destination Start -->
</x-front-layout>
