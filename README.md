# Symfony Sonata Formatter demo issue
## This repo was created to explain bug report in Sonata Formatter
https://github.com/sonata-project/SonataFormatterBundle/issues/669
## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/)
2. Run `docker-compose build --pull --no-cache` to build fresh images
3. Run `docker-compose up` (the logs will be displayed in the current shell)
4. Run `symfony server:start`
5. Run `php bin/console doctrine:database:create`
6. Run `php bin/console doctrine:schema:update --force`
7. Run `bin/console ckeditor:install`
8. Run `in/console assets:install`
9. Run `docker-compose down --remove-orphans` to stop the Docker containers.

## Reproduce bug

* Navigate to https://127.0.0.1:8000/admin/app/article/create
* Click on image icon in FCK editor
* Click on Browse Server window with error opens "Sonata\FormatterBundle\Controller\CkeditorAdminController" has no container set, did you forget to define it as a service subscriber?"
* Navigate to upload tab select file and click upload - error message is displayed inline "Sonata\FormatterBundle\Controller\CkeditorAdminController" has no container set, did you forget to define it as a service subscriber?"


## Notes

1. check in symfony/framework-bundle/Controller/ControllerResolver.php

        `if ($controller instanceof ContainerAwareInterface) {
            $controller->setContainer($this->container);
        }
        if ($controller instanceof AbstractController) {
            if (null === $previousContainer = $controller->setContainer($this->container)) {
                throw new \LogicException(sprintf('"%s" has no container set, did you forget to define it as a service subscriber?', $class));
            } else {
                $controller->setContainer($previousContainer);
            }
        }`

    fails because the container is not set in Sonata\FormatterBundle\Controller\CkeditorAdminController 
2. CkeditorAdminController does not implement ContainerAwareInterface 
3. Container is not injected in any other way during the initialization
4. I didn't find in the sonata formatter docs information describing a way or a need to inject container manually
