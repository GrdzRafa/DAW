<?php
namespace Frases\Entity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="tbl_Phrases")
 */
class Phrase
{
    /**
     * @var int
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @Column(type="string", name="text", nullable=false, unique=true)
     */
    private $text;

    /**
     * @ManyToOne(targetEntity="Author", inversedBy="phrases")
     * @JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

    /**
     * @ManyToMany(targetEntity="Theme", inversedBy="id", fetch="EAGER", cascade={"persist"}, orphanRemoval=true)
     * @JoinTable(
     *     name="phrase_theme",
     *     inverseJoinColumns={@JoinColumn(name="theme_id", referencedColumnName="id")}
     * )
     */
    private $themes;

    public function __construct()
    {
        $this->themes = new ArrayCollection();
    }

    public function addTheme(Theme $theme)
    {
        if (!$this->themes->contains($theme)) {
            $this->themes[] = $theme;
            $theme->addPhrase($this);
        }
        return $this;
    }

    // Métodos getter y setter
}