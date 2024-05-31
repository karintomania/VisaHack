<?php

namespace App\Actions\Notion;

class ConvertPageToHtml
{
    public function convert(string $json): string
    {

        $data = json_decode($json, true)['results'];
        $html = '';
        $openingList = '';

        foreach ($data as $block) {
            $type = $block['type'];

            if (($type === 'numbered_list_item' || $type === 'bulleted_list_item')) {
                [$html, $openingList] = $this->handleListItem($openingList, $type, $html, $block);
            } else {
                [$html, $openingList] = $this->handleBlock($openingList, $type, $html, $block);
            }
        }

        return $html;
    }

    private function handleListItem(string $openingList, string $type, string $html, array $block): array
    {

        $listType = $type === 'numbered_list_item' ? 'ol' : 'ul';

        if (! $openingList) {
            // open a new list here
            $openingList = $listType;
            $html .= "<{$openingList}>\n";
        }

        $content = $type === 'numbered_list_item'
            ? $this->handleNumberedListItem($block)
            : $this->handleBulletedListItem($block);

        $html .= $content."\n";

        return [$html, $openingList];
    }

    private function handleBlock(string $openingList, string $type, string $html, array $block)
    {
        if ($openingList) {
            // if list is open, close here
            $html .= "</{$openingList}>\n";
            $openingList = '';
        }

        $content = match ($type) {
            'heading_1' => $this->handleHeading1($block),
            'heading_2' => $this->handleHeading2($block),
            'heading_3' => $this->handleHeading3($block),
            'paragraph' => $this->handleParagraph($block),
            'image' => $this->handleImage($block),
            default => 'defalut'
        };
        $html .= $content."\n";

        return [$html, $openingList];
    }

    private function handleImage(array $block): string
    {
        $src = data_get($block, 'image.file.url');

        return "<img src=\"{$src}\">";
    }

    private function handleHeading1(array $block): string
    {

        $content = data_get($block, 'heading_1.text.0.plain_text');

        return "<h1>{$content}</h1>";
    }

    private function handleHeading2(array $block): string
    {
        $content = data_get($block, 'heading_2.text.0.plain_text');

        return "<h2>{$content}</h2>";
    }

    private function handleHeading3(array $block): string
    {
        $content = data_get($block, 'heading_3.text.0.plain_text');

        return "<h3>{$content}</h3>";
    }

    private function handleParagraph(array $data): string
    {

        $content = array_reduce(
            data_get($data, 'paragraph.text'),
            function ($carry, $text) {
                $plain = $text['plain_text'];

                $annotations = $text['annotations'];

                if ($link = data_get($text, 'text.link')) {
                    $url = $link['url'];

                    return $carry."<a href=\"{$url}\">{$plain}</a>";
                } else {
                    if ($annotations['bold']) {
                        $plain = "<b>{$plain}</b>";
                    }
                    if ($annotations['italic']) {
                        $plain = "<i>{$plain}</i>";
                    }
                    if ($annotations['strikethrough']) {
                        $plain = "<s>{$plain}</s>";
                    }
                    if ($annotations['underline']) {
                        $plain = "<u>{$plain}</u>";
                    }
                    if ($annotations['code']) {
                        $plain = "<code>{$plain}</code>";
                    }

                    return $carry.$plain;
                }

            }
        );

        return "<p>{$content}</p>";
    }

    private function handleBulletedListItem(array $block): string
    {
        $content = data_get($block, 'bulleted_list_item.text.0.plain_text');

        return "<li>{$content}</li>";
    }

    private function handleNumberedListItem(array $block): string
    {
        $content = data_get($block, 'numbered_list_item.text.0.plain_text');

        return "<li>{$content}</li>";
    }
}
