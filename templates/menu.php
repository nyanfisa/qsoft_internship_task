<nav class="navbar has-background-white-ter" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <div class="navbar-start">
            <?php foreach ($menu as $item): ?>
                <a href = "<?= $item['path'] ?>" class = "navbar-item <?= $item['is_active'] ? 'is_active' : '' ?>">
                    <?= htmlspecialchars($item['title']) ?>
                </a>
            <?php endforeach ?>
        </div>

    </div>
    <div class="navbar-end">
        <div class="navbar-item">
            <div class="buttons">
                <?php if ($isAuthorised): ?>
                    <span style="margin-right: 1em;"><?= htmlspecialchars($_SESSION['login'] ?? 'Студент') ?>
                    </span>
                    <a class="button is-link" href="?logout=yes">Выйти</a>
                <?php else: ?>
                    <a class="button is-primary" href="/auth/">Авторизоваться</a>
                <?php endif; ?>    
            </div>
        </div>
    </div>
</nav>