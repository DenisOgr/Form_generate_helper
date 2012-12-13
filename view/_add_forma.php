<form action="<?=site_url('controller/function')?>" method="POST">
    <?
    //обертки для полей, ошибок, названий, элементов формы
    //эти настройки применяются ко всем полям. если нужно сделать исключение, то можно задать настройки в самой config/form_validation.php
    $wrappers = array(
        //обертка для элемента формы (название, поле, блок с ошибкой)
        'form_field_wrappers'=>"<div class='control-group'></div>",
       //обертка для самого поля
        'field_wrappers'=>"<div class='controls'></div>",
        //обертка для блока с ошибками
        'error_wrappers'=>"<p class='text-error'></p>",
        //обертка для названия поля
        'label_wrappers'=>'<label class="control-label" ></label>');

    //'user'(обязательный параметр) - это массив в config/form_validation.php на основе котторого строить форму
    //$data(необязательный параметр) - массив массивов для построения Выпадающих списков
    //$oDefault(необязательный параметр) - массив/объект со значениями по молчанию (для редактирования формы)
    $data = array('country' => $country);

    render_form('user', $wrappers, $data, $oDefault)?>

    <input type="submit" value="Отправить">

</form>
