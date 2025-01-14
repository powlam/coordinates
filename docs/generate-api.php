<?php

require 'vendor/autoload.php';

$directory = new RecursiveDirectoryIterator('src');
$iterator = new RecursiveIteratorIterator($directory);
$regex = new RegexIterator($iterator, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);

$docs = '';

foreach ($regex as $file) {
    $filePath = $file[0];
    $relativePath = str_replace(realpath('src').DIRECTORY_SEPARATOR, '', realpath($filePath));
    $className = 'Powlam\\Coordinates\\'.str_replace([DIRECTORY_SEPARATOR, '.php'], ['\\', ''], $relativePath);

    if (class_exists($className) || trait_exists($className) || interface_exists($className) || enum_exists($className)) {
        $reflection = new ReflectionClass($className);
        if ($reflection->isInstantiable()) {
            echo 'Processing class: '.$reflection->getName()."\n";
            $docs .= "\n\n------\n\n";
            $docs .= '## Class: '.$reflection->getName()."\n\n";
            if ($docComment = getDocComment($reflection)) {
                $docs .= "```php\n";
                $docs .= $docComment;
                $docs .= "```\n\n";
            }

            if ($parentClass = $reflection->getParentClass()) {
                $docs .= "#### Extends\n\n* ".$parentClass->getName()."\n\n";
            }

            if (! empty($interfaces = $reflection->getInterfaceNames())) {
                $docs .= "#### Implements\n\n* ".implode("\n* ", $interfaces)."\n\n";
            }

            if (! empty($traits = $reflection->getTraitNames())) {
                $docs .= "#### Uses Traits\n\n* ".implode("\n* ", $traits)."\n\n";
            }

            if (! empty($constants = $reflection->getConstants())) {
                $docs .= "#### Constants\n\n";
                foreach ($constants as $name => $value) {
                    $docs .= "* `$name` = ".var_export($value, true)."\n";
                }
                $docs .= "\n";
            }

            $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);
            foreach ($methods as $method) {
                echo 'Processing method: '.$method->getName()."\n";
                $docs .= '### Method: '.$method->getName()."\n\n";
                $docs .= "```php\n";
                $docs .= getDocComment($method);
                $docs .= $reflection->getName().'::'.$method->getName().'(';
                $params = [];
                foreach ($method->getParameters() as $param) {
                    $paramStr = '$'.$param->getName();
                    if ($param->hasType()) {
                        $paramStr = $param->getType().' '.$paramStr;
                    }
                    if ($param->isOptional()) {
                        $paramStr .= ' = '.var_export($param->getDefaultValue(), true);
                    }
                    $params[] = $paramStr;
                }
                $docs .= implode(', ', $params).')';
                if ($method->hasReturnType()) {
                    $docs .= ': '.$method->getReturnType();
                }
                $docs .= "\n```\n\n";
            }
        } else {
            echo 'Class is not instantiable: '.$className."\n";
            if ($reflection->isTrait()) {
                $docs .= "\n\n------\n\n";
                $docs .= '## Trait: '.$reflection->getName()."\n\n";
                if ($docComment = getDocComment($reflection)) {
                    $docs .= "```php\n";
                    $docs .= $docComment;
                    $docs .= "```\n\n";
                }
                $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);
                foreach ($methods as $method) {
                    echo 'Processing method: '.$method->getName()."\n";
                    $docs .= '### Method: '.$method->getName()."\n\n";
                    $docs .= "```php\n";
                    $docs .= getDocComment($method);
                    $docs .= $reflection->getName().'::'.$method->getName().'(';
                    $params = [];
                    foreach ($method->getParameters() as $param) {
                        $paramStr = '$'.$param->getName();
                        if ($param->hasType()) {
                            $paramStr = $param->getType().' '.$paramStr;
                        }
                        if ($param->isOptional()) {
                            $paramStr .= ' = '.var_export($param->getDefaultValue(), true);
                        }
                        $params[] = $paramStr;
                    }
                    $docs .= implode(', ', $params).')';
                    if ($method->hasReturnType()) {
                        $docs .= ': '.$method->getReturnType();
                    }
                    $docs .= "\n```\n\n";
                }
            } elseif ($reflection->isInterface()) {
                $docs .= "\n\n------\n\n";
                $docs .= '## Interface: '.$reflection->getName()."\n\n";
                if ($docComment = getDocComment($reflection)) {
                    $docs .= "```php\n";
                    $docs .= $docComment;
                    $docs .= "```\n\n";
                }
                $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);
                foreach ($methods as $method) {
                    echo 'Processing method: '.$method->getName()."\n";
                    $docs .= '### Method: '.$method->getName()."\n\n";
                    $docs .= "```php\n";
                    $docs .= getDocComment($method);
                    $docs .= $reflection->getName().'::'.$method->getName().'(';
                    $params = [];
                    foreach ($method->getParameters() as $param) {
                        $paramStr = '$'.$param->getName();
                        if ($param->hasType()) {
                            $paramStr = $param->getType().' '.$paramStr;
                        }
                        if ($param->isOptional()) {
                            $paramStr .= ' = '.var_export($param->getDefaultValue(), true);
                        }
                        $params[] = $paramStr;
                    }
                    $docs .= implode(', ', $params).')';
                    if ($method->hasReturnType()) {
                        $docs .= ': '.$method->getReturnType();
                    }
                    $docs .= "\n```\n\n";
                }
            } elseif ($reflection->isEnum()) {
                $docs .= "\n\n------\n\n";
                $docs .= '## Enum: '.$reflection->getName()."\n\n";
                if ($docComment = getDocComment($reflection)) {
                    $docs .= "```php\n";
                    $docs .= $docComment;
                    $docs .= "```\n\n";
                }
                if (! empty($cases = $reflection->getConstants())) {
                    $docs .= "#### Values\n\n";
                    foreach ($cases as $name => $value) {
                        $docs .= "* `$name`\n";
                    }
                    $docs .= "\n";
                }

                $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);
                foreach ($methods as $method) {
                    if (in_array($method->getName(), ['cases', 'from', 'tryFrom'])) {
                        continue;
                    }
                    echo 'Processing method: '.$method->getName()."\n";
                    $docs .= '### Method: '.$method->getName()."\n\n";
                    $docs .= "```php\n";
                    $docs .= getDocComment($method);
                    $docs .= $reflection->getName().'::'.$method->getName().'(';
                    $params = [];
                    foreach ($method->getParameters() as $param) {
                        $paramStr = '$'.$param->getName();
                        if ($param->hasType()) {
                            $paramStr = $param->getType().' '.$paramStr;
                        }
                        if ($param->isOptional()) {
                            $paramStr .= ' = '.var_export($param->getDefaultValue(), true);
                        }
                        $params[] = $paramStr;
                    }
                    $docs .= implode(', ', $params).')';
                    if ($method->hasReturnType()) {
                        $docs .= ': '.$method->getReturnType();
                    }
                    $docs .= "\n```\n\n";
                }
            }
        }
    } else {
        echo 'Class not found: '.$className."\n";
    }
}

