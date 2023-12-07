<?php

namespace App\Converter;

use JMS\Serializer\DeserializationContext;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class RequestBodyParamConverter implements ParamConverterInterface
{
    const TYPE = 'request_body';
    private Serializer $serializer;
    public function __construct()
    {
        $this->serializer = SerializerBuilder::create()->build();
    }

    public function apply(Request $request, ParamConverter $configuration) : void
    {
        $data = $this->serializer
            ->deserialize(
                $request->getContent(),
                $configuration->getClass(),
                'json',
                DeserializationContext::create()->setGroups($configuration->getOptions()['inputGroups']));
        $request->attributes->set($configuration->getName(), $data);
    }

    public function supports(ParamConverter $configuration): bool
    {
        return $configuration->getConverter() === self::TYPE;
    }
}