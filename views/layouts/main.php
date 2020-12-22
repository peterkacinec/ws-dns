<?php use app\core\Application; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>WS DNS list</title>
    <link href="./css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
</head>
<body>
    <div id="app">
        <nav>
            <ul>
                <li>
                    <a href="/">Home</a>
                </li>
                <li>
                    <a href="/create">Create</a>
                </li>
            </ul>
        </nav>

        <div>
            <?php if (Application::$app->session->getFlash('success')): ?>
                <div class="alert alert-success">
                    <span><?php echo Application::$app->session->getFlash('success') ?></span>
                </div>
            <?php elseif(Application::$app->session->getFlash('error')): ?>
                <div class="alert alert-error">
                    <span><?php echo Application::$app->session->getFlash('error') ?></span>
                </div>
            <?php endif; ?>
            {{content}}
        </div>
    </div>
</body>
</html>