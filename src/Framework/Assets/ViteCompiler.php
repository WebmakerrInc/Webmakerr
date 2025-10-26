<?php

namespace Webmakerr\Framework\Assets;

class ViteCompiler
{
    /**
     * @var array<int, array{asset: string, options: array<string, mixed>}>
     */
    private array $assets = [];

    private ?string $editorStyle = null;

    /**
     * @var array<string, array{mode: string, media: string}>
     */
    private array $styleStrategies = [];

    private bool $styleFilterAdded = false;

    private ?array $manifest = null;

    private bool $manifestLoaded = false;

    public function registerAsset(string $asset, array $options = []): self
    {
        $this->assets[] = [
            'asset' => $asset,
            'options' => $options,
        ];

        return $this;
    }

    public function editorStyleFile(string $asset): self
    {
        $this->editorStyle = $asset;

        return $this;
    }

    public function enqueue(): void
    {
        foreach ($this->assets as $asset) {
            $this->enqueueAsset($asset['asset'], $asset['options']);
        }
    }

    public function enqueueEditorAssets(): void
    {
        if (!$this->editorStyle) {
            return;
        }

        $asset = $this->resolveAsset($this->editorStyle, false);

        if (!$asset) {
            return;
        }

        $handle = $this->buildHandle($this->editorStyle, 'editor-style');

        wp_enqueue_style($handle, $asset['uri'], [], $asset['version']);
    }

    private function enqueueAsset(string $asset, array $options = []): void
    {
        $isScript = $this->isScript($asset);
        $handle = $this->buildHandle($asset);
        $resolved = $this->resolveAsset($asset);

        if (!$resolved) {
            return;
        }

        if ($isScript) {
            $deps = $options['deps'] ?? [];
            $inFooter = $options['in_footer'] ?? true;

            wp_enqueue_script($handle, $resolved['uri'], $deps, $resolved['version'], $inFooter);

            $strategy = $options['strategy'] ?? 'defer';

            if (in_array($strategy, ['async', 'defer'], true)) {
                wp_script_add_data($handle, 'strategy', $strategy);
            }

            if (!empty($resolved['css']) && ($options['include_css'] ?? true)) {
                $this->enqueueAssociatedCss($handle, $resolved['css'], $options['css_load'] ?? 'async');
            }

            return;
        }

        $deps = $options['deps'] ?? [];
        $media = $options['media'] ?? 'all';

        wp_enqueue_style($handle, $resolved['uri'], $deps, $resolved['version'], $media);

        $loadStrategy = $options['load'] ?? 'async';

        if ('async' === $loadStrategy) {
            $this->markStyleForAsyncLoading($handle, $media);
        }
    }

    /**
     * @param array<int, string> $cssFiles
     */
    private function enqueueAssociatedCss(string $handle, array $cssFiles, string $loadStrategy): void
    {
        foreach ($cssFiles as $index => $file) {
            $relativePath = $this->normalizeBuildPath($file);
            $styleHandle = $handle.'-css-'.$index;
            $path = get_theme_file_path($relativePath);

            if (!file_exists($path)) {
                continue;
            }

            wp_enqueue_style(
                $styleHandle,
                get_theme_file_uri($relativePath),
                [],
                $this->assetVersion($path)
            );

            if ('async' === $loadStrategy) {
                $this->markStyleForAsyncLoading($styleHandle, 'all');
            }
        }
    }

    private function markStyleForAsyncLoading(string $handle, string $media): void
    {
        $this->styleStrategies[$handle] = [
            'mode' => 'async',
            'media' => $media,
        ];

        if (!$this->styleFilterAdded) {
            add_filter('style_loader_tag', [$this, 'styleLoaderTag'], 10, 4);
            $this->styleFilterAdded = true;
        }
    }

