<?php

namespace TextAnalyzerBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use TextAnalyzerBundle\Entity\TextToAnalyze;

class TextToAnalyzeRepository extends EntityRepository
{
    /**
     * @param int $id
     * @return TextToAnalyze
     */
    public function findOneById($id)
    {
        $textToAnalyze = $this->findOneBy(['id' => $id]);

        if (!$textToAnalyze) {
            throw new NotFoundHttpException();
        }

        return $textToAnalyze;
    }
}
