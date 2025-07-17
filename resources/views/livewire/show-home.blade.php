<main>
    <section class="banner bg-tertiary position-relative overflow-hidden py-4">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="block text-center text-lg-start pe-0 pe-xl-5">
                        <h1 class="text-capitalize mb-3">Reliable Systems. Smooth Operations.</h1>
                        <p class="mb-3">Mendukung aplikasi internal perusahaan dengan monitoring dan layanan yang responsif.</p>
                        <a type="button"
                            class="btn btn-primary"
                            href="{{route('servicesPage')}}"
                            wire:navigate
                            data-bs-toggle="modal"
                            data-bs-target="#applyLoan">
                            Explore Services<span style="font-size: 14px;" class="ms-2 fas fa-arrow-right"></span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ps-lg-5 text-center">
                        <img loading="lazy" decoding="async"
                            src="{{ asset('front/images/about-us.png') }}"
                            alt="banner image" class="w-100">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="section-title pt-2">
                        <p class="text-primary text-uppercase fw-bold mb-2">Our Services</p>
                        <h1 class="mb-3">Internal System Services</h1>
                        <p class="mb-0">We provide various digital services that support operational smoothness, including application monitoring, data tracking, and daily technical support for all work units.</p>
                    </div>
                </div>
                @if ($services->isNotEmpty())
                @php $no=1; @endphp
                @foreach ($services as $service)
                <x-service-card :service="$service" :no="$no" />
                @php $no++; @endphp
                @endforeach
                @endif
            </div>
        </div>
    </section>
</main>