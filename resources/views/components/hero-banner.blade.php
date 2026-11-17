@props([
    'title',
    'description',
    'eyebrow' => 'VILAGRO · Agri-Vision',
    'fullHeight' => false,
    'centered' => false,
    'actionLabel' => null,
    'actionHref' => null,
])

<section @class([
    'relative isolate flex w-full items-center overflow-hidden bg-primary',
    'min-h-svh justify-center' => $fullHeight,
    'min-h-[300px] justify-start sm:min-h-[340px]' => ! $fullHeight,
])>
    <img
        class="absolute inset-0 -z-20 h-full w-full object-cover object-[center_78%]"
        src="https://images.pexels.com/photos/5940280/pexels-photo-5940280.jpeg?auto=compress&cs=tinysrgb&w=1920"
        alt=""
        fetchpriority="high"
    >
    <div class="absolute inset-0 -z-10 bg-gradient-to-r from-primary/80 via-primary/55 to-primary/20"></div>
    <div class="absolute inset-0 -z-10 bg-gradient-to-t from-primary/40 via-transparent to-primary/20"></div>

    <div @class([
        'mx-auto flex w-full max-w-7xl flex-col px-5 text-white sm:px-8 lg:px-12',
        'items-center text-center' => $centered,
        'items-start text-left' => ! $centered,
        'py-28 sm:py-32' => $fullHeight,
        'py-12 sm:py-16' => ! $fullHeight,
    ])>
        @if (filled($eyebrow))
            <span class="mb-4 inline-flex items-center gap-2 rounded-full border border-white/30 bg-white/10 px-3.5 py-2 text-[10px] font-bold uppercase tracking-[0.16em] text-white/95 shadow-sm backdrop-blur-md sm:text-xs">
                <span class="h-2 w-2 rounded-full bg-secondary-fixed"></span>
                {{ $eyebrow }}
            </span>
        @endif
        <h1 class="max-w-4xl font-headline-xl text-3xl font-extrabold leading-[1.08] tracking-[-0.04em] drop-shadow sm:text-4xl md:text-5xl lg:text-6xl">
            {{ $title }}
        </h1>
        <p class="mt-4 max-w-2xl text-sm leading-6 text-white/90 drop-shadow sm:text-base sm:leading-7">
            {{ $description }}
        </p>
        @if ($actionLabel && $actionHref)
            <a class="mt-7 inline-flex items-center gap-2 rounded-full bg-white px-5 py-3 text-sm font-bold text-primary shadow-lg transition hover:bg-primary-fixed" href="{{ $actionHref }}">
                {{ $actionLabel }}
                <span class="material-symbols-outlined text-[18px]" aria-hidden="true">arrow_downward</span>
            </a>
        @endif
    </div>
</section>
