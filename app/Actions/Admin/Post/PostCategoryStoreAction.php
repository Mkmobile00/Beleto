<?php
namespace App\Actions\Admin\Post;

use App\Models\Post;
use App\Models\PostCatItem;

class PostCategoryStoreAction{

    protected $post;
    protected $catItem;
    protected $temp=[];
    public function __construct(Array $catItem ,Post $post)
    {
        $this->post=$post;
        $this->catItem=$catItem;
    }

    public function syncCat(){
        foreach($this->catItem as $item){
            $this->temp[]=[
                'post_id'=>$this->post->id,
                'post_cat_id'=>(int)$item
            ];
        }
        PostCatItem::insert($this->temp);
    }

    public function syncUpdateCat(){
        $this->post->postCatItem()->delete();
        $this->syncCat();
    }
}