    public function styleLoaderTag(string $html, string $handle, string $href, string $media): string
    {
        if (!isset($this->styleStrategies[$handle])) {
            return $html;
        }

        $strategy = $this->styleStrategies[$handle];

        if ('async' !== $strategy['mode']) {
            return $html;
        }

        $mediaAttr = $media && 'all' !== $media ? sprintf(' media="%s"', esc_attr($media)) : '';
        $domId = esc_attr($this->styleDomId($handle));
        $hrefAttr = esc_url($href);

        $preload = sprintf(
            '<link rel="preload" as="style" href="%s" id="%s"%s onload="this.onload=null;this.rel=\'stylesheet\'">',
            $hrefAttr,
            $domId,
            $mediaAttr
        );

        $noscript = sprintf(
            '<noscript><link rel="stylesheet" href="%s" id="%s-noscript"%s></noscript>',
            $hrefAttr,
            $domId,
            $mediaAttr
        );

        return $preload."\n".$noscript;
    }

    private function styleDomId(string $handle): string
    {
        return $handle.'-css';
    }

    /**
     * @return array{uri: string, path: string|null, version: string|null, css: array<int, string>}|null
     */
    private function resolveAsset(string $asset): ?array
    {
        if (str_contains($asset, '://')) {
            return [
                'uri' => $asset,
                'path' => null,
                'version' => null,
                'css' => [],
            ];
        }

        $manifestPath = $this->manifestEntry($asset);

        if ($manifestPath) {
            $path = get_theme_file_path($manifestPath['file']);

            return [
                'uri' => get_theme_file_uri($manifestPath['file']),
                'path' => $path,
                'version' => $this->assetVersion($path),
                'css' => $manifestPath['css'],
            ];
        }

        $path = get_theme_file_path($asset);

        if (!file_exists($path)) {
            return null;
        }

        return [
            'uri' => get_theme_file_uri($asset),
            'path' => $path,
            'version' => $this->assetVersion($path),
            'css' => [],
        ];
    }

    /**
     * @return array{file: string, css: array<int, string>}|null
     */
    private function manifestEntry(string $asset): ?array
    {
        $manifest = $this->manifest();

        if (isset($manifest[$asset]['file'])) {
            return [
                'file' => $this->normalizeBuildPath($manifest[$asset]['file']),
                'css' => $manifest[$asset]['css'] ?? [],
            ];
        }

        if (isset($manifest[$asset]) && is_string($manifest[$asset])) {
            return [
                'file' => $this->normalizeBuildPath($manifest[$asset]),
                'css' => [],
            ];
        }

        return null;
    }

    private function normalizeBuildPath(string $file): string
    {
        if (str_starts_with($file, 'build/')) {
            return $file;
        }

        return 'build/'.ltrim($file, '/');
    }

    /**
     * @return array<string, mixed>
     */
    private function manifest(): array
    {
        if ($this->manifestLoaded) {
            return $this->manifest ?? [];
        }

        $this->manifestLoaded = true;

        $path = get_theme_file_path('build/manifest.json');

        if (!file_exists($path)) {
            $path = get_theme_file_path('build/.vite/manifest.json');
        }

        if (!file_exists($path)) {
            $this->manifest = [];

            return $this->manifest;
        }

        $contents = file_get_contents($path);

        if (false === $contents) {
            $this->manifest = [];

            return $this->manifest;
        }

        $decoded = json_decode($contents, true);

        if (!is_array($decoded)) {
            $this->manifest = [];

            return $this->manifest;
        }

        $this->manifest = $decoded;

        return $this->manifest;
    }

    private function buildHandle(string $asset, string $suffix = ''): string
    {
        $base = 'webmakerr-' . sanitize_title($asset);

        if ($suffix !== '') {
            $base .= '-' . $suffix;
        }

        return $base;
    }

    private function assetVersion(string $path): ?string
    {
        if (file_exists($path)) {
            return (string) filemtime($path);
        }

        return null;
    }

    private function isScript(string $asset): bool
    {
        return str_ends_with($asset, '.js') || str_ends_with($asset, '.mjs');
    }
}
