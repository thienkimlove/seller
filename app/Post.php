<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $fillable = [
        'title',
        'seo_title',
        'slug',
        'desc',
        'keywords',

        'content',
        'image',
        'views',
        'status',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getTagListAttribute()
    {
        return $this->tags->pluck('title')->all();
    }

    public function getRelatedPostsAttribute()
    {
        $limit = 5;

        $post_tag = $this->tags->pluck('id')->all();

        $relatedPosts = Post::where('status', true)
            ->whereHas('tags', function($q) use ($post_tag){
                $q->whereIn('id', $post_tag);
            })
            ->where('id', '!=', $this->id)
            ->orderBy('updated_at', 'desc')
            ->limit($limit)
            ->get();

        $additionPosts = null;

        if ($relatedPosts->count() < $limit) {
            $categoryLimit = $limit - $relatedPosts->count();
            $additionPosts = Post::where('status', true)
                ->where('category_id', $this->category_id)
                ->where('id', '!=', $this->id)
                ->orderBy('updated_at', 'desc')
                ->limit($categoryLimit)
                ->get();
        }
        if ($additionPosts) {
            foreach ($additionPosts as $post) {
                if (!in_array($post->id, $relatedPosts->pluck('id')->all())) {
                    $relatedPosts->push($post);
                }
            }
        }

        return $relatedPosts;
    }
}
