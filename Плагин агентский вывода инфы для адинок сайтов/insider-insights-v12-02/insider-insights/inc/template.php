<?php
$dir_bg = FC_PLUGIN_DIR . 'assets/img/bg/';
$files = scandir($dir_bg);

// Удаляем . и .. из списка файлов
$files = array_diff($files, array('.', '..'));

// Выбираем случайный файл из списка
$random_file = $files[array_rand($files)];

?>
<div class="mainLoginContent">

    <div class="innerMainLoginContent">

        <div class="logoSaBlock">
            <a href="https://shapoval.agency/" target="_blank">
                <img src="<?php echo plugins_url('assets/img/sa-logo.svg', dirname(__FILE__)); ?>" alt="">
            </a>
        </div>

        <div class="titleBlock">
            <h2 class="titleAdminPanel">
                <img src="<?php echo plugins_url('assets/img/admin-panel.png', dirname(__FILE__)); ?>" alt="">
                <span>Admin panel</span>
            </h2>

            <div class="descLogin">
                Виконайте вхід в панель адміністратора сайту <span class="nameSait">"<?php echo get_bloginfo('title', 'display'); ?>"</span> для управління контентом, налаштуванням та моніторингом ефективності вашого веб-ресурсу.
            </div>
        </div>

        <?php
        // URL вашего WordPress сайта
        $site_url = 'https://shapoval.agency';
        // Формируем URL для запроса
        $request_url = $site_url . '/wp-json/acf/v3/pages/10025';
        // Отправляем запрос
        $response = wp_remote_get($request_url);
        // Проверяем, успешно ли прошел запрос
        ?>

        <div class="sliderLoginBlock">
            <div class="avaSlider"><img src="<?php echo plugins_url('assets/img/ava.png', dirname(__FILE__)); ?>" alt=""></div>
            <?php if (!is_wp_error($response)) : ?>
                <?php
                $body = wp_remote_retrieve_body($response);
                // Преобразуем JSON в массив
                $data = json_decode($body, true);
                // Выводим данные
                $porady = $data['acf']['porady']; // Получаем массив записей 'porady'
                ?>
                <div class="swiper sliderLogin">

                    <div class="swiper-wrapper">
                        <?php foreach ($porady as $post) : ?>
                            <div class="swiper-slide">
                                <div class="poradySlideInner">
                                    <div class="poradySlideImg"><img src='<?php echo $post['zobrazhennya']; ?>' alt='' width="100"></div>
                                    <div class="poradySlideData">
                                        <div class="poradySlideTitle">shapoval.agency корисні коли:</div>
                                        <div class="poradySlideText"><?php echo $post['tekst']; ?></div>
                                        <a href="<?php echo $post['posylannya']; ?>" class="poradySlideLink" target="_blank">Звернутись зараз</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="navSliderSa">
                        <div class="navPrevSa button-prev-sa navSliderItem">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 14 15" fill="none">
                                <path d="M4.0655 7.19047L8.4405 2.81547C8.48115 2.77482 8.52941 2.74258 8.58252 2.72058C8.63562 2.69858 8.69255 2.68726 8.75003 2.68726C8.80752 2.68726 8.86444 2.69858 8.91755 2.72058C8.97066 2.74258 9.01892 2.77482 9.05956 2.81547C9.10021 2.85612 9.13246 2.90437 9.15445 2.95748C9.17645 3.01059 9.18778 3.06752 9.18778 3.125C9.18778 3.18249 9.17645 3.23941 9.15445 3.29252C9.13246 3.34563 9.10021 3.39388 9.05956 3.43453L4.99355 7.5L9.05956 11.5655C9.14166 11.6476 9.18777 11.7589 9.18777 11.875C9.18777 11.9911 9.14166 12.1024 9.05956 12.1845C8.97747 12.2666 8.86613 12.3127 8.75003 12.3127C8.63393 12.3127 8.52259 12.2666 8.4405 12.1845L4.0655 7.80953C4.02482 7.7689 3.99255 7.72065 3.97054 7.66754C3.94852 7.61443 3.93719 7.55749 3.93719 7.5C3.93719 7.44251 3.94852 7.38558 3.97054 7.33246C3.99255 7.27935 4.02482 7.2311 4.0655 7.19047Z" fill="white" />
                            </svg>
                            <span>Попередня порада</span>
                        </div>
                        <div class="navNextSa button-next-sa navSliderItem">
                            <span>Наступна порада</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 14 15" fill="none">
                                <path d="M9.9345 7.80953L5.5595 12.1845C5.51885 12.2252 5.4706 12.2574 5.41749 12.2794C5.36438 12.3014 5.30745 12.3127 5.24997 12.3127C5.19248 12.3127 5.13556 12.3014 5.08245 12.2794C5.02934 12.2574 4.98109 12.2252 4.94044 12.1845C4.89979 12.1439 4.86755 12.0956 4.84555 12.0425C4.82355 11.9894 4.81223 11.9325 4.81223 11.875C4.81223 11.8175 4.82355 11.7606 4.84555 11.7075C4.86755 11.6544 4.89979 11.6061 4.94044 11.5655L9.00645 7.5L4.94044 3.43453C4.85834 3.35244 4.81223 3.2411 4.81223 3.125C4.81223 3.0089 4.85834 2.89756 4.94044 2.81547C5.02253 2.73338 5.13387 2.68726 5.24997 2.68726C5.36607 2.68726 5.47741 2.73338 5.5595 2.81547L9.9345 7.19047C9.97518 7.2311 10.0074 7.27935 10.0295 7.33246C10.0515 7.38557 10.0628 7.4425 10.0628 7.5C10.0628 7.55749 10.0515 7.61442 10.0295 7.66754C10.0074 7.72065 9.97518 7.7689 9.9345 7.80953Z" fill="white" />
                            </svg>
                        </div>
                    </div>

                </div>
            <?php endif; ?>
        </div>


        <div class="bgLogin">
            <img src="<?php echo plugins_url('assets/img/bg/' . $random_file, dirname(__FILE__)); ?>" alt="">
        </div>














    </div>

</div>