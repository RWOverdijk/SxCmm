SxCmm
=====

Content Management Module for zend framework 2.

## Installation:
1. Copy data/config/database.local.php.dist to config/autoload/database.local.php and change the db credentials to your db credentials 
2. Run data/database/schema.sql or use the doctrine tool and run ./vendor/bin/doctrine-module orm:schema-tool:create --force 

## Usage
Add records for content, then call the viewhelper with the name of the area, and the page id.

```php
<?php echo $this->contentarea('areaName', $pageId); ?>
