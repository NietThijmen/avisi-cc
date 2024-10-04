@php
    use PragmaRX\Google2FAQRCode\Google2FA;

    $user = Auth::user();
    $has_two_factor = (bool)$user->twofa_secret;
    $qr_code = null;
    $secret_code = null;

    if(!$user->twofa_secret)
    {
        $google2fa = new Google2FA();

        $secret = $google2fa->generateSecretKey();
        $qr_code = $google2fa->getQRCodeInline(config('app.url'),$user->email,$secret);
        $secret_code = $secret;
        session([ "2fa_secret" => $secret]);
    }
@endphp

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Setup 2FA') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure you have 2FA to keep your account safe') }}
        </p>
    </header>


    @if(!$has_two_factor)

        <div x-data="{uses_qr: true}">
            <div x-show="uses_qr" class="h-[20vh] aspect-square" x-transition>
                {!! $qr_code !!}
            </div>
            <p x-show="!uses_qr" class="h-[20vh] aspect-square bg-gray-200 grid justify-center text-center" x-transition>
                <span class="font-semibold">{{ __('Secret Code') }}:</span>
                <span class="font-semibold">{{ $secret_code }}</span>
            </p>

            <button @click="uses_qr = !uses_qr" class="mt-2 text-sm text-blue-600">{{ __('Toggle Secret') }}</button>
        </div>

        <form method="post" action="{{ route('two-factor.enable') }}" class="mt-6 space">
            @csrf
            <div class="flex">
                <x-text-input id="otp" name="otp" type="number" class="mt-1 block w-full" autocomplete="off" />
                <x-primary-button>{{ __('Enable') }}</x-primary-button>
            </div>
            @error('otp')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </form>
    @else
        <form method="post" action="{{ route('two-factor.disable') }}" class="mt-6 space">
            @csrf
            @method('DELETE')
            <x-danger-button>{{ __('Disable') }}</x-danger-button>
        </form>
    @endif


</section>
