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
                                href="/templates">
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
    </div>
</body>

</html>
