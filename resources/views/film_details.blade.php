<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail | PentaFlix</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="w-full h-screen flex flex-col bg-black relative">
        <!-- Navbar -->
        @include('navbar')
        <!-- End Navbar -->

        @php
            $backdropImg = $filmDetail ? "{$imageBaseURL}/w500{$filmDetail->backdrop_path}" : "";
            $timestamp = $filmDetail->release_date;
            $formattedDate = date('d/m/Y', strtotime($timestamp));
            $year = substr($filmDetail->release_date, 0, 4);
            $rating = round($filmDetail->vote_average * 10);

            if($filmDetail->runtime){
                $hour = (int)($filmDetail->runtime/60);
                $minute = $filmDetail->runtime%60;
                $duration = "{$hour}h {$minute}m";
            }

        @endphp
        <div class="grid place-items-center mt-28">
            <div class="rounded-md shadow-lg bg-gray-800 pb-5">
                <div class="md:flex px-4 leading-none max-w-4xl">
                    <div class="flex-none mr-5">
                        <img src="{{$backdropImg}}"
                            alt="pic"
                            class="w-[300px] h-[245px] rounded-md transform -translate-y-4 border-4 border-gray-300 shadow-lg" />
                    </div>

                    <div class="flex-col text-gray-300">

                        <p class="pt-4 text-2xl font-bold">{{$filmDetail->title}} ({{$year}})</p>
                        <hr class="hr-text" data-content="">
                        <div class="text-md flex justify-between px-4 my-2">
                            <span class="font-bold">Release date: {{$formattedDate}} | {{$duration}}</span>
                            <span class="font-bold"></span>
                        </div>
                        <p class="text-gray-500 px-4 my-4 text-md text-left italic">
                            "{{$filmDetail->title}}"
                        </p>
                        <p class="text-gray-200 px-4 my-4 text-md text-left">
                            Overview
                        </p>
                        <p class="hidden md:block px-4 my-4 text-sm text-left">
                            {{$filmDetail->overview}}
                        </p>

                        <p class="flex text-md px-4 my-2">
                            Rating: {{$rating}}/100
                            {{-- <span class="font-bold px-2">|</span>
                            Mood: Dark --}}
                        </p>

                        <div class="text-xs">
                            <button type="button"
                                class="border border-gray-400 text-gray-400 rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-gray-900 focus:outline-none focus:shadow-outline">TRAILER</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('footer')
        <!-- End Footer -->
    </div>
</body>

</html>
