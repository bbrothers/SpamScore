<?php namespace SpamScore\Providers\Postmark;


use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface;
use SpamScore\GatewayInterface;
use SpamScore\Response;

class Gateway implements GatewayInterface
{

    const WEBSERVICE_URL = 'http://spamcheck.postmarkapp.com/filter';

    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * @var bool
     */
    protected $longReport;

    /**
     * @var  string
     */
    protected $report;


    public function __construct(ClientInterface $client = null)
    {

        $this->client = $client ?: new HttpClient();
    }

    public function score($emailBody, $longReport = false)
    {

        $request = $this->client->post(
            self::WEBSERVICE_URL,
            [
                'email'   => $emailBody,
                'options' => ($longReport ? 'long' : 'short'),
                'headers' => ['Content-Type' => 'application/json']
            ]
        );

        $response = json_decode($request->getBody());

        return new Response($response['score'], $response['report']);
    }
}
