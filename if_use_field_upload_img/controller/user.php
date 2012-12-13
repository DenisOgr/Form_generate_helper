<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('frontend.php');

class User extends Frontend
{

    private $aResult = array('status' => 0);

    public function __construct()
    {
        parent :: __construct();

        }


    /*--Ajax multiupload-*/
//загрузка картинок
    public function do_multiupload()
    {
        // Список поддерживаемых расширений, ex. array("jpeg", "xml", "bmp")
        $allowedExtensions = array("jpg", "png", "gif", "jpeg");

        // Максимально допустимый размер файла, в байтах
        $sizeLimit = 3 * 1024 * 1024; //3.1Мб
        //сама  библиотека

        $this->load->library("qqfileuploader", array('allowedExtensions' => $allowedExtensions, 'sizeLimit' => $sizeLimit));

        $result = $this->qqfileuploader->UploadImage('/media/upload/avatar/', null, $this->data['thumb']);
        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);

    }

//удаление картинок
    public function delete_multiupload()
    {
        $del_img = $this->input->post('name_pic');
        if (!$del_img) return false;
        (is_file(realpath('.') . $this->data['UPLOAD_PATH'] . $del_img)) ? unlink(realpath('.') . $this->data['UPLOAD_PATH'] . $del_img) : false;
        foreach ($this->data['thumb'] as $key => $value)
        {
            (is_file(realpath('.') . $this->data['UPLOAD_PATH'] . $value[0] . '_' . $del_img)) ? unlink(realpath('.') . $this->data['UPLOAD_PATH'] . $value[0] . '_' . $del_img) : false;

        }
        echo 'true';


    }

    /**********************автокомплиты ***************************************/


    public function get_country()
    {
        $table = 'country';
        $field = 'country';

        $query = htmlspecialchars(trim($this->input->get('query')));
        $arr_words = explode(' ', $query);

        if (count($arr_words) > 1)
        {
            $q1 = '( ';
            foreach ($arr_words as $item)
            {
                $q1 .= $field . ' LIKE "%' . $item . '%" OR';
            }
            $q1 = substr($q1, 0, strlen($q1) - 3);
            $q1 .= ' )';
            $res = $this->UM->get_search($table, $q1);

            if (!empty($res))
            {
                foreach ($res as $key => $item)
                {
                    $res[$key]['order'] = 0;
                    foreach ($arr_words as $word)
                    {
                        if (stristr($item[$field], $word))
                        { //
                            $res[$key]['order']++;
                        }
                    }
                }
                usort($res, array(__class__, 'cmp_order'));
            }
        } else
        {


            $res = $this->UM->get_search($table, $field . ' LIKE "%' . strtolower($query) . '%" OR ' . $field . ' LIKE "%' . mb_ucfirst($query) . '%"  OR ' . $field . ' LIKE "%' . mb_strtoupper($query) . '%"');

        }

        $suggestions = array();
        $data_id = array();
        if (!empty($res))
        {
            foreach ($res as $item)
            {
                $suggestions[] = $item[$field];
                $data_id[] = $item[$field];
            }
        }
        $json_data = array('query' => $query, 'suggestions' => $suggestions, 'data' => $data_id);
        echo json_encode($json_data);
    }


    public function get_city()
    {
        $table = 'city';
        $field = 'city';

        $query = htmlspecialchars(trim($this->input->get('query')));
        $country = htmlspecialchars(trim($this->input->get('country')));
        $country_info = $this->ST->get_data_tabl('country', array('country' => $country));
        $country_where = (!empty($country_info)) ? ' AND country_id =' . $country_info[0]->id_country : '';

        $arr_words = explode(' ', $query);

        if (count($arr_words) > 1)
        {
            $q1 = '( ';
            foreach ($arr_words as $item)
            {
                $q1 .= $field . ' LIKE "%' . $item . '%" OR';
            }
            $q1 = substr($q1, 0, strlen($q1) - 3);
            $q1 .= ' ) ' . $country_where;
            $res = $this->UM->get_search($table, $q1);

            if (!empty($res))
            {
                foreach ($res as $key => $item)
                {
                    $res[$key]['order'] = 0;
                    foreach ($arr_words as $word)
                    {
                        if (stristr($item[$field], $word))
                        { //
                            $res[$key]['order']++;
                        }
                    }
                }
                usort($res, array(__class__, 'cmp_order'));
            }
        } else
        {
            $res = $this->UM->get_search($table, $field . ' LIKE "%' . strtolower($query) . '%" OR ' . $field . ' LIKE "%' . mb_ucfirst($query) . '%" OR ' . $field . ' LIKE "%' . mb_strtoupper($query) . '%"');
        }

        $suggestions = array();
        $data_id = array();
        if (!empty($res))
        {
            foreach ($res as $item)
            {
                $suggestions[] = $item[$field];
                $data_id[] = $item[$field];
            }
        }
        $json_data = array('query' => $query, 'suggestions' => $suggestions, 'data' => $data_id);
        echo json_encode($json_data);
    }

//социальные кнопки для регистрации/авторизации (сервер)
    public function set_user()
    {
        $this->data['result'] = $this->user_lib->handler_social();
        echo json_encode($this->data['result']);
    }


}
