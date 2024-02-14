<?php
$site_url = 'https://shapoval.agency';

// Формируем URL для запроса
$request_url = $site_url . '/wp-json/acf/v3/pages/10025';
$post_data = $site_url . '/wp-json/wp/v2/posts?per_page=3&orderby=date&order=desc&status=publish';
$services_data = $site_url . '/wp-json/wp/v2/services?per_page=3&orderby=date&order=desc&status=publish';
$cases_data = $site_url . '/wp-json/wp/v2/cases?per_page=3&orderby=date&order=desc&status=publish';

// Отправляем запрос
$response = wp_remote_get($request_url);
$response_post = wp_remote_get($post_data);
$response_service = wp_remote_get($services_data);
$response_case = wp_remote_get($cases_data);
?>


<?php if (!is_wp_error($response)) : ?>
    <?php
    // данные настроек
    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);
    ?>
<?php endif; ?>

<?php if (!is_wp_error($response_post)) : ?>
    <?php
    // данные блога
    $body_post = wp_remote_retrieve_body($response_post);
    $data_post = json_decode($body_post, true);
    ?>
<?php endif; ?>

<?php if (!is_wp_error($response_service)) : ?>
    <?php
    // данные Услуг
    $body_service = wp_remote_retrieve_body($response_service);
    $data_service = json_decode($body_service, true);

    //var_dump($data_post);
    ?>
<?php endif; ?>

<?php if (!is_wp_error($response_case)) : ?>
    <?php
    // данные Кейсов 
    $body_case = wp_remote_retrieve_body($response_case);
    $data_case = json_decode($body_case, true);

    //var_dump($data_post);
    ?>
<?php endif; ?>


