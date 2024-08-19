<?php

namespace Dxnz\Hindiafest\Core;

class View
{
    public static function render(string $view, array $model = [])
    {
        extract($model);

        // Include main layout and pass the view
        include __DIR__ . '/../View/layouts/main.php';
    }
}
