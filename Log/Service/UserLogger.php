<?php

namespace FabriceKabongo\SilexProvider\Log\Service;

use Psr\Log\LoggerInterface,
    Symfony\Component\Intl\Exception\NotImplementedException,
    FabriceKabongo\Common\Repository\IRepository,
    FabriceKabongo\Common\Log\Model\UserLog;

/**
 * Cette classe permet de faire le suivie de toute les actions faites par un utilisateur
 *
 * @author Fabrice Kabongo <fabrice.k.kabongo@gmail.com>
 */
class UserLogger implements LoggerInterface {

    private $manager;
    private $app;

    function __construct(IRepository $manager, $app) {
        $this->manager = $manager;
        $this->app = $app;
    }

    public function alert($message, array $context = array()) {
        throw new NotImplementedException();
    }

    public function critical($message, array $context = array()) {
        throw new NotImplementedException();
    }

    public function debug($message, array $context = array()) {
        throw new NotImplementedException();
    }

    public function emergency($message, array $context = array()) {
        throw new NotImplementedException();
    }

    public function error($message, array $context = array()) {
        throw new NotImplementedException();
    }

    /**
     * Permet d'enregistré les action faites par l'utilisateur
     * 
     * @todo enregistré les log dans la base de donnée
     * @param type $message l'action qui a été faite
     * @param array $context les données contextuelle au log 
     * <code>
     *  $context = array(
     *      'ressource_type' => "type de la ressource",
     *      'ressource_id' => 1
     *  )
     * </code>
     */
    public function info($message, array $context = array()) {
        $userLog = new UserLog();
        $userLog->setAction($message)
                ->setDateCreation(new DateTime('now'))
                ->setRessourceId($context['ressourceId'])
                ->setRessourceType($context['ressourceType'])
                ->setUtilisateur($this->app['user']);
        $this->manager->save($userLog);
    }

    public function log($level, $message, array $context = array()) {
        throw new NotImplementedException();
    }

    public function notice($message, array $context = array()) {
        throw new NotImplementedException();
    }

    public function warning($message, array $context = array()) {
        throw new NotImplementedException();
    }

}
