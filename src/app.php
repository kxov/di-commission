<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\CommissionCalculation\Infrastructure\Parser\Parser;
use App\CommissionCalculation\Infrastructure\Client\ClientFactory;
use App\CommissionCalculation\Infrastructure\Client\Client;
use App\CommissionCalculation\Infrastructure\Reader\{FileIterator, Reader, ReaderFactory};

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpClient\Psr18Client;


//$container = new ContainerBuilder();
//$container
//    ->register('client', Client::class)
//    ->setFactory([ClientFactory::class, 'create']);
//$container
//    ->register('parser', Parser::class)
//    ->addArgument(new Reference('client'));
//$container
//    ->register('iterator', FileIterator::class)
//    ->addArgument('/app/input/input.txt');
//$container
//    ->register('reader', Reader::class)
//    ->setFactory([ReaderFactory::class, 'make'])
//    ->addArgument(new Reference('parser'))
//    ->addArgument(new Reference('iterator'));

$container = new ContainerBuilder();
$loader = new YamlFileLoader($container, new FileLocator(__DIR__));
$loader->load('services.yaml');

try {
    $reader = $container->get('reader');
    $reader->read();

} catch (Exception $exception) {
    var_dump($exception->getMessage());
}