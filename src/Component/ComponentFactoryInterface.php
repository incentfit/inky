<?php
/**
 *  ComponentFactoryInterface.php
 *
 *
 *  @license    see LICENSE File
 *  @filename   ComponentFactoryInterface.php
 *  @package    inky-parse
 *  @author     Thomas Hampe <github@hampe.co>
 *  @copyright  2013-2016 Thomas Hampe
 *  @date       10.01.16
 */ 


namespace IncentFit\Inky\Component;


use IncentFit\Inky\Inky;
use PHPHtmlParser\Dom\AbstractNode;
use PHPHtmlParser\Dom\Collection;
use PHPHtmlParser\Dom\HtmlNode;

interface ComponentFactoryInterface
{

    /**
     * @return string
     */
    public function getName();

    /**
     * @param HtmlNode $element
     * @param Inky $inkyInstance
     *
     * @return AbstractNode|Collection
     */
    public function parse(HtmlNode $element, Inky $inkyInstance);

}