<form action="<?=site_url('user/my')?>" method="POST">
    <?
   //функция для построенения формы на основе form_validation.php
    render_form('user_edit', $delimiter, $data, $oDefault)?>

    <?echo form_button(array('name' => 'send_reg', 'id' => 'send_button', 'type' => 'submit'), 'Отправить');?>
</form>
