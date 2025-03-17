<?php

namespace App\Entity;

use App\Repository\ScheduleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: ScheduleRepository::class)]
class Schedule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $day = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $morning_subject = null;

    #[ORM\Column(length: 255)]
    private ?string $afternoon_subject = null;

    #[ORM\Column(length: 255)]
    private ?string $morning_teacher = null;

    #[ORM\Column(length: 255)]
    private ?string $afternoon_teacher = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): static
    {
        $this->day = $day;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getMorningSubject(): ?string
    {
        return $this->morning_subject;
    }

    public function setMorningSubject(string $morning_subject): static
    {
        $this->morning_subject = $morning_subject;

        return $this;
    }

    public function getAfternoonSubject(): ?string
    {
        return $this->afternoon_subject;
    }

    public function setAfternoonSubject(string $afternoon_subject): static
    {
        $this->afternoon_subject = $afternoon_subject;

        return $this;
    }

    public function getMorningTeacher(): ?string
    {
        return $this->morning_teacher;
    }

    public function setMorningTeacher(string $morning_teacher): static
    {
        $this->morning_teacher = $morning_teacher;

        return $this;
    }

    public function getAfternoonTeacher(): ?string
    {
        return $this->afternoon_teacher;
    }

    public function setAfternoonTeacher(string $afternoon_teacher): static
    {
        $this->afternoon_teacher = $afternoon_teacher;

        return $this;
    }
}
