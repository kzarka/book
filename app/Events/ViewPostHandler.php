<?php

namespace App\Events;

use App\Models\Posts;
use Illuminate\Session\Store;

class ViewPostHandler
{
    private $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Posts  $post
     * @return void
     */
    public function handle(Posts $post)
    {
        if (!$this->isPostViewed($post))
        {
            $post->increment('view_count');
            $this->storePost($post);
        }
    }

    private function isPostViewed($post)
    {
        $viewed = $this->session->get('viewed_posts', []);

        return array_key_exists($post->id, $viewed);
    }

    private function storePost($post)
    {
        $key = 'viewed_posts.' . $post->id;

        $this->session->put($key, time());
    }
}