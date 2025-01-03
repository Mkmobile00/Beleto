<?php
namespace App\Actions\Admin\Post;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostStoreAction{

    protected $request;
    protected $post;
    protected $data;
    public function __construct(Request $request,Post $post)
    {
        $this->request=$request;
        $this->post=$post;
    }

    public function store(){
        $this->data=$this->request->all();
        $this->data['slug']=Str::slug($this->request->title);
        $this->post->fill($this->data);
        $this->post->save();
        (new PostCategoryStoreAction($this->request->post_cat,$this->post))->syncCat();
    }

    public function update(){
        $this->data=$this->request->all();
        $this->post->fill($this->data);
        $this->post->save();
        
        (new PostCategoryStoreAction($this->request->post_cat,$this->post))->syncUpdateCat();
    }
}