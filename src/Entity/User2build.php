<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User2build
 *
 * @ORM\Table(name="user2build", indexes={@ORM\Index(name="build_id", columns={"build_id"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class User2build
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var array
     *
     * @ORM\Column(name="state", type="simple_array", length=0, nullable=false)
     */
    private $state;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="datetime_start", type="datetime", nullable=true)
     */
    private $datetimeStart;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="datetime_end", type="datetime", nullable=true)
     */
    private $datetimeEnd;

    /**
     * @var \Build
     *
     * @ORM\ManyToOne(targetEntity="Build")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="build_id", referencedColumnName="id")
     * })
     */
    private $build;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getState(): ?array
    {
        return $this->state;
    }

    public function setState(array $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getDatetimeStart(): ?\DateTimeInterface
    {
        return $this->datetimeStart;
    }

    public function setDatetimeStart(?\DateTimeInterface $datetimeStart): self
    {
        $this->datetimeStart = $datetimeStart;

        return $this;
    }

    public function getDatetimeEnd(): ?\DateTimeInterface
    {
        return $this->datetimeEnd;
    }

    public function setDatetimeEnd(?\DateTimeInterface $datetimeEnd): self
    {
        $this->datetimeEnd = $datetimeEnd;

        return $this;
    }

    public function getBuild(): ?Build
    {
        return $this->build;
    }

    public function setBuild(?Build $build): self
    {
        $this->build = $build;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


}
