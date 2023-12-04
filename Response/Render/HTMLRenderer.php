<?php

namespace Response\Render;

use Response\HTTPRenderer;

class HTMLRenderer implements HTTPRenderer
{
    private string $viewFile;
    private array $data;

    public function __construct(string $viewFile, array $data = []) {
        $this->viewFile = $viewFile;
        $this->data = $data;
    }

    public function getFields(): array {
        return [
            'Content-Type' => 'text/html; charset=UTF-8',
        ];
    }

    public function getContent(): string {
        $viewPath = $this->getViewPath($this->viewFile);

        if (!file_exists($viewPath)) {
            throw new \Exception("View file {$viewPath} does not exist.");
        }

        // ob_startはすべての出力をバッファに取り込む
        // このバッファはob_get_cleanによって取得することができ、バッファの内容を返し、バッファをクリアする
        ob_start();
        // extract関数は、キーを変数として現在のシンボルテーブルにインポートする
        extract($this->data);
        require $viewPath;
        return $this->getHeader() . ob_get_clean() . $this->getFooter();
    }

    private function getHeader(): string{
        ob_start();
        require $this->getViewPath('layout/header');
        return ob_get_clean();
    }

    private function getFooter(): string{
        ob_start();
        require $this->getViewPath('layout/footer');
        return ob_get_clean();
    }

    private function getViewPath(string $path): string{
        return sprintf("%s/%s/Views/%s.php",__DIR__, '../..',$path);
    }
}