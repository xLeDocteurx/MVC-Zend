<?php 

namespace Movies;

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
                Model\MoviesTable::class => function($container) {
                    $tableGateway = $container->get(Model\MoviesTableGateway::class);
                    return new Model\MoviesTable($tableGateway);
                },
                Model\MoviesTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Movies());
                    return new TableGateway('movies', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\MoviesController::class => function($container) {
                    return new Controller\MoviesController(
                        $container->get(Model\MoviesTable::class)
                    );
                },
            ],
        ];
    }
}

?>