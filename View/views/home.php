<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?> - <?= htmlspecialchars($appName) ?></title>
</head>
<body>
    <?php $this->include('partials.header', ['subtitle' => 'Добро пожаловать!']); ?>

        <main>
            <p>
                <?= htmlspecialchars($content) ?>
            </p>
            <p>
                <?= htmlspecialchars($index) ?>
            </p>
        </main>

        <?php $this->include('partials.footer'); ?>
</body>
</html>