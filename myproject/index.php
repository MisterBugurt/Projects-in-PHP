<?php
require __DIR__ . '/vendor/autoload.php';
try {
    $route = $_GET['route'] ?? '';
    $routes = require __DIR__ . '/src/routes.php';

    $isRouteFound = false;
    foreach ($routes as $pattern => $controllerAndAction) {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $isRouteFound = true;
            break;
        }
    }

    if (!$isRouteFound) {
        throw new \MyProject\Exception\NotFoundException();
    }

    unset($matches[0]);

    $controllerName = $controllerAndAction[0];
    $actionName = $controllerAndAction[1];

    $controller = new $controllerName;
    $controller->$actionName(...$matches);
} catch (\MyProject\Exception\DbException $exception) {
    $view = new \MyProject\View\View(__DIR__ . '/templates/errors');
    $view->renderHtml('500.php', ['error' => $exception->getMessage()], 500);
} catch (\MyProject\Exception\NotFoundException $exception) {
    $view = new \MyProject\View\View(__DIR__ . '/templates/errors');
    $view->renderHtml('404.php', ['error' => $exception->getMessage()], 404);
} catch (\MyProject\Exception\UnauthorizedException $exception) {
    $view = new \MyProject\View\View(__DIR__ . '/templates/errors');
    $view->renderHtml('401.php', ['error' => $exception->getMessage()], 401);
} catch (\MyProject\Exception\ForbiddenException $exception) {
    $view = new \MyProject\View\View(__DIR__ . '/templates/errors');
    $view->renderHtml('403.php', ['error' => $exception->getMessage(), 'user' => \MyProject\Models\Users\UsersAuthService::getUserByToken()], 403);
}




