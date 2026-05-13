<?php

namespace App\Observers;

use App\Models\BlogPost;
use Illuminate\Support\Str;

class BlogPostObserver
{
    /**
     * Handle the BlogPost "creating" event.
     */
    public function creating(BlogPost $blogPost): void
    {
        if (empty($blogPost->slug)) {
            $blogPost->slug = Str::slug($blogPost->title);
        }

        if ($blogPost->status === 'Published' && empty($blogPost->published_at)) {
            $blogPost->published_at = now();
        }
    }

    /**
     * Handle the BlogPost "updating" event.
     */
    public function updating(BlogPost $blogPost): void
    {
        if ($blogPost->isDirty('status') && $blogPost->status === 'Published' && empty($blogPost->published_at)) {
            $blogPost->published_at = now();
        }
    }
}
