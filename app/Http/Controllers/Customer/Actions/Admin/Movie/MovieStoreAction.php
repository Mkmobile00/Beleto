<?php
namespace App\Actions\Admin\Movie;

use App\Models\Movie;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Traits\NotificationTrait;
use App\Actions\Admin\Movie\MovieRelational;
use App\Http\Traits\VideoUniqueCodeGenerator;

class MovieStoreAction{

    use VideoUniqueCodeGenerator;
    use NotificationTrait;
    protected $request;
    public function __construct(Request $request)
    {
        $this->request=$request->postData;
    }

    public function store(){
        $data=[
            'title'=>$this->request['title'],
            'slug'=>Str::slug($this->request['title']),
            'summary'=>$this->request['summary'],
            'description'=>$this->request['description'],
            'rating'=>$this->request['rating'],
            'release_date'=>$this->request['releaseDate'],
            'run_time'=>$this->request['runTime'],
            'publication'=>$this->request['publication'],
            'download'=>$this->request['download'],
            'freePaid'=>$this->request['freePaid'],
            'trailer_url'=>$this->request['youtubeTrailer'],
            'trailer_url1'=>$this->request['youtubeTrailer'],
            'thumbnail'=>$this->request['thumbnail'],
            'is_file'=>$this->request['is_file'],
            'is_file1'=>$this->request['is_file1'],
            'poster'=>$this->request['poster'],
            'meta_title'=>$this->request['meta_title'],
            'meta_keyword'=>$this->request['meta_keyword'],
            'meta_description'=>$this->request['meta_description'],
            'movie_path'=>$this->request['imagePath'] ?? null,
            'unique_code'=>$this->generateCode()
        ];
        // dd($data);
        $movie=Movie::create($data);
        if($movie->publication=='1'){
            $this->newMovieNotification($movie);
            $this->newMovieNotification1($movie);
        }
        $syncData=(new MovieRelational($movie,$this->request));
        return $movie;
    }

   
}