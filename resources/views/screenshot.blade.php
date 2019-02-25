@extends('layouts.raw')

@section('content')
<div class="relative w-full aspect-ratio-16/9 bg-grey-darker">

    <div data-url="{{ asset($data['cover'] ?? '/images/prelipceanu.jpg') }}" style="background-image: url({{ asset($data['cover'] ?? '/images/prelipceanu.jpg') }})" ref="cover" class="bg-cover absolute pin-t pin-l w-full h-full z-0 opacity-100"></div>

    <div class="absolute pin-t pin-l w-full h-full z-10 px-10 pt-5 pb-6 flex flex-col justify-between">
        {{-- top area --}}
        <div class="flex flex-col items-start font-fira">
            <div class="flex items-start">
                @if ($data['city'])
                    <div class="bg-black w-18 text-center pb-px leading-none">
                        <span class="text-white font-bold text-xs">{{ $data['time'] }}</span>
                    </div>
                @endif

                @if ($data['city'])
                    <div class="city-gradient px-3 ml-2 text-center pb-px leading-none">
                        <span class="text-white font-bold text-xs">{{ $data['city'] }}</span>
                    </div>
                @endif
            </div>

            @if ($data['live'])
                <div class="bg-grey-lightest  w-18 text-center pb-px mt-2 leading-none">
                    <span class="text-black font-bold text-xs">direct</span>
                </div>
            @endif
        </div>
        {{-- end top area --}}

        {{-- start crawler --}}
        <div class="flex items-end w-full font-fira">
            <div class="logo w-18 h-18 logo-gradient flex-no-shrink flex-no-grow">
                <img class="w-full" src="{{ asset('/images/digi_logo_mare.png') }}">
            </div>
            <div class="crawler flex-1 min-w-0 flex flex-col items-start ml-2">
                
                @if (isset($data['breakingnews']) && $data['breakingnews'])
                    <div class="top-news-alert bg-red px-2 font-semibold text-center mb-2 text-white leading-normal">Breaking News</div>
                @elseif (isset($data['newsalert']) && $data['newsalert'])
                    <div class="top-news-alert bg-red px-2 font-semibold text-center mb-2 text-white leading-normal">News Alert</div>
                @endif

                <div class="min-h-11 w-full mb-2 flex flex-col justify-center relative">
                    <div class="title text-2-1/2xl px-2 pt-1 font-semibold text-white z-10 truncate">
                        {{ $data['title'] }}
                    </div>
                    <div class="subtitle text-lg px-2 pb-1 text-grey-light mt-px pt-px z-10 truncate">
                        {{ $data['subtitle'] }}
                    </div>
                    <div class="absolute pin-y crawler-gradient w-full h-full z-0 opacity-90"></div>
                </div>

                <div class="w-full flex items-center justify-between leading-digi">
                    
                    @if (isset($data['newsalert']) && $data['newsalert'])
                        <span class="px-2 bg-red font-semibold text-center text-white" >
                            News Alert
                        </span>
                    @else
                        <span class="px-3 bg-digi font-semibold text-center text-white">
                            Știri
                        </span>
                    @endif
                    <span class="flex-1 bg-black w-full font-semibold text-grey-lighter pl-2 truncate">
                        {{ $data['subnews'] }}
                    </span>

                </div>
            </div>
        </div>
        {{-- end start crawler --}}
    </div>
</div>
@endsection