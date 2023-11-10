<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beranda | PentaFlix</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="w-full h-auto min-h-screen flex flex-col bg-black">

        <!-- Navbar -->
        @include('navbar')
        <!-- End Navbar -->

        <!-- Hero Section -->
        <div class="w-full h-[600px] flex flex-col relative bg-black">
            <!-- Hero Poster Film -->
            @foreach ($films as $filmItem)
                @php
                    $filmID = $filmItem->id;
                    $backdropImg = "{$imageBaseURL}/original{$filmItem->backdrop_path}";
                    $year = substr($filmItem->release_date, 0, 4);
                    $score = round($filmItem->vote_average * 10);
                @endphp
                <div class="flex flex-row items-center w-full h-full relative slide">
                    <img src="{{ $backdropImg }}" class="w-full h-full absolute object-cover" />
                    <div class="w-full h-full absolute bg-black bg-opacity-50"></div>
                    <div class="w-10/12 flex flex-col z-10 ml-10 md:ml-52">
                        <span class="text-3xl md:text-5xl font-bold text-white">{{ $filmItem->title }} <span
                                class="text-gray-300 font-normal">({{ $year }})</span></span>
                        <span class="text-sm md:text-md text-gray-300 pt-8">User Rating: <span
                                class="text-green-400">{{ $score }}%</span></span>
                        <span class="text-md md:text-xl text-white w-11/12 md:w-1/2 line-clamp-3 pt-2">{{ $filmItem->overview }}</span>
                        <div
                            class="col-start-1 row-start-4 mt-10 flex flex-col space-y-4 sm:flex-row sm:space-x-4 sm:space-y-0">
                            <a class="inline-flex justify-center rounded-lg text-sm font-semibold py-3 px-5 bg-red-700 text-white cursor-pointer hover:bg-red-600"
                                href="/components">
                                <span>Play Trailer</span>
                            </a>
                            <a class="inline-flex justify-center rounded-lg text-sm font-semibold py-3 px-4 bg-white/0 text-slate-200 ring-1 ring-slate-900/10 hover:bg-white/25 hover:ring-slate-900/15 "
                                href="film/{{$filmID}}">
                                <span>
                                    More Detail<!-- -->
                                    <span aria-hidden="true" class="text-white inline">
                                        →
                                    </span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- End Hero Poster Film -->
        </div>

        <!-- Now Playing -->
        <div class="my-5 ml-10 md:ml-52">
            <h1 class="text-xl md:text-2xl font-bold text-white">Now Playing</h1>
            <div class="w-auto flex flex-row overflow-x-auto py-2">
                @foreach ($filmNowPlaying as $filmNowPlayingItem)
                    @php
                        $filmNowPlayingID = $filmNowPlayingItem->id;
                        $posterImg = "{$imageBaseURL}/w500{$filmNowPlayingItem->poster_path}";
                    @endphp
                    <!-- Card -->
                    <div
                        class="w-[1024px] md:w-[300px] mr-5 bg-gray-900 border border-gray-700 rounded-lg shadow mt-5">
                        <a href="film/{{$filmNowPlayingID}}">
                            <div class="overflow-hidden rounded-t-lg">
                                <img class="rounded hover:scale-110 duration-200" src="{{ $posterImg }}" alt="{{ $filmNowPlayingItem->title }}" />
                            </div>
                        </a>
                        <div class="p-5">
                            <a href="film/{{$filmNowPlayingID}}">
                                <h5 class="mb-2 text-md md:text-xl font-bold tracking-tight text-white">
                                    {{ $filmNowPlayingItem->title }}
                                </h5>
                            </a>
                            {{-- <a href="#"
                                class="inline-flex items-center px-2 md:px-3 py-1 md:py-2 text-xs md:text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                More Detail
                                <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </a> --}}
                        </div>
                    </div>
                    <!-- End Card -->
                @endforeach
            </div>
        </div>
        <!-- End Now Playing -->

        <!-- Popular -->
        <div class="my-5 ml-10 md:ml-52">
            <h1 class="text-xl md:text-2xl font-bold text-white">Popular</h1>
            <div class="w-auto flex flex-row overflow-x-auto py-2">
                @foreach ($filmPopular as $filmPopularItem)
                    @php
                        $filmPopularID = $filmPopularItem->id;
                        $posterImgPopular = "{$imageBaseURL}/w500{$filmPopularItem->poster_path}";
                    @endphp
                    <!-- Card -->
                    <div
                        class="w-[1024px] md:w-[300px] mr-5 bg-gray-900 border border-gray-700 rounded-lg shadow mt-5">
                        <a href="film/{{$filmPopularID}}">
                            <div class="overflow-hidden rounded-t-lg">
                                <img class="rounded hover:scale-110 duration-200" src="{{ $posterImgPopular }}" alt="{{ $filmPopularItem->title }}" />
                            </div>
                        </a>
                        <div class="p-5">
                            <a href="film/{{$filmPopularID}}">
                                <h5 class="mb-2 text-md md:text-xl font-bold tracking-tight text-white">
                                    {{ $filmPopularItem->title }}
                                </h5>
                            </a>
                            {{-- <a href="#"
                                class="inline-flex items-center px-2 md:px-3 py-1 md:py-2 text-xs md:text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                More Detail
                                <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </a> --}}
                        </div>
                    </div>
                    <!-- End Card -->
                @endforeach
            </div>
        </div>
        <!-- End Popular -->


        <!-- Top Rated -->
        <div class="my-5 ml-10 md:ml-52">
            <h1 class="text-xl md:text-2xl font-bold text-white">Top Rated</h1>
            <div class="w-auto flex flex-row overflow-x-auto py-2">
                @foreach ($filmTopRated as $filmTopRatedItem)
                    @php
                        $filmTopRatedID = $filmTopRatedItem->id;
                        $posterImgTopRated = "{$imageBaseURL}/w500{$filmTopRatedItem->poster_path}";
                    @endphp
                    <!-- Card -->
                    <div
                        class="w-[1024px] md:w-[300px] mr-5 bg-gray-900 border border-gray-700 rounded-lg shadow mt-5">
                        <a href="film/{{$filmTopRatedID}}">
                            <div class="overflow-hidden rounded-t-lg">
                                <img class="rounded hover:scale-110 duration-200" src="{{ $posterImgTopRated }}" alt="{{ $filmTopRatedItem->title }}" />
                            </div>
                        </a>
                        <div class="p-5">
                            <a href="film/{{$filmTopRatedID}}">
                                <h5 class="mb-2 text-md md:text-xl font-bold tracking-tight text-white">
                                    {{ $filmTopRatedItem->title }}
                                </h5>
                            </a>
                            {{-- <a href="#"
                                class="inline-flex items-center px-2 md:px-3 py-1 md:py-2 text-xs md:text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                More Detail
                                <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </a> --}}
                        </div>
                    </div>
                    <!-- End Card -->
                @endforeach
            </div>
        </div>
        <!-- End Top Rated -->

        <!-- Upcoming -->
        <div class="my-5 ml-10 md:ml-52">
            <h1 class="text-xl md:text-2xl font-bold text-white">Upcoming</h1>
            <div class="w-auto flex flex-row overflow-x-auto py-2">
                @foreach ($filmUpcoming as $filmUpcomingItem)
                    @php
                        $filmUpcomingID = $filmUpcomingItem->id;
                        $posterImgUpcoming = "{$imageBaseURL}/w500{$filmUpcomingItem->poster_path}";
                    @endphp
                    <!-- Card -->
                    <div
                        class="w-[1024px] md:w-[300px] mr-5 bg-gray-900 border border-gray-700 rounded-lg shadow mt-5">
                        <a href="film/{{$filmUpcomingID}}">
                            <div class="overflow-hidden rounded-t-lg">
                                <img class="rounded hover:scale-110 duration-200" src="{{ $posterImgUpcoming }}" alt="{{ $filmUpcomingItem->title }}" />
                            </div>
                        </a>
                        <div class="p-5">
                            <a href="film/{{$filmUpcomingID}}">
                                <h5 class="mb-2 text-md md:text-xl font-bold tracking-tight text-white">
                                    {{ $filmUpcomingItem->title }}
                                </h5>
                            </a>
                            {{-- <a href="#"
                                class="inline-flex items-center px-2 md:px-3 py-1 md:py-2 text-xs md:text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                More Detail
                                <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </a> --}}
                        </div>
                    </div>
                    <!-- End Card -->
                @endforeach
            </div>
        </div>
        <!-- End Upcoming -->

        <!-- Footer -->
        @include('footer')
        <!-- End Footer -->
    </div>
</body>

</html>
