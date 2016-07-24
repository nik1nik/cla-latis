<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Student
 *
 * @ORM\Table(name="student")
 * @ORM\Entity
 */
class Student
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="student_name", type="string", length=50, nullable=false)
     */
    private $studentName;

    /**
     * @var string
     *
     * @ORM\Column(name="student_email", type="string", length=100, nullable=false)
     */
    private $studentEmail;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set studentName
     *
     * @param string $studentName
     *
     * @return Student
     */
    public function setStudentName($studentName)
    {
        $this->studentName = $studentName;

        return $this;
    }

    /**
     * Get studentName
     *
     * @return string
     */
    public function getStudentName()
    {
        return $this->studentName;
    }

    /**
     * Set studentEmail
     *
     * @param string $studentEmail
     *
     * @return Student
     */
    public function setStudentEmail($studentEmail)
    {
        $this->studentEmail = $studentEmail;

        return $this;
    }

    /**
     * Get studentEmail
     *
     * @return string
     */
    public function getStudentEmail()
    {
        return $this->studentEmail;
    }
    
}
