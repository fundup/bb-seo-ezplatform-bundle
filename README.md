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
        new BruyereFreelance\BBSeoExtensionBundle\BruyereFreelanceSeoExtensionBundle(),
    );
}
```

### Step 3: Add your configuration

Add configuration : content type enabled for SEO
``` yaml
# app/config/security.yml
bruyere_freelance_seo_extension:
    content_type_identifier: ['article', 'page_simple']
