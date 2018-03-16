# Inky

A PHP Implementation of ZURB's Foundation for Email parser ([Inky](https://github.com/zurb/inky)).

## Installation

You can install this bundle using composer

    composer require hampe/inky

or add the package to your `composer.json` file directly.

## Usage and Examples

### Basic Usage.

```php
<?php
use Hampe\Inky\Inky;

$gridColumns = 12; //optional, default is 12
$additionalComponentFactories = []; //optional
$inky = new Inky($gridColumns, $additionalComponentFactories);

$inky->releaseTheKraken('html...');
```

### Add Tag-Alias

```php
<?php
use Hampe\Inky\Inky;

$inky = new Inky();
$inky->addAlias('test', 'callout')

$inky->releaseTheKraken('<test>123</test>'); //equal to "<callout>123</callout>"
```

### Add your own component factory

Add your own component factory, to convert custom HTML-Tags.

```php
<?php

use Hampe\Inky\Component\ComponentFactoryInterface;
use Hampe\Inky\Inky;
use PHPHtmlParser\Dom\HtmlNode;

class TestComponentFactory implements ComponentFactoryInterface
{
    public function getName()
    {
        return 'test' // name of the html tag.
    }

    public function parse(HtmlNode $element, Inky $inkyInstance)
    {
        // ...
    }
}

$inky = new Inky();
$inky->addComponentFactory(new TestComponentFactory());
$inky->releaseTheKraken('<test></test>');
```

## License
See the [LICENSE](LICENSE) file for license info (it's the MIT license).

