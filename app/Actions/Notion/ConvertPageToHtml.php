<?php

namespace App\Actions\Notion;

class ConvertPageToHtml
{
    public function convert(string $json): string
    {

        $data = json_decode($json, true)['results'];
        $html = '';

        foreach ($data as $block) {
            $type = $block['type'];

            $content = match ($type) {
                'heading_1' => $this->handleHeading1($block),
                'heading_2' => $this->handleHeading2($block),
                'heading_3' => $this->handleHeading3($block),
                'paragraph' => $this->handleParagraph($block),
                'image' => $this->handleImage($block),
                default => 'defalut'

            };
            $html .= $content."\n";
        }

        return $html;
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

                return $carry .= $plain;
            }
        );

        return "<p>{$content}</p>";
    }
}
