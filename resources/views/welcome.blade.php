@extends('layouts.app')

@section('content')
    <div class="container mx-auto flex items-start justify-between">
        <div class="w-full xl:w-2/3">
            <div class="relative w-full aspect-ratio-16/9 shadow-lg rounded border-8 bg-grey-darker border-black">

                {{-- <img src="{{ asset('/images/ctp_digi.jpeg') }}" class="absolute pin-t pin-l w-full h-full z-0 opacity-100"> --}}
                {{-- <img src="{{ asset('/images/digi_news.jpg') }}" class="absolute pin-t pin-l w-full h-full z-0 opacity-100"> --}}
                {{-- <div style="background-image: url({{ asset('/images/prelipceanu.jpg') }})" class="bg-cover absolute pin-t pin-l w-full h-full z-0 opacity-100"></div> --}}
                <div style="background-image: url({{ asset('/images/digi_template.jpg') }})" class="bg-cover absolute pin-t pin-l w-full h-full z-0 opacity-100"></div>
                {{-- <img src="http://placeimg.com/720/480/nature" class="absolute pin-t pin-l w-full h-full z-0 opacity-100"> --}}

                <div class="absolute pin-t pin-l w-full h-full z-10 px-10 pt-5 pb-6 flex flex-col justify-between">
                    {{-- top area --}}
                    <div class="flex flex-col items-start font-fira">
                        <div class="flex items-start" v-if="hasTime || hasCity">
                            <div class="bg-black w-18 text-center pb-px leading-none">
                                <span class="text-white font-bold text-xs" v-if="hasTime" v-text="time">{{ date('H:i') }}</span>
                            </div>

                            <div class="city-gradient px-3 ml-2 text-center pb-px leading-none" v-if="hasCity" v-cloak>
                                <span class="text-white font-bold text-xs" v-text="city"></span>
                            </div>
                        </div>
                        <div class="bg-grey-lightest  w-18 text-center pb-px mt-2 leading-none" v-if="isLive" v-cloak>
                            <span class="text-black font-bold text-xs">direct</span>
                        </div>
                    </div>
                    {{-- end top area --}}

                    {{-- start crawler --}}
                    <div class="flex items-end w-full font-fira">
                        <div class="logo w-18 h-18 logo-gradient flex-no-shrink flex-no-grow">
                            <img class="w-full" src="{{ asset('/images/digi_logo_mare.png') }}">
                        </div>
                        <div class="crawler flex-1 min-w-0 flex flex-col items-start ml-2">
                            
                            <div class="top-news-alert bg-red px-2 font-semibold text-center mb-2 text-white leading-normal" v-if="isBreakingNews" v-cloak>Breaking News</div>
                            <div class="top-news-alert bg-red px-2 font-semibold text-center mb-2 text-white leading-normal" v-else-if="isNewsAlert" v-cloak>News Alert</div>

                            <div class="min-h-11 w-full mb-2 flex flex-col justify-center relative">
                                <div class="title text-2-1/2xl px-2 pt-1 font-semibold text-white z-10 truncate" v-text="title">
                                    Ministrul Culturii despre Mihai Eminescu
                                </div>
                                <div class="subtitle text-lg px-2 pb-1 text-grey-light mt-px pt-px z-10 truncate" v-text="subtitle">
                                    D. Breaz: E cel mai mare poet al României, cel puțin până acum
                                </div>
                                <div class="absolute pin-y crawler-gradient w-full h-full z-0 opacity-90"></div>
                            </div>

                            <div class="w-full flex items-center justify-between leading-digi">
                                
                                <span class="px-2 bg-red font-semibold text-center text-white" v-if="isNewsAlert" v-cloak>
                                    News Alert
                                </span>
                                <span class="px-3 bg-digi  text-center text-white" v-else v-cloak>
                                    Știri
                                </span>
                                <span class="flex-1 bg-black w-full font-semibold text-grey-lighter pl-2 truncate" v-if="hasSubnews" v-text="subnews">
                                    Oamenii cer dublarea salariilor și condiții mai bune
                                </span>
                            </div>

                        </div>
                    </div>
                    {{-- end start crawler --}}
                </div>

                <div class="absolute pin-y w-full h-full bg-transparent z-30"></div>

            </div>
            <div class="flex items-start justify-around">
                <div class="w-4 bg-black h-3"></div>
                <div class="w-4 bg-black h-3"></div>
            </div>
            <div class="flex items-start justify-center">
                <div class="w-2/3 bg-black rounded-t h-2"></div>
            </div>
            
        </div>

        <div class="w-full xl:w-1/3 mt-12 xl:mt-0 pl-6">
            <div class="flex flex-col mb-6">
                <label for="background" class="font-semibold">Imagine de fundal:</label>
                <input class="bg-grey-light mt-2 px-4 py-4 text-sm outline-none rounded-lg focus:shadow-inner" type="url" name="background_url" value="{{ old('background_url') }}">
            </div>

            <div class="mb-6">
                <label for="background-upload" class="cursor-pointer inline-block text-center font-semibold bg-blue text-white px-6 py-4 rounded-lg hover:bg-blue-dark hover:shadow-md">
                    <span>Incarca fisier</span>
                    <input type="file" name="background" class="hidden" id="background-upload">
                </label>
            </div>

            <div class="flex flex-col mb-6">
                <label class="font-semibold">Titlu principal:</label>
                <input class="bg-grey-light mt-2 px-4 py-4 text-sm outline-none rounded-lg focus:shadow-inner" type="text" name="title" value="{{ old('title') }}" v-model="title" required>
            </div>

            <div class="flex flex-col mb-6">
                <label class="font-semibold">Subtitlu:</label>
                <input class="bg-grey-light mt-2 px-4 py-4 text-sm outline-none rounded-lg focus:shadow-inner" type="text" name="subtitle" value="{{ old('subtitle') }}" v-model="subtitle" required>
            </div>

            <div class="flex flex-col mb-6">
                <label class="font-semibold">Stire subsol:</label>
                <input class="bg-grey-light mt-2 px-4 py-4 text-sm outline-none rounded-lg focus:shadow-inner" type="text" name="subnews" value="{{ old('subnews') }}" v-model="subnews" required>
            </div>

            <div class="flex flex-col mb-6">
                <label class="font-semibold">Ora:</label>
                <input class="bg-grey-light mt-2 px-4 py-4 text-sm outline-none rounded-lg focus:shadow-inner" type="time" name="time" step="60" v-model="time" value="{{ old('time') }}">
            </div>

            <div class="flex flex-col mb-6">
                <label class="font-semibold">Localitatea:</label>
                <input class="bg-grey-light mt-2 px-4 py-4 text-sm outline-none rounded-lg focus:shadow-inner" type="text" name="city" v-model="city">
            </div>

            <div class="flex flex-wrap mb-6">
                <label class="font-semibold cursor-pointer mr-3">
                    <span>In direct</span>
                    <input type="checkbox" name="live" v-model="isLive">
                </label>

                <label class="font-semibold cursor-pointer mr-3">
                    <span>Breaking News</span>
                    <input type="checkbox" name="breakingnews" v-model="isBreakingNews">
                </label>

                <label class="font-semibold cursor-pointer mr-3">
                    <span>News Alert</span>
                    <input type="checkbox" name="newsalert" v-model="isNewsAlert">
                </label>
            </div>
            
        </div>
    </div>


    
@endsection