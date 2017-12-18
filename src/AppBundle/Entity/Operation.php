<?php
/**
 * Created by PhpStorm.
 * User: youness
 * Date: 2017-12-18
 * Time: 3:35 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Operation
 *
 * @ORM\Table(name="operation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OperationRepository")
 */
class Operation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id",type="integer")
     *@ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var double
     *
     * @ORM\Column(name="solde", type="decimal")
     */
    private $montant;

    /**
     * @var boolean
     *
     * @ORM\Column(name="type",type="boolean")
     */
    private $type;

    /**
     * @var Compte
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Compte", inversedBy="operations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $compte;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return float
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * @param float $montant
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    /**
     * @return bool
     */
    public function isType()
    {
        return $this->type;
    }

    /**
     * @param bool $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return Compte
     */
    public function getCompte()
    {
        return $this->compte;
    }

    /**
     * @param Compte $compte
     */
    public function setCompte(Compte $compte)
    {
        $this->compte = $compte;
    }



}