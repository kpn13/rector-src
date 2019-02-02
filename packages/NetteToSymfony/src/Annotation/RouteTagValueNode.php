<?php declare(strict_types=1);

namespace Rector\NetteToSymfony\Annotation;

use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocChildNode;

final class RouteTagValueNode implements PhpDocChildNode
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string
     */
    private $routeClass;

    /**
     * @var string[]
     */
    private $methods = [];

    /**
     * @param string[] $methods
     */
    public function __construct(string $routeClass, string $path, ?string $name = null, array $methods = [])
    {
        $this->path = $path;
        $this->name = $name;
        $this->routeClass = $routeClass;
        $this->methods = $methods;
    }

    public function __toString(): string
    {
        $string = sprintf('@\\%s(', $this->routeClass);

        $string .= sprintf('path="%s"', $this->path);
        if ($this->name) {
            $string .= sprintf(', name="%s"', $this->name);
        }

        if ($this->methods) {
            $string .= sprintf(', methods={"%s"}', implode('", "', $this->methods));
        }

        $string .= ')' . PHP_EOL . ' ';

        return $string;
    }
}