$header = <<<'EOT'
<p align="center">
    <img src="https://raw.githubusercontent.com/powlam/coordinates/main/docs/coordinatesLogo.png" alt="Coordinates for Php">
    <p align="center">
        <a href="https://github.com/powlam/coordinates/actions"><img alt="GitHub Workflow Status (master)" src="https://img.shields.io/github/actions/workflow/status/powlam/coordinates/tests.yml"></a>
        <a href="https://packagist.org/packages/powlam/coordinates"><img alt="Total Downloads" src="https://img.shields.io/packagist/dt/powlam/coordinates"></a>
        <a href="https://packagist.org/packages/powlam/coordinates"><img alt="Latest Version" src="https://img.shields.io/packagist/v/powlam/coordinates"></a>
        <a href="https://packagist.org/packages/powlam/coordinates"><img alt="License" src="https://img.shields.io/packagist/l/powlam/coordinates"></a>
    </p>
</p>
EOT;

$footer = <<<'EOT'
------

**Coordinates for PHP** was created by **[Paul Albandoz](https://github.com/powlam)** under the **[MIT license](https://opensource.org/licenses/MIT)**.
EOT;

file_put_contents('docs/API_DOCUMENTATION.md', $header.$docs.$footer);

echo "API documentation generated in API_DOCUMENTATION.md\n";

function getDocComment(ReflectionClass|ReflectionMethod $reflection): string
{
    $docComment = $reflection->getDocComment();
    if (empty($docComment)) {
        return '';
    }

    return str_replace('     *', ' *', $docComment)."\n";
}
