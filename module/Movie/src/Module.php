<?php 

namespace Movie;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\MovieTable::class => function($container) {
                    $tableGateway = $container->get(Model\MovieTableGateway::class);
                    return new Model\MovieTable($tableGateway);
                },
                Model\MovieTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Movie());
                    return new TableGateway('movie', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\MovieController::class => function($container) {
                    return new Controller\MovieController(
                        $container->get(Model\MovieTable::class)
                    );
                },
            ],
        ];
    }
}

?>