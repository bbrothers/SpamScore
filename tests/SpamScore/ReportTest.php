<?php namespace Tests\SpamScore;


use SpamScore\Report;

class ReportTest extends \PHPUnit_Framework_TestCase
{

    /** @test */
    public function itIsInstantiated()
    {
        new Report(EmailHelper::getReport());
    }

    /** @test */
    public function itParsesARawReport()
    {

        $report = new Report(EmailHelper::getReport());

        self::assertCount(3, $report->getRows());
        self::assertEquals('GTUBE', $report->getRows()[0]['rule']);
    }
}
