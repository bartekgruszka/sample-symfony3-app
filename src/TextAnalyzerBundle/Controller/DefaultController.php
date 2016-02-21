<?php

namespace TextAnalyzerBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TextAnalyzerBundle\Entity\TextToAnalyze;
use TextAnalyzerBundle\Form\Type\SavedTextLoaderType;
use TextAnalyzerBundle\Form\Type\TextToAnalyzeType;

class DefaultController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/", name="index")
     */
    public function indexAction(Request $request)
    {
        $textAnalyzer = new TextToAnalyze();
        $formProcess = $this->createForm(TextToAnalyzeType::class, $textAnalyzer);

        $formLoad = $this->createForm(SavedTextLoaderType::class);

        $formProcess->handleRequest($request);
        $formLoad->handleRequest($request);

        if ($formProcess->isSubmitted() && $formProcess->isValid()) {
            $data = $formProcess->getData();

            if ($formProcess->get('process')->isClicked()) {
                return $this->process($data);
            } elseif ($formProcess->get('save')->isClicked()) {
                return $this->save($data);
            }
        }


        if ($formLoad->isSubmitted() && $formLoad->isValid()) {
            $data = $formLoad->getData();

            return $this->load($data['entity']);
        }

        return $this->render('default/index.html.twig', [
            'formProcess' => $formProcess->createView(),
            'formLoad' => $formLoad->createView()
        ]);
    }

    /**
     * @param TextToAnalyze $textToAnalyze
     * @return Response
     *
     * @Route("/results/{id}", name="results", defaults={"id"=null})
     *
     * @ParamConverter("textToAnalyze", converter="service", options={
     *   "service" = "text_analyzer.text_to_analyze_param_converter",
     * })
     */
    public function resultsAction(TextToAnalyze $textToAnalyze)
    {
        $textAnalyzer = $this->get('text_analyzer.analyzer');

        $textAnalyzer->process($textToAnalyze->getText());

        return $this->render('default/results.html.twig', [
            'textToAnalyze' => $textToAnalyze,
            'textAnalyzer' => $textAnalyzer
        ]);
    }

    /**
     * @param TextToAnalyze $textToAnalyze
     *
     * @return RedirectResponse
     */
    private function process(TextToAnalyze $textToAnalyze)
    {
        $this->get('session')->set('text_to_analyze', $textToAnalyze);

        return $this->redirect($this->generateUrl('results'));
    }

    /**
     * @param TextToAnalyze $textToAnalyze
     *
     * @return RedirectResponse
     */
    private function save(TextToAnalyze $textToAnalyze)
    {
        $this->getDoctrine()->getManager()->persist($textToAnalyze);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirect($this->generateUrl('results', [
            'id' => $textToAnalyze->getId()
        ]));
    }

    /**
     * @param TextToAnalyze $textToAnalyze
     *
     * @return RedirectResponse
     */
    private function load(TextToAnalyze $textToAnalyze)
    {
        return $this->redirect($this->generateUrl('results', [
            'id' => $textToAnalyze->getId()
        ]));
    }
}
