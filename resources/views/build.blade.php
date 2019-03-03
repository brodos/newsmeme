@extends('layouts.app')

@section('content')

    <div class="hidden lg:inline-block absolute pin-t pin-r mt-12 mr-12 text-right font-sans z-10">
        <a href="#sidebar" @click.prevent="toggleSidebar" class="inline-block no-underline px-8 py-4 font-semibold text-grey-dark shadow-md 
        bg-transparent border rounded-lg border-grey-dark hover:border-blue-dark hover:shadow-lg hover:text-blue-dark hover:bg-white text-sm leading-none flex items-center">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M6.3 12.3l10-10a1 1 0 0 1 1.4 0l4 4a1 1 0 0 1 0 1.4l-10 10a1 1 0 0 1-.7.3H7a1 1 0 0 1-1-1v-4a1 1 0 0 1 .3-.7zM8 16h2.59l9-9L17 4.41l-9 9V16zm10-2a1 1 0 0 1 2 0v6a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h6a1 1 0 0 1 0 2H4v14h14v-6z"/></svg>
            <span>Modifică</span>
        </a>
    </div>

    <div class="flex flex-row-reverse justify-between h-full pb-16" @click.prevent="hideSidebar">

        <div class="sidebar animate bg-white min-h-full w-full lg:w-128 shadow-lg z-20 fixed pin-t pin-r hidden bounceOutRight" @click.stop>
            <div class="head flex items-center border-b z-10 shadow">
                <div class="p-6 border-r">
                    <a href="#" @click.prevent="toggleSidebar" class="text-grey hover:text-grey-darker leading-none">
                        <svg class="fill-current w-10 h-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M9.3 8.7a1 1 0 0 1 1.4-1.4l4 4a1 1 0 0 1 0 1.4l-4 4a1 1 0 0 1-1.4-1.4l3.29-3.3-3.3-3.3z"/></svg>
                    </a>
                </div>
                <div class="hidden md:block p-6 pr-12 flex-1 font-semibold uppercase text-grey-darker">Modifică</div>
                <div class="p-6 flex-1 text-right lg:hidden">
                    <a href="#" @click.prevent="generateScreenshot" class="no-underline bg-blue-dark rounded-lg text-white text-sm font-semibold px-8 shadow-md py-4 hover:bg-blue-darker hover:shadow-lg focus:opacity-50 active:opacity-50">Modifică</a>
                </div>
            </div>
            <div class="body p-6 md:p-10 overflow-y-scroll h-screen pb-24 xl:pb-32">
                <form action="{{ route('compose') }}" method="post" id="news-form">
                    
                <div class="mb-4 flex w-full">
                    <div class="flex-1 mr-2">
                        <input class="w-full bg-grey-lighter focus:bg-indigo-lightest h-12 px-4 appearance-none outline-none" type="time" name="time" v-model="time">
                    </div>

                    <div class="flex-1 ml-2">
                        <input class="w-full bg-grey-lighter focus:bg-indigo-lightest h-12 px-4 appearance-none outline-none" type="search" name="city" v-model="city">
                    </div>
                </div>
                <div class="mb-4">
                    <textarea class="w-full rounded bg-grey-lighter focus:bg-indigo-lightest p-4 md:text-lg font-semibold outline-none appearance-none" name="title" id="title" rows="2" v-model="title"></textarea>
                </div>
                <div class="mb-4">
                    <textarea class="w-full bg-grey-lighter focus:bg-indigo-lightest p-4 text-sm md:text-base font-semibold outline-none appearance-none" name="subtitle" id="subtitle" rows="2" v-model="subtitle"></textarea>
                </div>
                <div class="mb-8">
                    <textarea class="w-full bg-grey-lighter focus:bg-indigo-lightest p-4 text-xs md:text-sm font-semibold outline-none appearance-none" name="subnews" id="subnews" rows="2" v-model="subnews"></textarea>
                </div>

                <div class="flex flex-col md:flex-row items-start md:items-center justify-around pb-8 mb-8 border-b">
                    <label class="font-semibold cursor-pointer  text-center flex items-center mb-4 md:mb-0">
                        <input type="checkbox" name="live" v-model="isLive">
                        <span class="ml-2">In direct</span>
                    </label>

                    <label class="font-semibold cursor-pointer  text-center flex items-center mb-4 md:mb-0">
                        <input type="checkbox" name="newsalert" v-model="isNewsAlert">
                        <span class="ml-2">News Alert</span>
                    </label>

                    <label class="font-semibold cursor-pointer  text-center flex items-center">
                        <input type="checkbox" name="breakingnews" v-model="isBreakingNews">
                        <span class="ml-2">Breaking News</span>
                    </label>

                </div>

                <div class="flex items-center flex-wrap">
                    <div class="w-1/2  mb-4">
                        <label class="block relative aspect-ratio-16/9 mr-2 border-4 border-transparent hover:border-blue cursor-pointer rounded-lg overflow-hidden" :class="{'border-blue' : cover == '{{ asset('/images/prelipceanu.jpg') }}'}">
                            <img class="absolute pin-t pin-l w-full h-full" src="{{ asset('/images/prelipceanu.jpg') }}" alt="">
                            <input type="radio" name="cover" value="{{ asset('/images/prelipceanu.jpg') }}" v-model="cover" class="hidden" @change="updateCover">
                        </label>
                    </div>
                    <div class="w-1/2  mb-4">
                        <label class="block relative aspect-ratio-16/9 ml-2 border-4 border-transparent hover:border-blue cursor-pointer rounded-lg overflow-hidden" :class="{'border-blue' : cover == '{{ asset('/images/ctp_digi.jpeg') }}'}">
                            <img class="absolute pin-t pin-l w-full h-full" src="{{ asset('/images/ctp_digi.jpeg') }}" alt="">
                            <input type="radio" name="cover" value="{{ asset('/images/ctp_digi.jpeg') }}" v-model="cover" class="hidden" @change="updateCover">
                        </label>
                    </div>
                    <div class="w-1/2 overflow-hidden mb-4">
                        <label class="block relative aspect-ratio-16/9 mr-2 border-4 border-transparent hover:border-blue cursor-pointer rounded-lg overflow-hidden" :class="{'border-blue' : cover == '{{ asset('/images/digi_template.jpg') }}'}">
                            <img class="absolute pin-t pin-l w-full h-full" src="{{ asset('/images/digi_template.jpg') }}" alt="">
                            <input type="radio" name="cover" value="{{ asset('/images/digi_template.jpg') }}" v-model="cover" class="hidden" @change="updateCover">
                        </label>
                    </div>
                </div>
        
                </form>
            </div>
        </div>

        <div class="main flex-1 animate z-0">

            <h1 class="text-grey-darker text-center font-thin tracking-wide text-4xl md:text-5xl py-10 md:py-16">
                {{ config('app.name', 'Laravel') }}
            </h1>
            
            <div class="w-full lg:hidden mx-auto p-6 md:p-10">
                <div class="relative w-full aspect-ratio-16/9 shadow-lg rounded border-4 bg-grey-darker border-black">
                    <img src="{{ asset('/images/generic.jpg') }}" alt="NewsMeme.ro" class="generic-image absolute pin-t pin-l w-full h-full">
                </div>

                <div class="flex items-start justify-around">
                    <div class="w-1 bg-black h-2"></div>
                    <div class="w-1 bg-black h-2"></div>
                </div>
                <div class="flex items-start justify-center">
                    <div class="w-2/3 bg-black rounded-t h-2"></div>
                </div>
            </div>

            <div class="w-800 mx-auto hidden lg:block">

                <div class="relative w-full aspect-ratio-16/9 shadow-lg rounded border-8 bg-grey-darker border-black">

                    <div data-url="{{ asset('/images/prelipceanu.jpg') }}" style="background-image: url({{ asset('/images/prelipceanu.jpg') }})" ref="cover" class="bg-cover absolute pin-t pin-l w-full h-full z-0 opacity-100"></div>

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
                                    
                                    <div class="z-10">
                                        
                                        <div class="title relative text-2-1/2xl px-2 pt-1 font-semibold text-white truncate" v-text="title">
                                            Ministrul Culturii despre Mihai Eminescu
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="z-10">
                                        <div class="subtitle text-lg px-2 pb-1 text-grey-light mt-px pt-px truncate" v-text="subtitle">
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

            <div class="w-full mx-auto mt-10 md:mt-16 hidden lg:flex items-center justify-center font-sans" v-show="memeChanged">
                <button @click.prevent="generateScreenshot" class="trigger-download no-underline appearance-none outline-none shadow-md bg-green-dark px-12 py-5 rounded-lg uppercase font-semibold text-white hover:shadow-lg hover:bg-green-darker flex items-center leading-none">
                    <svg class="fill-current w-5 h-5 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11 14.59V3a1 1 0 0 1 2 0v11.59l3.3-3.3a1 1 0 0 1 1.4 1.42l-5 5a1 1 0 0 1-1.4 0l-5-5a1 1 0 0 1 1.4-1.42l3.3 3.3zM3 17a1 1 0 0 1 2 0v3h14v-3a1 1 0 0 1 2 0v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-3z"/></svg>
                    <span>Download Meme</span>
                </button>
            </div>

            <div class="w-full mx-auto mt-6 flex lg:hidden items-center justify-center font-sans" @click.stop>
                <a href="#sidebar" @click.prevent="toggleSidebar" class="inline-block no-underline px-8 py-4 font-semibold text-grey-dark shadow-md 
                    bg-transparent border rounded-lg border-grey-dark hover:border-blue-dark hover:shadow-lg hover:text-blue-dark hover:bg-white text-sm leading-none flex items-center">
                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M6.3 12.3l10-10a1 1 0 0 1 1.4 0l4 4a1 1 0 0 1 0 1.4l-10 10a1 1 0 0 1-.7.3H7a1 1 0 0 1-1-1v-4a1 1 0 0 1 .3-.7zM8 16h2.59l9-9L17 4.41l-9 9V16zm10-2a1 1 0 0 1 2 0v6a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h6a1 1 0 0 1 0 2H4v14h14v-6z"/></svg>
                    <span>Modifică</span>
                </a>
            </div>

        </div>

    </div>

    <a href="#download" class="hidden download-newsmeme">Download</a>
@endsection