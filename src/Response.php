<?php namespace SpamScore;

/**
 * Class Response
 * @package SpamScore
 */
class Response implements ResponseInterface, \JsonSerializable
{

    /**
     * Most mail services use five as the minimum
     * threshold before an email is flagged as spam
     */
    const MIN_SCORE_THRESHOLD = 5;

    /**
     * @var Report|null
     */
    protected $report;

    /**
     * @var float
     */
    protected $score;

    /**
     * Response constructor.
     * @param integer $score
     * @param null    $report
     */
    public function __construct($score, $report = null)
    {

        $this->score  = $score;
        $this->report = $report ? new Report($report) : null;
    }

    /**
     * @return Report|null
     */
    public function getReport()
    {

        return $this->report;
    }

    /**
     * @return float
     */
    public function getScore()
    {

        return (float) $this->score;
    }

    /**
     * @return bool
     */
    public function isSpam()
    {

        return $this->score >= static::MIN_SCORE_THRESHOLD;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {

        return [
            'score'  => $this->getScore(),
            'report' => $this->getReport()
        ];
    }
}
