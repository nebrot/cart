<?php
declare(strict_types=1);
namespace Extcode\Cart\Configuration\Backend\Provider;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Reference;

return function (ContainerConfigurator $configurator) {
    $services = $configurator->services();

    $services->set('extcode.cart.provider.orders_per_day')
        ->class(\Extcode\Cart\Widgets\Provider\OrdersPerDayProvider::class)
        ->arg('$queryBuilder', new Reference('querybuilder.tx_cart_domain_model_order_item'))
        ->arg('$languageService', new Reference('TYPO3\CMS\Core\Localization\LanguageService'))
        ->arg('$options', [
            'filter' => [
                'payment' => [
                    'status' => 'paid'
                ],
                'shipping' => [
                    'status' => 'open'
                ],
            ]
        ]);
};
