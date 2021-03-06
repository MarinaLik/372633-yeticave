<main>
  <nav class="nav">
    <ul class="nav__list container">
        <?php foreach ($categories as $category): ?>
            <li class="nav__item">
                <a href="all-lots.html"><?=$category['name'];?></a>
            </li>
        <?php  endforeach; ?>
    </ul>
  </nav>
  <section class="lot-item container">
    <h2><?=htmlspecialchars($lot['title']);?></h2>
    <div class="lot-item__content">
      <div class="lot-item__left">
        <div class="lot-item__image">
          <img src="<?=$lot['image'];?>" width="730" height="548" alt="<?=$lot['title'];?>">
        </div>
        <p class="lot-item__category">Категория: <span><?=$lot['name'];?></span></p>
        <p class="lot-item__description"><?=$lot['description'];?></p>
      </div>
      <div class="lot-item__right">
        <div class="lot-item__state">
          <div class="lot-item__timer timer">
            <?=time_counter($lot['date_end']);?>
          </div>
          <div class="lot-item__cost-state">
            <div class="lot-item__rate">
              <span class="lot-item__amount">Текущая цена</span>
              <span class="lot-item__cost"><?=max_price($bets[0]['cost'], $lot['price_start'])?></span>
            </div>
            <div class="lot-item__min-cost">
              Мин. ставка <span><?=min_bet($bets[0]['cost'], $lot['price_start'], $lot['rate_step'])?> р</span>
            </div>
          </div>
          <form class="lot-item__form" action="https://echo.htmlacademy.ru" method="post">
            <p class="lot-item__form-item">
              <label for="cost">Ваша ставка</label>
              <input id="cost" type="number" name="cost" placeholder="<?=min_bet($bets[0]['cost'], $lot['price_start'], $lot['rate_step'])?>">
            </p>
            <button type="submit" class="button">Сделать ставку</button>
          </form>
        </div>
        <div class="history">
          <h3>История ставок (<span><?=count($bets);?></span>)</h3>
          <table class="history__list">
            <?php foreach ($bets as $bet): ?>
            <tr class="history__item">
              <td class="history__name"><?=$bet['name'];?></td>
              <td class="history__price"><?=format_price($bet['cost']);?> р</td>
              <td class="history__time"><?=time_bet($bet['date_add']);?></td>
            </tr>
            <?php  endforeach; ?>
          </table>
        </div>
      </div>
    </div>
  </section>
</main>
