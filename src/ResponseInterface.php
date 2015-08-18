<?php  namespace SpamScore;

interface ResponseInterface
{
    /**
     * Get the SpamAssassin score
     * @return float
     */
    public function getScore();

    /**
     * Get the SpamAssassin full report
     * @return Report
     */
    public function getReport();
}
