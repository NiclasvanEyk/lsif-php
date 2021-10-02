<?php


class GraphTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function it_parses_stuff(): void
    {
        $contents = '<?php
        namespace Foo\Bar;

        class Quox
        {
            public string $myMember = "foo";
            
            public function helloWorld(): void
            {
                echo $this->myMember . " World";
            }
        }
        ';


        (new \NiclasVanEyk\LsifPhp\Implementations\Custom\FileTraverser())
            ->parse($contents);
    }
}