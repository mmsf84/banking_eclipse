<?php

// DIC configuration

$container = $app->getContainer();

// -----------------------------------------------------------------------------
// Service providers
// -----------------------------------------------------------------------------

// Twig
$container['view'] = function ($c) {
    $settings = $c->get('settings');
    $view = new \Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);

    // Add extensions
    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath));
    $view->addExtension(new Twig_Extension_Debug());

    return $view;
};

// Flash messages
$container['flash'] = function ($c) {
    return new \Slim\Flash\Messages;
};

// -----------------------------------------------------------------------------
// Service factories
// -----------------------------------------------------------------------------

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings');
    $logger = new \Monolog\Logger($settings['logger']['name']);
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['logger']['path'], \Monolog\Logger::DEBUG));
    return $logger;
};

// -----------------------------------------------------------------------------
// Infrastructure Repository Fake
// -----------------------------------------------------------------------------
$container['account_fake_repository'] = function ($c) {
    return new App\BankAccount\Infrastructure\repository\fake\BankAccountFakeRepository();
};

// -----------------------------------------------------------------------------
// Domain Services
// -----------------------------------------------------------------------------
$container['transfer_domain_service'] = function ($c) {    
    $domainService = new App\BankAccount\Domain\services\TransferDomainService();
    $domainService->setBankAccountRepository($c->get('account_fake_repository'));
    return $domainService;
};

// -----------------------------------------------------------------------------
// Application Services
// -----------------------------------------------------------------------------
$container['transfer_application_service'] = function ($c) {
    return new App\BankAccount\Application\BankTransferApplicationService($c->get('transfer_domain_service'));
};

// -----------------------------------------------------------------------------
// Action factories
// -----------------------------------------------------------------------------
$container['App\Action\HomeAction'] = function ($c) {
    return new App\Action\HomeAction($c->get('view'), $c->get('logger'), $c->get('transfer_application_service'));
};

