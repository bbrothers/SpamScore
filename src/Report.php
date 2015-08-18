<?php namespace SpamScore;

/**
 * Class Report
 * @package SpamScore
 */
class Report implements \JsonSerializable
{

    /**
     * @var string
     */
    protected $raw;

    /**
     * @var array
     */
    protected $rows = [];

    /**
     * @param $raw
     */
    public function __construct($raw)
    {

        if ( ! is_string($raw)) {
            throw new \InvalidArgumentException("The report must be a string value.");
        }
        $this->raw = $raw;
        $this->parseRawReport();
    }

    /**
     * Parse the raw report to a usable format
     */
    protected function parseRawReport()
    {

        preg_match_all($this->getPattern(), $this->raw, $match);
        $count = count($match[0]);

        $row = [];
        for ($i = 0; $i < $count; $i++) {
            $row[$i] = [
                'score'   => $match['score'][$i],
                'rule'    => $match['rule'][$i],
                'message' => $match['message'][$i]
            ];
        }
        $this->rows = $row;
    }

    /**
     * @return string
     */
    public function getRaw()
    {

        return $this->raw;
    }

    /**
     * @return array
     */
    public function getRows()
    {

        return $this->rows;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {

        return $this->getRows();
    }

    /**
     * @return string
     */
    public function __toString()
    {

        return json_encode($this);
    }

    /**
     * @return string
     */
    protected function getPattern()
    {

        return strtr(
            '/ <score> <rule> {0,15}<message>/',
            [
                '<score>'   => '(?P<score>-?\d{1,4}\.?\d?)',
                '<rule>'    => '(?P<rule>[A-Z_\d]+)',
                '<message>' => '(?<message>.+(?:\n {2,30})?.*)'
            ]
        );
    }
}
