<?php
/**
 *  Test.php
 *
 *
 *  @license    see LICENSE File
 *  @filename   Test.php
 *  @package    inky-parse
 *  @author     Thomas Hampe <github@hampe.co>
 *  @copyright  2013-2016 Thomas Hampe
 *  @date       13.03.16
 */

use PHPHtmlParser\Dom;


class InkyTest extends PHPUnit_Framework_TestCase {

    public function testGridColumns()
    {
        $inky = new \IncentFit\Inky\Inky(10);
        $this->assertEquals(10, $inky->getGridColumns(), 'Inky Grid Coulmns');

        $inky->setGridColumns(23);
        $this->assertEquals(23, $inky->getGridColumns(), 'Inky Grid Columns');
    }

    public function testAlias()
    {
        $inky = new \IncentFit\Inky\Inky();

        $inky->addAlias('test', 'callout');
        $this->assertContains('test', $inky->getAllAliasForTagName('callout'), 'Inky Alias for Tag');
        $this->assertEquals($inky->getComponentFactory('callout'), $inky->getComponentFactory('test'));
        $this->assertEquals('<table class="callout"><tr><th class="callout-inner">Test</th><th class="expander"></th></tr></table>', $inky->releaseTheKraken('<test>Test</test>'));


        $inky->removeAlias('test');
        $this->assertNotContains('test', $inky->getAllAliasForTagName('callout'));
        $this->assertEquals(null, $inky->getComponentFactory('test'));
        $this->assertEquals('<test>Test</test>', $inky->releaseTheKraken('<test>Test</test>'));

    }

    public function testStyles()
    {
        $inky = new \IncentFit\Inky\Inky();

        $stylesTestCases = array(
            'Style tags are being stripped out #7' => array(
                'from' => '<style>body { text-decoration: underline}</style>',
                'to' => '<style>body { text-decoration: underline}</style>'
            )
        );

        foreach($stylesTestCases as $caseName => $testCase) {
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
