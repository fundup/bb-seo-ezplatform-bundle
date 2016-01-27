# BB SEO Extension eZ Platform
This bundle is still under developpement !!

## About this Extension ?
![ScreenShot](https://raw.github.com/fundup/bb-seo-ezplatform-bundle/master/screenshot.png)

This extension allow to manage meta description and title ...

## Installation

### Step 1: Download BruyereFreelanceSeoExtensionBundle using composer

``` bash
$ composer require bruyerefreelance/bb-seo-ezplatform-bundle
```

Composer will install the bundle to your project's `vendor/BruyereFreelance` directory.

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new BruyereFreelance\SeoExtensionBundle\BruyereFreelanceSeoExtensionBundle(),
    );
}
```

### Step 3: Add your configuration

Add configuration : content type enabled for SEO
``` yaml
# app/config/config.yml
bruyere_freelance_seo_extension:
    content_type_identifier: ['article', 'page_simple'] #add your own ...
    
#add config for doctrine ORM
doctrine:
    dbal:
        connections:
            default:
                driver: %database_driver%
                host: %database_host%
                port: %database_port%
                user: %database_user%
                password: %database_password%
                dbname: %database_name%
                charset: UTF8
    orm:
        auto_generate_proxy_classes: "%kernel.debug%"
        naming_strategy: doctrine.orm.naming_strategy.underscore
        auto_mapping: true
```

### Step 4: Update your schema

``` bash
$ php app/console doctrine:schema:update --force
```

You should be able to use BB SEO Extension
