Number-System
========

This PHP-Library can be used to make calculations base pokemon.

Installation
------------

Number-System can be installed via. Composer:

    composer require "gries/number-system"

Rebuild the classes
------------------
In data/pokemon.csv all pokemon-data is stored. (701 pokemon)
To rebuild the classes execute.

```bash
php data/generator.php
```


Usage
-----
```php
<?php

use gries\Pokemath\Numbers\Ivysaur;
use gries\Pokemath\Numbers\Jigglypuff;
use gries\Pokemath\Numbers\Snorlax;
use gries\Pokemath\Numbers\Venusaur;
use gries\Pokemath\Numbers\Wigglytuff;

require_once __DIR__ . '/../vendor/autoload.php';


// small calculation
$ivy = new Ivysaur();
$venu = new Venusaur();

echo $ivy->add($venu)->value()."\n"; // -> charmander

// big calculation
$jiggly = new Jigglypuff();
$wiggly = new Wigglytuff();

echo $jiggly->multiply($wiggly)->value()."\n"; // -> ivysaur-chespin


// make it even bigger
$snorlax = new Snorlax();
echo $snorlax
        ->multiply($snorlax)
        ->multiply($snorlax)
        ->multiply($snorlax)
        ->multiply($snorlax)
        ->multiply($snorlax)
        ->value()."\n"; // -> nidorino-sandslash-klinklang-drifloon-gothita
```

Author
------

- [Christoph Rosse](http://twitter.com/griesx)

License
-------

For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
