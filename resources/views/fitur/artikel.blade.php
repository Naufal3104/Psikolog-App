@extends('layouts.main')
@section('title', 'Artikel')
@section('content')
    <!-- ===== Blog Grid Start ===== -->
    <section class="ji gp uq">
        <div class="bb ye ki xn vq jb jo">
            <div class="wc qf pn xo zf iq">
                @foreach ($artikel as $item)
                    <div class="animate_top sg vk rm xm">
                        <div class="c i vd pf pg" style="padding-top: 56.25%;">

                            @if ($item->gambar == null)
                                <div class="h r s vd yc qh"></div>
                            @else
                                <img src="{{ asset('storage/img' . $item->gambar) }}" alt="Gambar {{ $item->judul }}"
                                    class="h r s vd yc" style="object-fit: cover;" />
                            @endif

                            <div class="im h r s df vd yc wg tc wf xf al hh/20 nl il z-10">
                                <a href="artikel/{{$item->id}}" class="vc ek rg lk gh sl ml il gi hi">Baca Selengkapnya</a>
                            </div>
                        </div>

                        <div class="yh">
                            <div class="tc uf wf ag jq">
                                <div class="tc wf ag">
                                    @if (optional($item->penulis)->foto_profil)
                                        <img src="{{ asset('storage/' . $item->penulis->foto_profil) }}"
                                            alt="Foto {{ $item->penulis->name }}"
                                            class="w-6 h-6 rounded-full object-cover" />
                                    @else
                                        <img src="{{ asset('images/icon-man.svg') }}" alt="User" class="w-6" />
                                    @endif
                                    <p>{{ optional($item->penulis)->name ?? 'Penulis' }}</p>
                                </div>
                                <div class="tc wf ag">
                                    <img src="{{ asset('images/icon-calender.svg') }}" alt="Calender" />
                                    <p>{{ $item->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                            <h4 class="ek tj ml il kk wm xl eq lb">
                                <a href="artikel/{{$item->id}}">{{ $item->judul }}</a>
                            </h4>
                            <p class="text-sm text-gray-500 mt-2">
                                Slug: {{ \Illuminate\Support\Str::words($item->slug, 5, '...') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mb lo bq i ua">
                <nav>
                    <ul class="tc wf xf bg">
                        <li>
                            <a class="c tc wf xf wd in zc hn rg uj fo wk xm ml il hh rm tl zm yl an" href="#!">
                                <svg class="th lm ml il" width="8" height="14" viewBox="0 0 8 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M2.93884 6.99999L7.88884 11.95L6.47484 13.364L0.11084 6.99999L6.47484 0.635986L7.88884 2.04999L2.93884 6.99999Z" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a class="c tc wf xf wd in zc hn rg uj fo wk xm ml il hh rm tl zm yl an" href="#!">
                                2
                            </a>
                        </li>
                        <li>
                            <a class="c tc wf xf wd in zc hn rg uj fo wk xm ml il hh rm tl zm yl an" href="#!">
                                3
                            </a>
                        </li>
                        <li>
                            <a class="c tc wf xf wd in zc hn rg uj fo wk xm ml il hh rm tl zm yl an" href="#!">
                                4
                            </a>
                        </li>
                        <li>
                            <a class="c tc wf xf wd in zc hn rg uj fo wk xm ml il hh rm tl zm yl an" href="#!">
                                ...
                            </a>
                        </li>
                        <li>
                            <a class="c tc wf xf wd in zc hn rg uj fo wk xm ml il hh rm tl zm yl an" href="#!">
                                12
                            </a>
                        </li>
                        <li>
                            <a class="c tc wf xf wd in zc hn rg uj fo wk xm ml il hh rm tl zm yl an" href="#!">
                                <svg class="th lm ml il" width="8" height="14" viewBox="0 0 8 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.06067 7.00001L0.110671 2.05001L1.52467 0.636014L7.88867 7.00001L1.52467 13.364L0.110672 11.95L5.06067 7.00001Z"
                                        fill="#fefdfo" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
@endsection
