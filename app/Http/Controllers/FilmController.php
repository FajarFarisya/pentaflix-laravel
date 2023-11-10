<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FilmController extends Controller
{
    private $apiKey;
    private $baseURL;
    private $imgBaseURL;

    public function __construct()
    {
        $this->apiKey = env('FILM_API_KEY');
        $this->baseURL = env('FILM_API_BASE_URL');
        $this->imgBaseURL = env('FILM_IMG_BASE_URL');

    }
    public function index(){
        $maxHeroFilm=1;
        $maxAllCategories=4;

        // API Film in Hero --------------------------------------------------
        $dataHeroResponse = Http::get("{$this->baseURL}/trending/movie/week", [
            'api_key' => $this->apiKey
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

        // API Film Now Playing -------------------------------------------------
        $dataNowPlayingResponse = Http::get("{$this->baseURL}/movie/now_playing", [
            'api_key' => $this->apiKey
        ]);

        $filmNowPlayArray=[];

        // Check API
        if($dataNowPlayingResponse->successful()){
            $resultDataNowPlaying=$dataNowPlayingResponse->object()->results;
            if(isset($resultDataNowPlaying)){
                foreach($resultDataNowPlaying as $item){
                    array_push($filmNowPlayArray, $item);

                    if(count($filmNowPlayArray) == $maxAllCategories){
                        break;
                    }
                }
            }
        }

        // API Film Popular -------------------------------------------------
        $dataPopularResponse = Http::get("{$this->baseURL}/movie/popular", [
            'api_key' => $this->apiKey
        ]);

        $filmPopularArray=[];

        // Check API
        if($dataPopularResponse->successful()){
            $resultDataPopular=$dataPopularResponse->object()->results;
            if(isset($resultDataPopular)){
                foreach($resultDataPopular as $item){
                    array_push($filmPopularArray, $item);

                    if(count($filmPopularArray) == $maxAllCategories){
                        break;
                    }
                }
            }
        }

        // API Film Top Rated -------------------------------------------------
        $dataTopRatedResponse = Http::get("{$this->baseURL}/movie/top_rated", [
            'api_key' => $this->apiKey
        ]);

        $filmTopRatedArray=[];

        // Check API
        if($dataTopRatedResponse->successful()){
            $resultDataTopRated=$dataTopRatedResponse->object()->results;
            if(isset($resultDataTopRated)){
                foreach($resultDataTopRated as $item){
                    array_push($filmTopRatedArray, $item);

                    if(count($filmTopRatedArray) == $maxAllCategories){
                        break;
                    }
                }
            }
        }

        // API Film Upcoming -------------------------------------------------
        $dataUpcomingResponse = Http::get("{$this->baseURL}/movie/upcoming", [
            'api_key' => $this->apiKey
        ]);

        $filmUpcomingArray=[];

        // Check API
        if($dataUpcomingResponse->successful()){
            $resultDataUpcoming=$dataUpcomingResponse->object()->results;
            if(isset($resultDataUpcoming)){
                foreach($resultDataUpcoming as $item){
                    array_push($filmUpcomingArray, $item);

                    if(count($filmUpcomingArray) == $maxAllCategories){
                        break;
                    }
                }
            }
        }


        return view('home', [
            'baseURL' => $this->baseURL,
            'imageBaseURL' => $this->imgBaseURL,
            'apiKey' => $this->apiKey,
            'films' => $filmArray,
            'filmNowPlaying' => $filmNowPlayArray,
            'filmPopular' => $filmPopularArray,
            'filmTopRated' => $filmTopRatedArray,
            'filmUpcoming' => $filmUpcomingArray,
        ]);
    }

    public function films(){
        $sortBy = "popularity.desc";
        $page=1;
        $minVoter= 100;

        // API Sort -------------------------------------------------
        $dataSortResponse = Http::get("{$this->baseURL}/movie/upcoming", [
            'api_key' => $this->apiKey,
            'sort_by' => $sortBy,
            'vote_count.gte' => $minVoter,
            'page' => $page,
        ]);

        $filmSortArray=[];

        // Check API
        if($dataSortResponse->successful()){
            $resultDataFilm=$dataSortResponse->object()->results;
            if(isset($resultDataFilm)){
                foreach($resultDataFilm as $item){
                    array_push($filmSortArray, $item);
                }
            }
        }

        return view('film', [
            'baseURL' => $this->baseURL,
            'imageBaseURL' => $this->imgBaseURL,
            'apiKey' => $this->apiKey,
            'films' => $filmSortArray,
            'sortBy' => $sortBy,
            'page' => $page,
            'minVoter' => $minVoter,
        ]);

    }

    public function filmDetails($id){

         // API Sort -------------------------------------------------
         $res = Http::get("{$this->baseURL}/movie/{$id}", [
            'api_key' => $this->apiKey,
            'append_to_response' => 'videos'
        ]);

        $filmDetail=null;

        // Check API
        if($res->successful()){
            $filmDetail=$res->object();
        }

        return view('film_details', [
            'baseURL' => $this->baseURL,
            'imageBaseURL' => $this->imgBaseURL,
            'apiKey' => $this->apiKey,
            'filmDetail' => $filmDetail,
        ]);
    }

    // public function getFilm($option){
    //     $responseGetFilm = Http::get("{$this->baseURL}/movie/{$option}", [
    //         'api_key' => $this->apiKey,
    //     ]);

    //     return $responseGetFilm->json();


    // }
}
