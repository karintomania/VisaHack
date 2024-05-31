<?php

namespace Tests\Feature\Actions\Notion;

use App\Actions\Notion\ConvertPageToHtml;
use Tests\TestCase;

class ConvertPageToHtmlTest extends TestCase
{
    public function test_convert_converts(): void
    {

        $expected = <<<'HTML'
        <h1>Test Blog</h1>
        <p>This is a test article. Let’s try not to use blocks for multiple lines.
        I can use Shift + Enter for that.</p>
        <h2>This is a header 2</h2>
        <h3>This is a header 3</h3>
        <p>This is with <u><b>style</b></u>.</p>
        <img src="http://example.com/picture.gif">

        HTML;
        $converter = new ConvertPageToHtml();

        $json = file_get_contents(dirname(__FILE__).'/convert_page_test.json');

        $result = $converter->convert($json);

        $this->assertEquals($expected, $result);
    }
}
