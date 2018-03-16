<?php
/**
 *  ContainerFactory.php
 *
 *
 *  @license    see LICENSE File
 *  @filename   ContainerFactory.php
 *  @package    inky-parse
 *  @author     Thomas Hampe <github@hampe.co>
 *  @copyright  2013-2016 Thomas Hampe
 *  @date       10.01.16
 */ 


namespace IncentFit\Inky\Component;

use IncentFit\Inky\Inky;
use PHPHtmlParser\Dom\HtmlNode;

class ContainerFactory extends AbstractComponentFactory
{

    const NAME = 'container';

    public function getName()
    {
        return self::NAME;
    }
    /**
     * <container>{inner}</container>
     * ----------------------------------
     * <table class="container {class}">
     *  <tbody>
     *      <tr>
     *          <td>{inner}</td>
     *      </tr>
     *  </tbody>
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
        $this->addCssClass('container', $table);
        $table->setAttribute('align', 'center');

        $tbody = $this->tbody();
        $tr = $this->tr();
        $td = $this->td();
        $this->copyChildren($element, $td);

        $tr->addChild($td);
        $tbody->addChild($tr);
        $table->addChild($tbody);
        return $table;
    }


}
