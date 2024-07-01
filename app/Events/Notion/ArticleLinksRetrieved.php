<?php

namespace App\Events\Notion;

use App\Models\Notion\ArticleLink;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ArticleLinksRetrieved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param  ArticleLink[]  $links
     */
    public function __construct(
        public array $links,
        public string $json,
        public int $page = 1,
    ) {
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
