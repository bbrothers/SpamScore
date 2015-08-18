<?php

namespace SpamScore;

interface GatewayInterface
{

    /**
     * Score the provide email text
     *
     * @param string     $emailBody  The email being scored
     * @param bool|false $longReport Should a report be included
     * @return ResponseInterface
     */
    public function score($emailBody, $longReport = false);
}
