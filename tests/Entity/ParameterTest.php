<?php

namespace App\Tests\Entity;

use App\Entity\Parameter;
use PHPUnit\Framework\TestCase;

class ParameterTest extends TestCase
{
    private $parameter;

    public function __construct()
    {
        parent::__construct();
        $parameter = new Parameter();
        $parameter->setCode("test_code");
        $parameter->setLabels([
            "fr_FR" => "Test param",
            "en_EN" => "Test param EN"
        ]);
        $parameter->getTemplate("text.html.twig");

        $this->parameter = $parameter;
    }

    public function test_a_test_should_have_a_code()
    {
        $this->assertThat("test_code", $this->equalTo($this->parameter->getCode()));
    }

    public function test_a_test_should_have_a_fr_label()
    {
        $this->assertThat("Test param", $this->equalTo($this->parameter->getOneLabel("fr_FR")));
    }
}
