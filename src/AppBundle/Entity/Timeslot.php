<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Timeslot
 *
 * @ORM\Table(name="timeslot")
 * @ORM\Entity
 */
class Timeslot
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
     * @ORM\Column(name="test_id", type="integer", nullable=false)
     */
    private $testId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_time", type="datetime", nullable=false)
     */
    private $startTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_time", type="datetime", nullable=false)
     */
    private $endTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="slots_max", type="integer", nullable=false)
     */
    private $slotsMax = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="slots_taken", type="integer", nullable=false)
     */
    private $slotsTaken = '0';



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
     * Set testId
     *
     * @param integer $testId
     *
     * @return Timeslot
     */
    public function setTestId($testId)
    {
        $this->testId = $testId;

        return $this;
    }

    /**
     * Get testId
     *
     * @return integer
     */
    public function getTestId()
    {
        return $this->testId;
    }

    /**
     * Set startTime
     *
     * @param \DateTime $startTime
     *
     * @return Timeslot
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     *
     * @return Timeslot
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set slotsMax
     *
     * @param integer $slotsMax
     *
     * @return Timeslot
     */
    public function setSlotsMax($slotsMax)
    {
        $this->slotsMax = $slotsMax;

        return $this;
    }

    /**
     * Get slotsMax
     *
     * @return integer
     */
    public function getSlotsMax()
    {
        return $this->slotsMax;
    }

    /**
     * Set slotsTaken
     *
     * @param integer $slotsTaken
     *
     * @return Timeslot
     */
    public function setSlotsTaken($slotsTaken)
    {
        $this->slotsTaken = $slotsTaken;

        return $this;
    }

    /**
     * Get slotsTaken
     *
     * @return integer
     */
    public function getSlotsTaken()
    {
        return $this->slotsTaken;
    }
}
