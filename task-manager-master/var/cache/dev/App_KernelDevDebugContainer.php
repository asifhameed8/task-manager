<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container6ga7pxl\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container6ga7pxl/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/Container6ga7pxl.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\Container6ga7pxl\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \Container6ga7pxl\App_KernelDevDebugContainer([
    'container.build_hash' => '6ga7pxl',
    'container.build_id' => '284415eb',
    'container.build_time' => 1714851191,
    'container.runtime_mode' => \in_array(\PHP_SAPI, ['cli', 'phpdbg', 'embed'], true) ? 'web=0' : 'web=1',
], __DIR__.\DIRECTORY_SEPARATOR.'Container6ga7pxl');