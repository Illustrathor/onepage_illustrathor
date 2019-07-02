<?php
/**
 * Created by PhpStorm.
 * User: twilmshorst
 * Date: 24/04/19
 * Time: 09:06
 */

namespace App\Extensions\Portfolio\Twig;


use App\Entity\Parameter;
use App\Repository\ParameterRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class PTwigExtension extends AbstractExtension
{

    private $parameterRepository;

    public function __construct(ParameterRepository $parameterRepository)
    {
        $this->parameterRepository = $parameterRepository;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('price', [$this, 'formatPrice'])
        ];
    }

    public function formatPrice($number)
    {
        return $number;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('getConfig', [$this, 'getConfig'])
        ];
    }

    public function calculateArea($width, $length)
    {
        return $width * $length;
    }

    public function getConfig($code)
    {
        /** @var Parameter $parameter */
        $parameter = $this->parameterRepository->findOneBy(['code' => $code]);
        return $parameter;
    }
}