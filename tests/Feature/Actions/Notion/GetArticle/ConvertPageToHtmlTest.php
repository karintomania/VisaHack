<?php

namespace Tests\Feature\Actions\Notion;

use App\Actions\Notion\GetArticle\ConvertPageToHtml;
use Tests\TestCase;

class ConvertPageToHtmlTest extends TestCase
{
    public function test_convert_converts(): void
    {

        $expected = <<<'HTML'
        <h1>How to write a test Blog using Notion</h1>
        <p>This is a test article. Let’s try not to use blocks for multiple lines.
        I can use Shift + Enter for that.</p>
        <h2>This is a header 2</h2>
        <h3>This is a header 3</h3>
        <p>This is with <u><b>style</b></u>.</p>
        <p>This is with link: <a href="https://example.com">link to somewhere</a>.</p>
        <ol>
        <li>numbered 1</li>
        <li>numbered 2</li>
        </ol>
        <p></p>
        <ul>
        <li>bulleted 1</li>
        <li>bulleted 2</li>
        </ul>
        <img src="https://fastly.picsum.photos/id/686/800/800.jpg?hmac=YqfsJsRmmHGlApJA9jf_TKx1v4U2N4FPoBzj9rdqilo">

        HTML;
        $converter = new ConvertPageToHtml();

        $json = file_get_contents(dirname(__FILE__).'/convert_page_test.json');

        $result = $converter->__invoke($json);

        $this->assertEquals($expected, $result);
    }
}
