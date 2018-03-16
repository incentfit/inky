<?php
/**
 *  AbstractComponentFactoryTest.php
 *
 *
 *  @license    see LICENSE File
 *  @filename   AbstractComponentFactoryTest.php
 *  @package    inky-parse
 *  @author     Thomas Hampe <github@hampe.co>
 *  @copyright  2013-2016 Thomas Hampe
 *  @date       28.02.16
 */ 


namespace Component;


use IncentFit\Inky\Inky;
use PHPHtmlParser\Dom;

class AbstractComponentFactoryTest extends \PHPUnit_Framework_TestCase {

    protected $inky = null;

    protected $testCases = array(
        'Case 1' => array(
            'from' => '',
            'to' => ''
        )
    );

    protected function getInkyInstance()
    {
        if(!$this->inky) {
            $this->inky = new Inky();
        }
        return $this->inky;
    }

    public function testParse()
    {
        $inky = $this->getInkyInstance();
        foreach($this->testCases as $caseName => $testCase) {
            $fromHtml = trim(preg_replace('~>\s+<~', '><', $testCase['from']));
            $dom = new Dom();
            $dom->setOptions([
                'removeStyles' => false,
                'removeScripts' => false,
            ]);
            $dom->load((string)  trim(preg_replace('~>\s+<~', '><', $testCase['to'])));
            $toHtml = $dom->root->outerHtml();
            $result = $inky->releaseTheKraken($fromHtml);
            $this->assertEquals($toHtml, $result, sprintf('Case failed: %s', $caseName));
        }
    }

}
