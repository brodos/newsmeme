@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="w-full xl:w-2/3 mx-auto">
            <div class="relative w-full aspect-ratio-16/9 shadow-lg rounded border-8 bg-grey-darker border-black">

                {{-- <img src="{{ asset('/images/ctp_digi.jpeg') }}" class="absolute pin-t pin-l w-full h-full z-0 opacity-100"> --}}
                {{-- <img src="{{ asset('/images/digi_news.jpg') }}" class="absolute pin-t pin-l w-full h-full z-0 opacity-100"> --}}
                {{-- <div style="background-image: url({{ asset('/images/prelipceanu.jpg') }})" class="bg-cover absolute pin-t pin-l w-full h-full z-0 opacity-100"></div> --}}
                <div style="background-image: url({{ asset('/images/digi_template.jpg') }})" class="bg-cover absolute pin-t pin-l w-full h-full z-0 opacity-100"></div>
                {{-- <img src="http://placeimg.com/720/480/nature" class="absolute pin-t pin-l w-full h-full z-0 opacity-100"> --}}

                <div class="absolute pin-t pin-l w-full h-full z-10 px-10 pt-5 pb-6 flex flex-col justify-between">
                    {{-- top area --}}
                    <div class="flex items-start justify-between font-fira">
                        <div class="flex flex-col items-start ">
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

                        <div>
                            <a href="#" class="block px-4 py-2 rounded-lg no underline text-white opacity-50 hover:opacity-100 border-2 border-white hover:border-white hover:bg-smoke">
                                <svg class="fill-current w-10 h-10" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m20 7a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-16a2 2 0 0 1 -2-2v-10c0-1.1.9-2 2-2h2.38l1.73-3.45a1 1 0 0 1 .89-.55h6a1 1 0 0 1 .9.55l1.71 3.45zm-10.38-2-1.73 3.45a1 1 0 0 1 -.89.55h-3v10h16v-10h-3a1 1 0 0 1 -.9-.55l-1.71-3.45zm2.38 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg>
                            </a>
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
                                
                                <div class="z-10">
                                    
                                    <div class="title relative text-2-1/2xl px-2 pt-1 font-semibold text-white truncate hover:bg-red cursor-pointer" v-text="title" @click.prevent="showEditModal('.title')">
                                        Ministrul Culturii despre Mihai Eminescu
                                    </div>
                                    
                                </div>
                                
                                <div class="z-10">
                                    <div class="subtitle text-lg px-2 pb-1 text-grey-light mt-px pt-px truncate hover:bg-red cursor-pointer" v-text="subtitle" @click.prevent="showEditModal('.subtitle')">
                                        D. Breaz: E cel mai mare poet al României, cel puțin până acum
                                    </div>
                                    <div class="subtitle-input hidden">
                                        <input type="text" name="subtitle">
                                    </div>
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
                                <span class="flex-1 bg-black w-full font-semibold text-grey-lighter pl-2 truncate hover:bg-red cursor-pointer" v-if="hasSubnews" v-text="subnews" @click.prevent="showEditModal('.subnews')">
                                    Oamenii cer dublarea salariilor și condiții mai bune
                                </span>
                            </div>

                        </div>

                    </div>

                    <div class="edit-modal absolute pin-x pin-y bg-smoke z-20 items-center justify-center hidden" @click="hideEditModal">
                        <div class="title hidden bg-white rounded-lg w-5/6 overflow-hidden">
                            <input @click.stop class="w-full outline-none p-6 font-bold text-lg text-grey-darkest" type="text" name="title" v-model="title">
                        </div>

                        <div class="subtitle hidden bg-white rounded-lg w-5/6 overflow-hidden">
                            <input @click.stop class="w-full outline-none p-6 font-bold text-lg text-grey-darkest" type="text" name="subtitle" v-model="subtitle">
                        </div>

                        <div class="subnews hidden bg-white rounded-lg w-5/6 overflow-hidden">
                            <input @click.stop class="w-full outline-none p-6 font-bold text-lg text-grey-darkest" type="text" name="subnews" v-model="subnews">
                        </div>
                    </div>

                    {{-- end start crawler --}}
                </div>

                {{-- <div class="absolute pin-y w-full h-full bg-transparent z-30"></div> --}}

            </div>
            <div class="flex items-start justify-around">
                <div class="w-4 bg-black h-3"></div>
                <div class="w-4 bg-black h-3"></div>
            </div>
            <div class="flex items-start justify-center">
                <div class="w-2/3 bg-black rounded-t h-2"></div>
            </div>
            
        </div>

        <div class="w-full xl:w-2/3 mx-auto mt-12">

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

            <div class="flex flex-col mb-6">
                <label class="font-semibold">Localitatea:</label>
                <input class="bg-grey-light mt-2 px-4 py-4 text-sm outline-none rounded-lg focus:shadow-inner" type="text" name="city" v-model="city">
            </div>
            
        </div>
    </div>


    
@endsection