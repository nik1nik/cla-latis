<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StudentTimeslot
 *
 * @ORM\Table(name="student_timeslot")
 * @ORM\Entity
 */
class StudentTimeslot
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
     * @var integer
     *
     * @ORM\Column(name="student_id", type="integer", nullable=false)
     */
    private $studentId;

    /**
     * @var integer
     *
     * @ORM\Column(name="timeslot_id", type="integer", nullable=false)
     */
    private $timeslotId;



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
     * Set studentId
     *
     * @param integer $studentId
     *
     * @return StudentTimeslot
     */
    public function setStudentId($studentId)
    {
        $this->studentId = $studentId;

        return $this;
    }

    /**
     * Get studentId
     *
     * @return integer
     */
    public function getStudentId()
    {
        return $this->studentId;
    }

    /**
     * Set timeslotId
     *
     * @param integer $timeslotId
     *
     * @return StudentTimeslot
     */
    public function setTimeslotId($timeslotId)
    {
        $this->timeslotId = $timeslotId;

        return $this;
    }

    /**
     * Get timeslotId
     *
     * @return integer
     */
    public function getTimeslotId()
    {
        return $this->timeslotId;
    }
}
