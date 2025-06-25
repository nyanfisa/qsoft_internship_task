<?php 
    $isActive = ($currency['code'] === $selectedCurrency) ? 'is-active' : '';
?>
    <li class="<?= htmlspecialchars($isActive) ?>">
        <a href="?currency=<?= htmlspecialchars($currency['code'])?>">
            <span class="icon is-small">
                <i class="<?= htmlspecialchars($currency['icon_class']) ?>" aria-hidden="true"></i>
                <?= htmlspecialchars($currency['name']) ?> <?= htmlspecialchars($currency['symb']) ?></span>
        </a>
    </li>


