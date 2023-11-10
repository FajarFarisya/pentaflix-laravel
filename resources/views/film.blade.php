<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Films | PentaFlix</title>
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

        <div class="my-5 ml-10 md:ml-52 flex flex-row items-center">
            <span class="font-semibold text-xl text-white">Sort:</span>
            <div class="relative ml-4 border-gray-500">
                <select
                    class="block appearance-none bg-black drop-shadow text-white py-3 pl-4 pr-8 rounded-lg leading-tight focus:outline-none border" id="sortCategory">
                    <option value="nowplaying">Now Playing</option>
                    <option value="popular">Popular</option>
                    <option value="toprated">Top Rated</option>
                    <option value="upcoming">Upcoming</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-200 pt-2">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="10.033" height="5">
                        <path d="M5.016 0 0 .003 2.506 2.5 5.016 5l2.509-2.5L10.033.003 5.016 0z" />
                    </svg>
                </div>

            </div>
        </div>

        <div class="w-auto px-52 pt-6 pb-10 grid grid-cols-3 lg:grid-cols-5 gap-5" id="dataAllFilm">
            @foreach ($films as $filmItem)
                @php
                    $filmID = $filmItem->id;
                    $posterImg = "{$imageBaseURL}/w500{$filmItem->poster_path}";
                    $timestamp = $filmItem->release_date;
                    $formattedDate = date('d/m/Y', strtotime($timestamp));
                    $year = substr($filmItem->release_date, 0, 4);
                    $score = round($filmItem->vote_average * 10);
                @endphp
                <a href="film/{{ $filmID }}" class="group bg-gray-900 border border-gray-700 rounded-lg shadow" id="allFilms">
                    {{-- <div class="min-w-[232px] min-h-[428px] bg-black">
                        <div class="overflow-hidden rounded-lg">
                            <img src="{{ $posterImg }}" alt=""
                                class="w-full h-[300px] rounded-lg group-hover:scale-110 duration-200" />
                            <span
                                class="leading-tight p-2 md:p-4 text-sm md:text-xl font-bold text-white">{{ $filmItem->title }}
                            </span>
                        </div>
                    </div> --}}
                    <div class="max-w-sm rounded overflow-hidden shadow-lg">
                        <img class="w-full hover:scale-110 duration-200" src="{{ $posterImg }}" alt="Mountain">
                        <div class="px-6 py-4">
                            <div class="font-bold text-white text-xl mb-2">{{ $filmItem->title }}</div>
                            <p class="text-gray-300 text-base line-clamp-2">
                                {{ $filmItem->overview }}
                            </p>
                        </div>
                        <div class="px-6 pt-4 pb-2">
                            <span
                                class="inline-block bg-gray-800 rounded-full px-3 py-1 text-sm font-semibold text-gray-400 mr-2 mb-2">
                                Rating: <span class="text-green-400">{{ $score }}%</span>
                            </span><br>
                            <span
                                class="inline-blockpx-3 py-1 text-sm font-semibold text-gray-400 mr-2 mb-2">
                                Release Date: <span class="text-gray-400">{{ $formattedDate }}</span>
                            </span>

                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Footer -->
        @include('footer')
        <!-- End Footer -->
    </div>
    <script>
        let sortBy = "<?php echo $sortBy; ?>";
        let page = "<?php echo $page; ?>";

        function sorting(film) {
            if (film.value) {
                sortBy = film.value;
                document.getElementById("dataAllFilm").html("");
                page = 0;
            }
        }
        // document.getElementById('sortCategory').addEventListener('change', function () {
        //     var selectedValue = this.value;
        //     if (selectedValue === 'nowplaying') {
        //         hitApi('https://api.themoviedb.org/3/movie/now_playing?api_key=a90f9ef21ad57fff61e560aa6c3b56b3');
        //     } else if (selectedValue === 'popular') {
        //         hitApi('https://api.themoviedb.org/3/movie/popular?api_key=a90f9ef21ad57fff61e560aa6c3b56b3');
        //     } else if (selectedValue === 'toprated') {
        //         hitApi('https://api.themoviedb.org/3/movie/top_rated?api_key=a90f9ef21ad57fff61e560aa6c3b56b3');
        //     }
        //     else if (selectedValue === 'upcoming') {
        //         hitApi('https://api.themoviedb.org/3/movie/upcoming?api_key=a90f9ef21ad57fff61e560aa6c3b56b3');
        //     }
        // });
        // function hitApi(apiUrl) {
        //     fetch(apiUrl)
        //         .then(response => response.json())
        //         .then(data => {
        //             console.log('Data berhasil didapatkan');
        //             // location.reload();
        //         })
        //         .catch(error => console.error('Error:', error));
        // }
    </script>
</body>

</html>
