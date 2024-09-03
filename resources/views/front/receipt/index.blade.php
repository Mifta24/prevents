<x-front-layout>
    <br>
    <br>
    <!-- Receipt Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Receipt</h6>
                <h1 class="mb-5">Payment Confirmation</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="card shadow-lg border-0 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="card-body p-5">
                            <h5 class="card-title mb-4">Thank you for your purchase!</h5>

                            <!-- Event Details -->
                            <div class="mb-3">
                                <h6 class="text-muted">Event Details</h6>
                                <p><strong>Event Name:</strong> {{ $event->name }}</p>
                                <p><strong>Date:</strong> {{ $event->date }}</p>
                                <p><strong>Location:</strong> {{ $event->location }}</p>
                            </div>

                            <!-- Ticket Details -->
                            <div class="mb-3">
                                <h6 class="text-muted">Ticket Details</h6>
                                <p><strong>Ticket Type:</strong> {{ $transaction->ticket->type }}</p>
                                <p><strong>Total Price:</strong> ${{ $transaction->ticket->price }}</p>
                            </div>

                            <!-- Buyer Information -->
                            <div class="mb-3">
                                <h6 class="text-muted">Buyer Information</h6>
                                <p><strong>Name:</strong> {{ $user->name }}</p>
                                <p><strong>Email:</strong> {{ $user->email }}</p>
                            </div>

                            <!-- Payment Information -->
                            <div class="mb-3">
                                <h6 class="text-muted">Payment Information</h6>
                                <p><strong>Payment Method:</strong> {{ $payment->payment_method ?? ''}}</p>
                                <p><strong>Transaction ID:</strong> {{ $payment->id ?? '' }}</p>
                                <p><strong>Payment Status:</strong> {{ $payment->status }}</p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('download.receipt', ['id' => $transaction->id]) }}" class="btn btn-primary">Download PDF</a>
                                <a href="{{ route('index') }}" class="btn btn-secondary">Back to Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Receipt End -->
</x-front-layout>
