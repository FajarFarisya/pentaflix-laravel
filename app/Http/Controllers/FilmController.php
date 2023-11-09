<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FilmController extends Controller
{
    public function index(){
        $apiKey = env('FILM_API_KEY');
        $baseURL = env('FILM_API_BASE_URL');
        $imgBaseURL = env('FILM_IMG_BASE_URL');
        $maxHeroFilm=1;

        // API Film in Hero --------------------------------------------------
        $dataHeroResponse = Http::get("{$baseURL}/trending/movie/week", [
            'api_key' => $apiKey
        ]);
        $filmArray=[];

        // Check API
        if($dataHeroResponse->successful()){
            $resultData=$dataHeroResponse->object()->results;
            if(isset($resultData)){
                foreach($resultData as $item){
                    array_push($filmArray, $item);

                    if(count($filmArray) == $maxHeroFilm){
                        break;
                    }
                }
            }
        }

        return view('home', [
            'baseURL' => $baseURL,
            'imageBaseURL' => $imgBaseURL,
            'apiKey' => $apiKey,
            'films' => $filmArray,
        ]);
    }


}
