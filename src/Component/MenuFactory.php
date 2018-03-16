<?php
/**
 *  MenuFactory.php
 *
 *
 *  @license    see LICENSE File
 *  @filename   MenuFactory.php
 *  @package    inky-parse
 *  @author     Thomas Hampe <github@hampe.co>
 *  @copyright  2013-2016 Thomas Hampe
 *  @date       27.02.16
 */ 


namespace IncentFit\Inky\Component;


use IncentFit\Inky\Inky;
use PHPHtmlParser\Dom\HtmlNode;

class MenuFactory extends AbstractComponentFactory
{

    const NAME = 'menu';

    /**
     * @return string
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * <menu>{inner}</menu>
     * ----------------------------
     * <table class="menu">
     *      <tr>
     *          <td>
     *              <table>
     *                  <tr>
     *                      {inner}
     *                  </tr>
     *              </table>
     *          </td>
     *      </tr>
     *  </table>
     *
     * @param HtmlNode $element
     * @param Inky $inkyInstance
     *
     * @return HtmlNode
     */
    public function parse(HtmlNode $element, Inky $inkyInstance)
    {
        $table = $this->table($element->getAttributes());
        $this->addCssClass('menu', $table);
        $tr = $this->tr();
        $td = $this->td();
        $childTable = $this->table();
        $childTr = $this->tr();
        $this->copyChildren($element, $childTr);

        $childTable->addChild($childTr);
        $td->addChild($childTable);
        $tr->addChild($td);
        $table->addChild($tr);

        return $table;
    }


}