<?php

namespace BIS\CMSBundle\Entity;

use Doctrine\ORM\Mapping\Entity as ORM;
use Symfony\Component\Validator\Constraints as Assert;

class Incident {
    protected $name;
    protected $age;
    protected $phone;
    protected $gender;
    protected $caseNumber;
    protected $filedAt;
    protected $type;
    protected $occurredAt;
    protected $occuredWhere;
    protected $witnesses;
    protected $hearingAt;
    protected $status;
    protected $remarks;
}