<?php

namespace FabriceKabongo\SilexProvider\Log\Model;

use \Symfony\Component\Security\Core\User\UserInterface,
    \DateTime,
    \FabriceKabongo\Common\Entity\IEntity;

/**
 * Cette classe représente un log d'une action faite par un utilisateur
 *
 * @author Fabrice Kabongo <fabrice.k.kabongo@gmail.com>
 */
class UserLog implements IEntity {

    /**
     * L'action faite par l'utilisateur
     * 
     * @var string
     */
    private $action;

    /**
     *
     * @var string le type de ressource affecté par l'utilisateur
     */
    private $ressourceType;

    /**
     *
     * @var Integer l'identifiant de la ressource affecté
     */
    private $ressourceId;

    /**
     *
     * @var \DateTime la dateCreation de l'action
     */
    private $dateCreation;

    /**
     *
     * @var Integer l'identifiant du UserLog
     */
    private $id;

    /**
     * 
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    private $utilisateur;

    public function getAction() {
        return $this->action;
    }

    public function getRessourceType() {
        return $this->ressourceType;
    }

    public function getRessourceId() {
        return $this->ressourceId;
    }

    public function getDateCreation() {
        return $this->dateCreation;
    }

    public function getId() {
        return $this->id;
    }

    public function setAction($action) {
        $this->action = $action;
        return $this;
    }

    public function setRessourceType($ressourceType) {
        $this->ressourceType = $ressourceType;
        return $this;
    }

    public function setRessourceId(Integer $ressourceId) {
        $this->ressourceId = $ressourceId;
        return $this;
    }

    public function setDateCreation(DateTime $dateCreation) {
        $this->dateCreation = $dateCreation;
        return $this;
    }

    public function setId(Integer $id) {
        $this->id = $id;
        return $this;
    }

    public function getUtilisateur() {
        return $this->utilisateur;
    }

    public function setUtilisateur(UserInterface $utilisateur) {
        $this->utilisateur = $utilisateur;
        return $this;
    }

    public function deshydrater() {
        $return = array(
            'action' => $this->getAction(),
            'ressourceType' => $this->getRessourceType(),
            'ressourceId' => $this->getRessourceId(),
            'dateCreation' => $this->getDate()->format('Y-m-d H:i:s'),
            'id' => $this->getId(),
            'utilisateur' => $this->getUtilisateur()
        );

        return $return;
    }

    public function hydrater($donnee) {
        $this->setId($donnee['id'])
                ->setAction($donnee['action'])
                ->setRessourceId($donnee['ressourceId'])
                ->setRessourceType($donnee['ressourceType'])
                ->setDate(DateTime::createFromFormat('Y-m-i H:i:s', $donnee['dateCreation']))
                ->setUtilisateur($donnee['utilisateur']);
    }

    public static function getEntityName() {
        return "fabricekabongo-log-userlog";
    }

    public static function loadValidatorMetadata(\Symfony\Component\Validator\Mapping\ClassMetadata $metadata) {
        $metadata->addPropertyConstraint('action', new \Symfony\Component\Validator\Constraints\Length(array('max' => 100)))
                ->addPropertyConstraint('action', new \Symfony\Component\Validator\Constraints\Type(array('type' => 'string')))
                ->addPropertyConstraint('action', new \Symfony\Component\Validator\Constraints\Length(array('max' => 100)))
                ->addPropertyConstraint('ressourceType', new \Symfony\Component\Validator\Constraints\Type(array('type' => 'string')))
                ->addPropertyConstraint('ressourceId', new \Symfony\Component\Validator\Constraints\Type(array('type' => 'number')))
                ->addPropertyConstraint('dateCreation', new \Symfony\Component\Validator\Constraints\Type(array('type' => 'datetime')));
    }

}
