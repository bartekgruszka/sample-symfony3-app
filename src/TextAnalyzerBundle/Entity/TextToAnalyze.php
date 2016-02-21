<?php

namespace TextAnalyzerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="TextAnalyzerBundle\Repository\TextToAnalyzeRepository")
 * @ORM\Table(name="text_to_analyze")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("name")
 */
class TextToAnalyze
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, unique=true)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    protected $text;

    /**
     * @ORM\PrePersist
     */
    public function setEmptyName()
    {
        if (empty($this->name)) {
            $date = (new \DateTime())->format('Y-m-d H:i:s');

            $this->name = sprintf("Unnamed - %s", $date);
        }
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }
}
