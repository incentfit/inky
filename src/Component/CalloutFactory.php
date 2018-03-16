<?php
/**
 *  CalloutFactory.php
 *
 *
 *  @license    see LICENSE File
 *  @filename   CalloutFactory.php
 *  @package    inky-parse
 *  @author     Thomas Hampe <github@hampe.co>
 *  @copyright  2013-2016 Thomas Hampe
 *  @date       13.03.16
 */


namespace IncentFit\Inky\Component;

use IncentFit\Inky\Inky;
use PHPHtmlParser\Dom\HtmlNode;

class CalloutFactory extends AbstractComponentFactory
{

    const NAME = 'callout';

    /**
     * @return string
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * <callout>{inner}</callout>
     * ----------------------------------
     *  <table class="callout">
     *      <tr>
     *          <th class="callout-inner">Callout</th>
     *          <th class="expander"></th>
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
        $table = $this->table($this->getUsableAttributes($element, 'class'));
        $this->addCssClass('callout', $table);
        $tr = $this->tr();

        $th = $this->th($element->getAttributes());
        $this->addCssClass('callout-inner', $th);
        $this->copyChildren($element, $th);
        $tr->addChild($th);
        $expander = $this->th(['class' => 'expander']);
        $tr->addChild($expander);
        $table->addChild($tr);
        return $table;
    }


}