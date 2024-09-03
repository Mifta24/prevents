<x-front-layout>
    <br>
    <br>
    <!-- My Receipts Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">My Receipts</h6>
                <h1 class="mb-5">Your Payment Receipts</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    @forelse ($receipts as $receipt)
                        <div class="card mb-4 shadow-lg border-0 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="card-body">
                                <h5 class="card-title">{{ $receipt->registration->event->name }}</h5>
                                <p class="card-text">
                                    <strong>Date:</strong> {{ $receipt->payment_date }} <br>
                                    <strong>Amount:</strong> ${{ $receipt->amount }} <br>
                                    <strong>Status:</strong> {{ ucfirst($receipt->status) }}
                                </p>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('receipt', ['idReg' => $receipt->registration->id]) }}" class="btn btn-primary">Show Receipt</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>No receipts found.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <!-- My Receipts End -->
</x-front-layout>
