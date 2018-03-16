<?php
/**
 *  BlockGridFactory.php
 *
 *
 *  @license    see LICENSE File
 *  @filename   BlockGridFactory.php
 *  @package    inky-parse
 *  @author     Thomas Hampe <github@hampe.co>
 *  @copyright  2013-2016 Thomas Hampe
 *  @date       27.02.16
 */ 


namespace IncentFit\Inky\Component;


use IncentFit\Inky\Inky;
use PHPHtmlParser\Dom\HtmlNode;

class BlockGridFactory extends AbstractComponentFactory
{
    const NAME = 'block-grid';

    /**
     * @return string
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * <block-grid up="{up}">{inner}</block-grid>
     * ------------------------------------------
     * <table class="block-grid up-{up}">
     *  <tr>{inner}</tr>
     * </table>
     *
     * @param HtmlNode $element
     * @param Inky $inkyInstance
     *
     * @return HtmlNode
     */
    public function parse(HtmlNode $element, Inky $inkyInstance)
    {
        $upAttribute = (string) $element->getAttribute('up');
        $table = $this->table(array('class' => trim(sprintf(
            'block-grid up-%s %s',
            $upAttribute,
            (string) $element->getAttribute('class')
        ))));
        $tr = $this->tr();
        $this->copyChildren($element, $tr);
        $table->addChild($tr);

        return $table;
    }


}