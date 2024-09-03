<x-front-layout>
    <br>
    <br>
    <!-- My Transactions Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">My Transactions</h6>
                <h1 class="mb-5">Your Payment History</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    @forelse ($transactions as $transaction)
                        <div class="card mb-4 shadow-lg border-0 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="card-body">
                                <h5 class="card-title">{{ $transaction->registration->event->name }}</h5>
                                <p class="card-text">
                                    <strong>Date:</strong> {{ $transaction->payment_date }} <br>
                                    <strong>Amount:</strong> ${{ $transaction->amount }} <br>
                                    <strong>Status:</strong> {{ ucfirst($transaction->status) }}
                                </p>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('event.details', ['id' => $transaction->registration->event->id]) }}" class="btn btn-primary">Event Details</a>
                                    <a href="{{ route('receipt', ['idReg' => $transaction->registration->id]) }}" class="btn btn-secondary">View Receipt</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>No transactions found.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <!-- My Transactions End -->
</x-front-layout>
