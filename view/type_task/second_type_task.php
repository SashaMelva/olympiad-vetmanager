<h2 class="header-task">Задание тип<span class="task-number" hidden="hidden">2</span></h2>
<div class="container-task">
    <p class="section-title">Сведения об организации</p>
    <p>Ветеринарная клиника «Котопес». Находится в городе Краснодар по адресу ул. Калинина 157.
        Занимается лечением животных с применением современных медикаментозных препаратов и использованием современного
        оборудования для диагностики и лечения.
        Клиника работает в CRM системе Ветменеджер.

        В клинике «Котопес» недавно была запущена рекламная кампания.
        Чтобы отследить ее эффективность, клиника использует купон «Я профессионал», который даёт скидку 10% на все
        товары и услуги.
    </p>
    <p class="section-title">Ситуация</p>
    <p>В клинику «Котопес» пришел на первичный прием
        <span class="changeable-text"><?= $this->arguments['fullNameClient'] ?></span>
        с купоном «Я профессионал»
        <?php if ($_SESSION['AnimalGender'] === "female") : ?>
            <?= "своей любимой собакой" ?>
        <?php endif ?>
        <?php if ($_SESSION['AnimalGender'] === "male") : ?>
            <?= "своим любимым псом" ?>
        <?php endif ?>
        по кличке
        <span class="changeable-text"><?= $this->arguments['animalName'] ?></span>
        , породы <span class="changeable-text"><?= $this->arguments['breed'] ?></span>,
        <span class="changeable-text"><?= $this->arguments['animalColor'] ?></span>
        цвета, в возрасте
        <span class="changeable-text"><?= $this->arguments['animalAge'] ?></span>.
        Обращение в клинику было с жалобами на то, что у собаки повышена температура и она почти ничего не ест.
        Врач клиники провел осмотр и обнаружил, что повышение температуры и отсутствие аппетита было связано с гнойным
        воспалительным процессом - абсцесс.
        Так как этот диагноз в практике клиники не редок, то у клиники уже заготовлен текстовый шаблон. Врач уверен в
        диагнозе, поэтому назначил ему соответствующий тип.
        Врач сделал вскрытие абсцесса, провел санацию раны, и
        <span class="changeable-text"><?= $this->arguments['animalName'] ?></span>
        сделали 2 укола: обезболивающий жаропонижающий и антибиотик.
        Стоимость первичного приема 500 руб. вскрытие абсцесса 600 руб., санация раны 250 руб., и уколы 800 руб.
        Укол обезболивающий жаропонижающий стоимостью 300 руб. и укол с антибиотиком 500 руб.
        Клиент предоставил купон и внёс оплату наличными под расчёт. Клиенту назначили повторный визит через неделю на
        15:00.
    </p>
    <p class="section-title">Ваша цель</p>
    <p>Вы врач в клинике “Котопес”, проведите эту ситуацию в программе “Ветменеджер” по адресу: адрес
        <a href="https://deviproff.vetmanager2.ru/login.php" target="_blank">deviproff.vetmanager.ru</a>
        , используя логин:
        <span class="changeable-text"><?= $this->arguments['login'] ?></span>
        и пароль
        <span class="changeable-text"><?= $this->arguments['password'] ?></span>
    </p>
    <p>Время на выполнение задания 25 минут.</p>
</div>