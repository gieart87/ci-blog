<?php

/*
 * Name : General Library
 * Author : Sugiarto (sugiarto@gie-art.com)
 * Date : December 24, 2015
 */

class General {

    var $CI;

    function __construct() {
        $this->CI = &get_instance();
//        $this->isLogin();
    }

    function generateRandomCode($length = 8) {
        // Available characters
        $chars = '0123456789abcdefghjkmnoprstvwxyz';

        $Code = '';
        // Generate code
        for ($i = 0; $i < $length; ++$i) {
            $Code .= substr($chars, (((int) mt_rand(0, strlen($chars))) - 1), 1);
        }
        return strtoupper($Code);
    }

    public function humanDate($datetime) {
        return date("D, d M Y H:i:s", strtotime($datetime));
    }

    public function humanDate2($date) {
        return date("D, d M Y", strtotime($date));
    }

    function generateUniqueName($fileName) {

        return $this->CI->session->userdata('session_id') . md5(date("Y-m-d H:i:s")) . md5($fileName) . '.' . $this->getFileExtension($fileName);
    }

    function getFileExtension($fileName) {
        return substr(strrchr($fileName, '.'), 1);
    }

   
    function getCategories() {
        $this->CI->load->model('Category');
        $categories = $this->CI->Category->find_active();
        return $categories;
    }

    function getTags(){
        $this->CI->load->model('Tag');
        return  $this->CI->Tag->find_active();
    }

    function getRecentPosts($limit = null){
        $this->CI->load->model('Post');
        return $this->CI->Post->find_active($limit);
    }

    function isExistFile($filename) {
//        echo $filename;exit;
        if (file_exists($filename)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    
    function isExistNextMenu($position) {
        $this->CI->load->model('Menu');
        $slide = $this->CI->Menu->getNextMenu($position);
        if (!empty($slide)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function isExistPrevMenu($position) {
        $this->CI->load->model('Menu');
        $slide = $this->CI->Menu->getPrevMenu($position);
        if (!empty($slide)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    

    function getSettingByKey($key) {
        $this->CI->load->model('Setting');
        $setting = $this->CI->Setting->findByKey($key);
        if(!empty($setting)){
            return $setting;
        }else{
            return $key;
        }
    }


    function setDefaultLang() {
        $lang = $this->CI->session->userdata('language');

        if (!empty($lang)) {
            $this->CI->config->set_item('language', $this->CI->session->userdata('language'));
        } else {
            $this->CI->config->set_item('language', 'indonesian');
        }
    }

    function getDefaultLang() {
        return $this->CI->config->item('language');
    }

    function getYears() {
        $years = array();

        for ($i = date("Y"); $i > 1945; $i--) {
            $years[$i] = $i;
        }
        return $years;
    }


    function multilevel_select($array,$parent_id = 0,$parents = array(),$selected = null) {
        
        static $i=0;
        if($parent_id==0)
        {
            foreach ($array as $element) {
                if (($element['parent_id'] != 0) && !in_array($element['parent_id'],$parents)) {
                    $parents[] = $element['parent_id'];
                }
            }
        }

        $menu_html = '';
        foreach($array as $element){
            $selected_item = '';
            if($element['parent_id']==$parent_id){
                if($element['id'] == $selected){
                    $selected_item = 'selected';
                }

                $menu_html .= '<option value="'.$element['id'].'" '.$selected_item.'>';
                for($j=0; $j<$i; $j++) {
                    $menu_html .= '&mdash;';
                }
                $menu_html .= $element['name'].'</option>';
                if(in_array($element['id'], $parents)){
                    $i++;
                    $menu_html .= $this->multilevel_select($array, $element['id'], $parents, $selected);
                }
            }
        }
        $i--;
        return $menu_html;
    }


    function bootstrap_menu($array,$parent_id = 0,$parents = array())
    {
        if($parent_id==0)
        {
            foreach ($array as $element) {
                if (($element['parent_id'] != 0) && !in_array($element['parent_id'],$parents)) {
                    $parents[] = $element['parent_id'];
                }
            }
        }
        $menu_html = '';
        foreach($array as $element)
        {
            if($element['parent_id']==$parent_id)
            {
                if(in_array($element['id'],$parents))
                {
                    $menu_html .= '<li class="dropdown">';
                    $menu_html .= '<a href="'.site_url($element['url']).'" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'.$element['name'].' <span class="caret"></span></a>';
                }
                else {
                    $menu_html .= '<li>';
                    $menu_html .= '<a href="' . site_url($element['url']) . '">' . $element['name'] . '</a>';
                }
                if(in_array($element['id'],$parents))
                {
                    $menu_html .= '<ul class="dropdown-menu" role="menu">';
                    $menu_html .= $this->bootstrap_menu($array, $element['id'], $parents);
                    $menu_html .= '</ul>';
                }
                $menu_html .= '</li>';
            }
        }
        return $menu_html;
    }
   
}

?>
