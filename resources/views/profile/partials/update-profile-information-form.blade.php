<section>
    <header class="mb-4">
        <h2 class="h4">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-2 text-muted">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-4">
        @csrf
        @method('patch')

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="mt-1 text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="mt-1 text-danger">
                    {{ $message }}
                </div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="small text-muted">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-success">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Profile Picture -->
        <div class="mb-3">
            <label for="profile_img" class="form-label">{{ __('Profile Picture') }}</label>
            <div class="mb-3">
                @if ($user->profile_img)
                    <img src="{{ asset('storage/' . $user->profile_img) }}" alt="Profile Image" class="img-thumbnail mb-2" style="max-width: 150px;">
                @else
                    <img src="https://via.placeholder.com/150" alt="Profile Image" class="img-thumbnail mb-2" style="max-width: 150px;">
                @endif
            </div>
            <input type="file" class="form-control" id="profile_img" name="profile_img">
            @error('profile_img')
                <div class="mt-1 text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Save Button -->
        <div class="d-flex align-items-center gap-2">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
                <p class="small text-muted mb-0 ms-3" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
