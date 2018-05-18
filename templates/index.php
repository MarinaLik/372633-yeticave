<main class="container">
<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
        <?php foreach ($categories as $category): ?>
        <li class="promo__item promo__item--<?=$category['bg_view'];?>">
            <a class="promo__link" href="all-lots.html"><?=$category['name'];?></a>
        </li>
    <?php endforeach; ?>
    </ul>
</section>
<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
        <?php foreach ($lots as $lot): ?>
        <li class="lots__item lot">
            <div class="lot__image">
                <img src="<?=$lot['image'];?>" width="350" height="260" alt="Сноуборд">
            </div>
            <div class="lot__info">
                <span class="lot__category"><?=$lot['name'];?></span>
                <h3 class="lot__title"><a class="text-link" href="/lot.php?id=<?=$lot['lot_id'];?>"><?=htmlspecialchars($lot['title']);?></a></h3>
                <div class="lot__state">
                    <div class="lot__rate">
                        <span class="lot__amount"><?=price_value($lot['amount_bet']);?></span>
                        <span class="lot__cost"><?=max_price($lot['max_price'], $lot['price_start'])?> <b class="rub">р</b></span>
                    </div>
                    <div class="lot__timer timer">
                    <?=time_counter($lot['date_end']);?>
                    </div>
                </div>
            </div>
        </li>
        <?php  endforeach; ?>
    </ul>
</section>
</main>
