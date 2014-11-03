<?php

namespace FabriceKabongo\SilexProvider\Log;

use FabriceKabongo\Common\Log\Model\UserLoggerManager,
    FabriceKabongo\Common\Log\Service\UserLogger,
    Silex\ControllerProviderInterface,
    Silex\ServiceProviderInterfaceface;

/**
 * Cette classe est le ServiceProviderInterface et le ControllerProviderInterface du module Log
 *
 * @author Fabrice Kabongo <fabrice.k.kabongo@gmail.com>
 */
class LogServiceProvider implements ServiceProviderInterfaceface, ControllerProviderInterface {

    public function register(Application $app) {
        $app['fabricekabongo.common.log.manager'] = $app->share(function ($app) {
            return new UserLoggerManager(
                    $app['db'], $app['eventdispatcher'], $app['fabricekabongo.common.log.options']['tablename']);
        });
        $app['fabricekabongo.common.log.userlogger'] = $app->share(function($app) {

            return new UserLogger($app['fabricekabongo.common.log.manager'], $app);
        });
    }

    /**
     * Bootstraps the application.
     *
     * @param \Silex\Application $app The application
     */
    public function boot(Application $app) {
        
    }

    public function connect(Application $app) {
        
    }

}
