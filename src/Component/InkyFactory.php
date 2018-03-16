<?php
/**
 *  InkyFactory.php
 *
 *
 *  @license    see LICENSE File
 *  @filename   InkyFactory.php
 *  @package    inky-parse
 *  @author     Thomas Hampe <github@hampe.co>
 *  @copyright  2013-2016 Thomas Hampe
 *  @date       27.02.16
 */ 


namespace IncentFit\Inky\Component;


use IncentFit\Inky\Inky;
use PHPHtmlParser\Dom\HtmlNode;

class InkyFactory extends AbstractComponentFactory
{

    protected $inkySrc = 'https://raw.githubusercontent.com/arvida/emoji-cheat-sheet.com/master/public/graphics/emojis/octopus.png';

    const NAME = 'inky';

    public function getName()
    {
        return self::NAME;
    }

    /**
     * <inky />
     * ----------------------------
     * <tr>
     *  <td>
     *      <img src="{inkySrc}" />
     *  </td>
     * </tr>
     *
     * @param HtmlNode $element
     * @param Inky $inkyInstance
     *
     * @return HtmlNode
     */
    public function parse(HtmlNode $element, Inky $inkyInstance)
    {
        $tr = $this->tr();
        $td = $this->td();
        $img = $this->img(array('src' => $this->inkySrc));
        $td->addChild($img);
        $tr->addChild($td);

        return $tr;
    }


}