<?php
/**
 *  Row.php
 *
 *
 *  @license    see LICENSE File
 *  @filename   Row.php
 *  @package    inky-parse
 *  @author     Thomas Hampe <github@hampe.co>
 *  @copyright  2013-2016 Thomas Hampe
 *  @date       10.01.16
 */ 


namespace IncentFit\Inky\Component;


use IncentFit\Inky\Inky;
use PHPHtmlParser\Dom\HtmlNode;

class WrapperFactory extends AbstractComponentFactory
{

    const NAME = 'wrapper';

    public function getName()
    {
        return self::NAME;
    }

    /**
     * <wrapper>{inner}</wrapper>
     * ---------------------------
     * <table class="wrapper" align="center">
     *    <tr>
     *      <td class="wrapper-inner">{inner}</td>
     *    </tr>
     * </table>
     *
     * @param HtmlNode $element
     * @param Inky $inkyInstance
     *
     * @return HtmlNode
     */
    public function parse(HtmlNode $element, Inky $inkyInstance)
    {
        $table = $this->table($element->getAttributes());
        $this->addCssClass('wrapper', $table);
        $table->setAttribute('align', 'center');
        $tr = $this->tr();
        $td = $this->td(['class' => 'wrapper-inner']);
        $this->copyChildren($element, $td);

        $tr->addChild($td);
        $table->addChild($tr);
        return $table;
    }


}