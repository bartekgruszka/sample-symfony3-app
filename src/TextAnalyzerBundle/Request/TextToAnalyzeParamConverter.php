<?php

namespace TextAnalyzerBundle\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use TextAnalyzerBundle\Entity\TextToAnalyze;
use TextAnalyzerBundle\Repository\TextToAnalyzeRepository;

class TextToAnalyzeParamConverter implements ParamConverterInterface
{
    /**
     * @var TextToAnalyzeRepository
     */
    private $textToAnalyzeRepository;

    /**
     * @param TextToAnalyzeRepository $textToAnalyzeRepository
     */
    public function __construct(TextToAnalyzeRepository $textToAnalyzeRepository)
    {
        $this->textToAnalyzeRepository = $textToAnalyzeRepository;
    }

    /**
     * @param Request $request
     * @param ParamConverter $configuration
     *
     * @return void
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        if ($request->get('id')) {
            $textToAnalyze = $this->textToAnalyzeRepository->findOneById($request->get('id'));
        } else if ($request->getSession()->has('text_to_analyze')) {
            $textToAnalyze = $request->getSession()->get('text_to_analyze');
        } else {
            throw new NotFoundHttpException();
        }

        $request->attributes->set($configuration->getName(), $textToAnalyze);
    }

    /**
     * @param ParamConverter $configuration
     * @return bool
     */
    public function supports(ParamConverter $configuration)
    {
        return $configuration->getClass() == TextToAnalyze::class;
    }
}
