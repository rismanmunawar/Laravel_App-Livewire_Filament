<div class="card bg-transparent border-0 text-center">
    <div class="card-img">
        <div style="width: 300px; height: 332px; overflow: hidden;" class="mx-auto">
            <img
                loading="lazy"
                decoding="async"
                src="{{ !empty($member->image) ? asset('storage/' . $member->image) : asset('images/default.jpg') }}"
                alt="{{ $member->name }}"
                class="rounded w-100 h-100 object-fit-cover">
        </div>

        @if($member->fb_url || $member->lk_url || $member->ig_url)
        <ul class="card-social list-inline">
            @if($member->fb_url)
            <li class="list-inline-item"><a class="facebook" target="_blank" href="{{ $member->fb_url }}"><i class="fab fa-facebook"></i></a></li>
            @endif
            @if($member->lk_url)
            <li class="list-inline-item"><a class="linkedin" target="_blank" href="{{ $member->lk_url }}"><i class="fab fa-linkedin"></i></a></li>
            @endif
            @if($member->ig_url)
            <li class="list-inline-item"><a class="instagram" target="_blank" href="{{ $member->ig_url }}"><i class="fab fa-instagram"></i></a></li>
            @endif
        </ul>
        @endif
    </div>
    <div class="card-body">
        <h3>{{ $member->name }}</h3>
        <p>{{ $member->designation }}</p>
    </div>
</div>