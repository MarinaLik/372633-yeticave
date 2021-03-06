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
  <form class="form form--add-lot container <?= (isset($errors) && count($errors)>0 ) ? 'form--invalid' : ''; ?>" action="add.php" method="post" enctype="multipart/form-data">
    <h2>Добавление лота</h2>
    <div class="form__container-two">
      <div class="form__item <?= isset($errors['lot-name'])? 'form__item--invalid' : ''; ?>">
        <label for="lot-name">Наименование</label>
        <input id="lot-name" type="text" name="lot-name" value="<?= $lot['lot-name'] ?? ''; ?>" placeholder="Введите наименование лота" >
        <span class="form__error"><?= $errors['lot-name'] ?? ''; ?></span>
      </div>
      <div class="form__item <?= isset($errors['category']) ? "form__item--invalid" : "";?>">
        <label for="category">Категория</label>
        <select id="category" name="category">
          <option>Выберите категорию</option>
          <?php foreach ($categories as $category): ?>
          <option value="<?=$category['category_id'] ?>" <?= ($lot['category'] == $category['category_id']) ? 'selected' : '';?> ><?=$category['name'];?></option>
          <?php  endforeach; ?>
        </select>
        <span class="form__error"><?= $errors['category'] ?? ''; ?></span>
      </div>
    </div>
    <div class="form__item form__item--wide <?= isset($errors['message']) ? "form__item--invalid" : "";?>">
      <label for="message">Описание</label>
      <textarea id="message" name="message" placeholder="Напишите описание лота"><?= $lot['message'] ?? ''; ?></textarea>
      <span class="form__error"><?= $errors['message'] ?? "";?></span>
    </div>
    <div class="form__item form__item--file <?= isset($errors['lot_img']) ? "form__item--invalid" : "";?>">
      <label>Изображение</label>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="img/avatar.jpg" width="113" height="113" alt="Изображение лота">
        </div>
      </div>
      <div class="form__input-file">
        <input class="visually-hidden" type="file" name="lot_img" id="photo2" value="">
        <label for="photo2">
        <span>+ Добавить</span>
        </label>
      </div>
      <span class="form__error"><?= $errors['lot_img'] ?? "";?></span>
    </div>
    <div class="form__container-three">
      <div class="form__item form__item--small <?= isset($errors['lot-rate']) ? "form__item--invalid" : "";?>">
        <label for="lot-rate">Начальная цена</label>
        <input id="lot-rate" type="number" name="lot-rate" placeholder="0" value="<?= $lot['lot-rate'] ?? ''; ?>">
        <span class="form__error"><?= $errors['lot-rate'] ?? "";?></span>
      </div>
      <div class="form__item form__item--small <?= isset($errors['lot-step']) ? "form__item--invalid" : "";?>">
        <label for="lot-step">Шаг ставки</label>
        <input id="lot-step" type="number" name="lot-step" placeholder="0" value="<?= $lot['lot-step'] ?? ''; ?>">
        <span class="form__error"><?= $errors['lot-step'] ?? "";?></span>
      </div>
      <div class="form__item <?= isset($errors['lot-date']) ? "form__item--invalid" : "";?>">
        <label for="lot-date">Дата окончания торгов</label>
        <input class="form__input-date" id="lot-date" type="date" name="lot-date" value="<?= $lot['lot-date'] ?? ''; ?>">
        <span class="form__error"><?= $errors['lot-date'] ?? "";?></span>
      </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
  </form>
</main>
