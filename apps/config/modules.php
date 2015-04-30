<?php
/**
 * Register application modules
 */

$application->registerModules(array(
    'frontend' => array(
        'className' => 'Area\Frontend\Module',
        'path' => '../apps/area/frontend/Module.php'
    )
/*,
    'dashboard' => array(
        'className' => 'Modules\Dashboard\Module',
        'path' => __DIR__ . '/../modules/dashboard/Module.php'
    )
*/
));
