<?php

if (is_file(__DIR__.'/vendor/autoload_packages.php')) {
    require_once __DIR__.'/vendor/autoload_packages.php';
}

foreach ([
    'Framework\\Theme',
    'Framework\\Assets\\ViteCompiler',
    'Framework\\Features\\MenuOptions',
] as $target) {
    $webmakerr_class = 'Webmakerr\\'.$target;
    $tailpress_class = 'Tail'.'Press\\'.$target;

    if (!class_exists($webmakerr_class) && class_exists($tailpress_class)) {
        class_alias($tailpress_class, $webmakerr_class);
    }
}

function webmakerr(): Webmakerr\Framework\Theme
{
    return Webmakerr\Framework\Theme::instance()
        ->assets(fn($manager) => $manager
            ->withCompiler(new Webmakerr\Framework\Assets\ViteCompiler, fn($compiler) => $compiler
                ->registerAsset('resources/css/app.css')
                ->registerAsset('resources/js/app.js')
                ->editorStyleFile('resources/css/editor-style.css')
            )
            ->enqueueAssets()
        )
        ->features(fn($manager) => $manager->add(Webmakerr\Framework\Features\MenuOptions::class))
        ->menus(fn($manager) => $manager->add('primary', __( 'Primary Menu', 'webmakerr')))
        ->themeSupport(fn($manager) => $manager->add([
            'title-tag',
            'custom-logo',
            'post-thumbnails',
            'align-wide',
            'wp-block-styles',
            'responsive-embeds',
            'html5' => [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            ]
        ]));
}

webmakerr();
