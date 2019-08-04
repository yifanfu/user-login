<?php


namespace App\Entity;

use App\Annotation\InternalUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @InternalUser()
 */
class Employee extends User
{

}