<div class="saNewsRow">
    <div class="saNewsItem firstDataSa">
        <div class="pidtrimka">Підтримка вашого проекту</div>
        <div class="yaroslavSa">
            <img src="<?php echo $data['acf']['foto_yaroslava_plugin']; ?>" alt="">
        </div>
        <div class="yaroslavSaName">Шаповал Ярослав</div>
        <div class="recvData">
            <div class="iconRecv">
                <img src="<?php echo plugins_url('assets/img/Icon-tel.svg', dirname(__FILE__)); ?>" alt="">
            </div>
            <div class="resRecv">
                <span class="telResRecv"><?php echo $data['acf']['telefon_plugin']; ?></span>
                <span class="emailResRecv"><?php echo $data['acf']['email_plugin']; ?></span>
            </div>
        </div>
        <div class="recvData">
            <div class="iconRecv">
                <img src="<?php echo plugins_url('assets/img/Icon-telegram.svg', dirname(__FILE__)); ?>" alt="">
            </div>
            <div class="resRecv">
                <span class="addrResRecv"><?php echo $data['acf']['adresa_plugin']; ?></span>
            </div>
        </div>
        <div class="btnSaBlue">
            <a class="btnSaBlueLink" href="<?php echo $site_url; ?>" target="_blank">Перейти на сайт</a>
        </div>
    </div>


    <div class="saNewsItem">
        <div class="headerNewsItem">Новини сайту shapoval.agency</div>
        <?php
        foreach ($data_post as $post) :

            $title = $post['title']['rendered']; // Получаем название записи
            $link = $post['link']; // Получаем ссылку на запись
            $anons = $post['acf']['anons'];
            // Получаем URL изображения записи
            $image_id = $post['featured_media'];
            $image_url = '';

            if ($image_id) {
                $image_url_response = wp_remote_get($site_url . '/wp-json/wp/v2/media/' . $image_id);
                if (!is_wp_error($image_url_response)) {
                    $image_data = json_decode(wp_remote_retrieve_body($image_url_response), true);
                    $image_url = $image_data['source_url'];
                }
            }
        ?>
            <div class="innerNewsItem">
                <div class="saNewsItemImg"><img src="<?php echo $image_url; ?>" alt="<?php echo $title; ?>" width="100"></div>
                <div class="saNewsItemData">
                    <div class="saNewsItemTitle" title="<?php echo $title; ?>"><?php echo $title; ?></div>
                    <div class="saNewsItemAnons"><?php echo $anons; ?></div>
                    <a class="saNewsItemLink" href="<?php echo $link; ?>" target="_blank">
                        <span>Перейти до статті</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                            <path d="M10.9238 7.80953L6.54879 12.1845C6.50814 12.2252 6.45988 12.2574 6.40677 12.2794C6.35366 12.3014 6.29674 12.3127 6.23926 12.3127C6.18177 12.3127 6.12485 12.3014 6.07174 12.2794C6.01863 12.2574 5.97037 12.2252 5.92973 12.1845C5.88908 12.1439 5.85683 12.0956 5.83483 12.0425C5.81284 11.9894 5.80151 11.9325 5.80151 11.875C5.80151 11.8175 5.81284 11.7606 5.83483 11.7075C5.85683 11.6544 5.88908 11.6061 5.92973 11.5655L9.99574 7.5L5.92973 3.43453C5.84763 3.35244 5.80151 3.2411 5.80151 3.125C5.80151 3.0089 5.84763 2.89756 5.92973 2.81547C6.01182 2.73338 6.12316 2.68726 6.23926 2.68726C6.35535 2.68726 6.4667 2.73338 6.54879 2.81547L10.9238 7.19047C10.9645 7.2311 10.9967 7.27935 11.0188 7.33246C11.0408 7.38557 11.0521 7.4425 11.0521 7.5C11.0521 7.55749 11.0408 7.61442 11.0188 7.66754C10.9967 7.72065 10.9645 7.7689 10.9238 7.80953Z" fill="#2782AD" />
                        </svg>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


    <div class="saNewsItem">
        <div class="headerNewsItem">Послуги shapoval.agency</div>
        <?php
        foreach ($data_service as $post) :

            $title = $post['title']['rendered']; // Получаем название записи
            $link = $post['link']; // Получаем ссылку на запись
            $anons = $post['acf']['anons'];
            // Получаем URL изображения записи
            $image_id = $post['featured_media'];
            $image_url = '';

            if ($image_id) {
                $image_url_response = wp_remote_get($site_url . '/wp-json/wp/v2/media/' . $image_id);
                if (!is_wp_error($image_url_response)) {
                    $image_data = json_decode(wp_remote_retrieve_body($image_url_response), true);
                    $image_url = $image_data['source_url'];
                }
            }
        ?>
            <div class="innerNewsItem">
                <div class="saNewsItemImg"><img src="<?php echo $image_url; ?>" alt="<?php echo $title; ?>" width="100"></div>
                <div class="saNewsItemData">
                    <div class="saNewsItemTitle" title="<?php echo $title; ?>"><?php echo $title; ?></div>
                    <div class="saNewsItemAnons"><?php echo $anons; ?></div>
                    <a class="saNewsItemLink" href="<?php echo $link; ?>" target="_blank">
                        <span>Перейти до статті</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                            <path d="M10.9238 7.80953L6.54879 12.1845C6.50814 12.2252 6.45988 12.2574 6.40677 12.2794C6.35366 12.3014 6.29674 12.3127 6.23926 12.3127C6.18177 12.3127 6.12485 12.3014 6.07174 12.2794C6.01863 12.2574 5.97037 12.2252 5.92973 12.1845C5.88908 12.1439 5.85683 12.0956 5.83483 12.0425C5.81284 11.9894 5.80151 11.9325 5.80151 11.875C5.80151 11.8175 5.81284 11.7606 5.83483 11.7075C5.85683 11.6544 5.88908 11.6061 5.92973 11.5655L9.99574 7.5L5.92973 3.43453C5.84763 3.35244 5.80151 3.2411 5.80151 3.125C5.80151 3.0089 5.84763 2.89756 5.92973 2.81547C6.01182 2.73338 6.12316 2.68726 6.23926 2.68726C6.35535 2.68726 6.4667 2.73338 6.54879 2.81547L10.9238 7.19047C10.9645 7.2311 10.9967 7.27935 11.0188 7.33246C11.0408 7.38557 11.0521 7.4425 11.0521 7.5C11.0521 7.55749 11.0408 7.61442 11.0188 7.66754C10.9967 7.72065 10.9645 7.7689 10.9238 7.80953Z" fill="#2782AD" />
                        </svg>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="saNewsItem">
        <div class="headerNewsItem">Кейси shapoval.agency</div>
        <?php
        foreach ($data_case as $post) :

            $title = $post['title']['rendered']; // Получаем название записи
            $link = $post['link']; // Получаем ссылку на запись
            $anons = $post['acf']['anons'];
            // Получаем URL изображения записи
            $image_id = $post['featured_media'];
            $image_url = '';

            if ($image_id) {
                $image_url_response = wp_remote_get($site_url . '/wp-json/wp/v2/media/' . $image_id);
                if (!is_wp_error($image_url_response)) {
                    $image_data = json_decode(wp_remote_retrieve_body($image_url_response), true);
                    $image_url = $image_data['source_url'];
                }
            }
        ?>
            <div class="innerNewsItem">
                <div class="saNewsItemImg"><img src="<?php echo $image_url; ?>" alt="<?php echo $title; ?>" width="100"></div>
                <div class="saNewsItemData">
                    <div class="saNewsItemTitle" title="<?php echo $title; ?>"><?php echo $title; ?></div>
                    <div class="saNewsItemAnons"><?php echo $anons; ?></div>
                    <a class="saNewsItemLink" href="<?php echo $link; ?>" target="_blank">
                        <span>Перейти до статті</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                            <path d="M10.9238 7.80953L6.54879 12.1845C6.50814 12.2252 6.45988 12.2574 6.40677 12.2794C6.35366 12.3014 6.29674 12.3127 6.23926 12.3127C6.18177 12.3127 6.12485 12.3014 6.07174 12.2794C6.01863 12.2574 5.97037 12.2252 5.92973 12.1845C5.88908 12.1439 5.85683 12.0956 5.83483 12.0425C5.81284 11.9894 5.80151 11.9325 5.80151 11.875C5.80151 11.8175 5.81284 11.7606 5.83483 11.7075C5.85683 11.6544 5.88908 11.6061 5.92973 11.5655L9.99574 7.5L5.92973 3.43453C5.84763 3.35244 5.80151 3.2411 5.80151 3.125C5.80151 3.0089 5.84763 2.89756 5.92973 2.81547C6.01182 2.73338 6.12316 2.68726 6.23926 2.68726C6.35535 2.68726 6.4667 2.73338 6.54879 2.81547L10.9238 7.19047C10.9645 7.2311 10.9967 7.27935 11.0188 7.33246C11.0408 7.38557 11.0521 7.4425 11.0521 7.5C11.0521 7.55749 11.0408 7.61442 11.0188 7.66754C10.9967 7.72065 10.9645 7.7689 10.9238 7.80953Z" fill="#2782AD" />
                        </svg>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


</div>