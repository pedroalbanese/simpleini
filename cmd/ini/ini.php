<?php

function usage($name) {
    fwrite(STDERR, "Usage: php $name [-f file] <set|get|del> [section] [parameter] [value]\n");
    exit(1);
}

function parseIniFileWithSections($filename) {
    return parse_ini_file($filename, true, INI_SCANNER_RAW);
}

function writeIniFile($filename, $assoc_array) {
    $content = '';
    foreach ($assoc_array as $section => $values) {
        $content .= "[$section]\n";
        foreach ($values as $key => $value) {
            $content .= "$key = \"$value\"\n";
        }
        $content .= "\n";
    }
    file_put_contents($filename, $content);
}

$options = getopt("f:");
$file = $options['f'] ?? null;

$args = array_values(array_diff($argv, array("-f", $file)));
array_shift($args); // Remove script name

if (count($args) < 1) {
    usage($argv[0]);
}

$cmd = $args[0];
$section = $args[1] ?? null;
$param = $args[2] ?? null;
$value = $args[3] ?? null;

$stdin = false;
if ($file === '-' || $file === null) {
    $stdin = true;
    $file = "php://stdin";
    $data = stream_get_contents(STDIN);
    $tmp = tmpfile();
    fwrite($tmp, $data);
    $meta = stream_get_meta_data($tmp);
    $file = $meta['uri'];
}

if (!file_exists($file)) {
    touch($file);
}

$ini = parseIniFileWithSections($file);

if ($cmd === "get") {
    if (!$section) {
        echo implode("\n", array_keys($ini)) . "\n";
        exit(0);
    }
    if (!$param) {
        echo implode("\n", array_keys($ini[$section] ?? [])) . "\n";
        exit(0);
    }
    echo $ini[$section][$param] ?? '' . "\n";
    exit(0);
}

if ($cmd === "set") {
    if (!$section || !$param || $value === null) {
        usage($argv[0]);
    }
    $ini[$section][$param] = $value;
    if (!$stdin) {
        writeIniFile($file, $ini);
    } else {
        writeIniFile("php://stdout", $ini);
    }
    exit(0);
}

if ($cmd === "del") {
    if ($section && !$param) {
        unset($ini[$section]);
    } elseif ($section && $param) {
        unset($ini[$section][$param]);
        if (empty($ini[$section])) {
            unset($ini[$section]);
        }
    } else {
        usage($argv[0]);
    }

    if (!$stdin) {
        writeIniFile($file, $ini);
    } else {
        writeIniFile("php://stdout", $ini);
    }
    exit(0);
}

usage($argv[0]);
