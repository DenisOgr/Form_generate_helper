<?php
$config = array(

    /*Регистрация*/
    'user' => array(
        //Текстовое поле input[type=text]
        array(
            'field' => 'login_user',//имя поля
            'label' => 'Логин',//название поля(label)
            'type' => 'input[type=text]',//тип поля
            'data'=>array('class'=>'login, my-class','title'=>'Укажите логин'),//атрибуты поля
            'rules' => 'required|xss_clean'//правила для валидации поля
        ),
        array(
            'field' => 'url_user',
            'label' => 'Сайт',
            'type' => 'input[type=text]',
            'data'=>array('class'=>'url_user, my-class','title'=>'Укажите Сайт','onclick'=>'alert(\'Пример обработчика на клиенте\')'),
            'rules' => 'required|xss_clean|valid_url'
        ),
        //Текстовое поле для пароля  input[type=password]
        array(
            'field' => 'pass_user',
            'label' => 'Пароль',
            'type' => 'input[type=password]',
            'data'=>array('class'=>'pass_user, my-class','title'=>'Укажите пароль'),
            'rules' => 'required|xss_clean'
        ),
        array(
            'field' => 'email_user',
            'label' => 'Email',
            'type' => 'input[type=text]',
            'data'=>array('class'=>'email_user, my-class','title'=>'Укажите email'),
            'rules' => 'required|xss_clean|valid_email'
        ),
        //Выпадающий список  input select
        array(
            'field' => 'country_id',
            'label' => 'Страна',
            /*'unset_zero' => '1',*//*не выводить текст "Укажите значение"*/
            'type' => 'select',
            //имя двумерного массива  для формирования списка $country = array('Украина','Россия','Болгария','Эстония');
            'key_with_array' => 'country',/*ключ в массиве*/
            'data'=>array('class'=>'login, my-class','title'=>'Укажите логин'),
            'rules' => 'required|xss_clean'
        ),
       //Радио кнопки input[type=radio]
        array(
            'field' => 'pol_user',
            'label' => 'Пол',
            'type' => 'input[type=radio]',
            'array_radio'=>
            array(
               //Первая радио кнопка
                array(
                    'field' => 'pol_user',
                    'label' => 'Мужской',
                    'value' => '1',
                    'type' => 'input[type=radio]',
                    'data'=>array('class'=>'pol_user, my-class','title'=>'Мужской пол'),
                    'wrappers'=>array('label_wrappers'=>'','field_wrappers'=>'','form_wrappers'=>'<label class="radio"></label>')
                ),
                //Вторая радио кнопка
                array(
                    'field' => 'pol_user',
                    'label' => 'Женский',
                    'value' => '2',
                    'type' => 'input[type=radio]',
                    'data'=>array('class'=>'pol_user, my-class','title'=>'Женский пол'),
                    'wrappers'=>array('label_wrappers'=>'','field_wrappers'=>'','form_wrappers'=>'<label class="radio"></label>')
                )
            ),
            'rules' => 'required|xss_clean',
        ),
       //Чекбокс input[type=checkbox]
        array(
            'field' => 'is_pr',
            'label' => 'Рекламщикам',
            'type' => 'input[type=checkbox]',
            'data'=>array(),
            'rules' => 'xss_clean',
            'value'=>1,
            'wrappers'=>array('label_wrappers'=>'','field_wrappers'=>'','form_wrappers'=>'<label class="checkbox"></label>')
        ),

    )
);
?>
