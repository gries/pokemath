<?php

$content = file_get_contents(__DIR__.'/pokemon.csv');

$rows = explode("\n", $content);
unset($rows[0]);

$data = [];
foreach ($rows as $pokeRow) {
    $pokeData = explode(',', $pokeRow);
if (!isset($pokeData[2])) {continue;}
    $id = $pokeData[2];
    $name = $pokeData[1];
    if (isset($data[$id])) {
        echo sprintf("Duplicate: %s - %s \n", $name, $data[$id]);
    }

    $data[$id] = $name;
}

// first generate the number classes
$template = file_get_contents(__DIR__.'/NumberTemplate.php.tmpl');
$basePath = __DIR__.'/../src/Numbers';
foreach ($data as $id => $name) {
    $classname = ucfirst($name);
    $classpath = $basePath.'/'.$classname.'.php';
    $classContent = str_replace(['CLASSNAME', 'VALUE'], [$classname, $name], $template);

    file_put_contents($classpath, $classContent);
}

// now generate the number system

$template = file_get_contents(__DIR__.'/NumberSystemTemplate.php.tmpl');
$path = __DIR__.'/../src/PokeNumberSystem.php';

$symbols = '';
foreach ($data as $id => $name) {
    $symbols .= "            '".$name."',\n";
}
$content = str_replace('SYMBOLS', $symbols, $template);

file_put_contents($path, $content);
