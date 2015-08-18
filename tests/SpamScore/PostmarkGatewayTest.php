<?php namespace Tests\SpamScore;


use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use SpamScore\Response;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response as HttpResponse;
use SpamScore\SpamScore;

class PostmarkGatewayTest extends \PHPUnit_Framework_TestCase
{

    /** @test */
    public function itReturnsAResponseInstance()
    {

        /** @var \SpamScore\Providers\Postmark\Gateway $gateway */
        $gateway = SpamScore::create('Postmark', $this->getMockClient());

        $response = $gateway->score('no-op', true);

        self::assertInstanceOf(Response::class, $response);
    }

    /**
     * Get a mocked HTTP client
     *
     * @return array
     */
    protected function getMockClient()
    {

        $mock = new MockHandler([
            $this->getMockResponse()
        ]);

        $handler = HandlerStack::create($mock);
        $client  = new Client(['handler' => $handler]);

        return $client;
    }

    /**
     * Get a mock response
     *
     * @return Response
     */
    protected function getMockResponse()
    {

        $response = new HttpResponse(
            200,
            [
                'success' => true,
                'report'  => EmailHelper::getReport(),
                'score'   => 1
            ]
        );

        return $response;
    }
}
