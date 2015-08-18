<?php namespace Tests\SpamScore;

use SpamScore\Response;

class ResponseTest extends \PHPUnit_Framework_TestCase
{

    /** @test */
    public function itComparesAScoreToAThreshold()
    {

        $response = new Response(10);
        self::assertTrue($response->isSpam());
        $response = new Response(1);
        self::assertFalse($response->isSpam());
    }
}
