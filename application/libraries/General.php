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

    function getSingleImage($type, $type_id) {
        $this->CI->load->model('Image');
        $image = $this->CI->Image->findSingle($type, $type_id);
        return $image;
    }

    function getSingleFile($type, $type_id) {
        $this->CI->load->model('File');
        $file = $this->CI->File->findSingle($type, $type_id);
        return $file['url'];
    }

    function getSlider() {
        $this->CI->load->model('Slide');
        $this->CI->load->model('Image');
        $slides = $this->CI->Slide->findActive();
        $data = array();
        $i = 0;
        if (!empty($slides)) {
            foreach ($slides as $slide) {
                $image = $this->CI->Image->findSingle('slides', $slide['id']);
                $data[$i]['id'] = $slide['id'];
                $data[$i]['url'] = $image['url'];
                $data[$i]['title'] = $slide['title'];
                $data[$i]['description'] = $slide['description'];
                $data[$i]['title_en'] = $slide['title_en'];
                $data[$i]['description_en'] = $slide['description_en'];
                $i++;
            }
        }
        return $data;
    }

   
    function getCategories() {
        $this->CI->load->model('Category');

        $categories = $this->CI->Category->findAll();
        return $categories;
    }

    function __createMenu($data, $parent = 0) {

        static $i = 1;
        $tab = str_repeat("\t\t", $i);
        if (isset($data[$parent])) {
//            $html = "\n$tab<ul>";
            $html = "\n" . $tab . '<ul id="jsddm" class="menu clearfix tabs">';
//            $html .= "\n" . '<li><a href="' . base_url() . '">HOME</a></li>';
            $i++;
            foreach ($data[$parent] as $v) {
                $child = $this->__createMenu($data, $v['id']);
                $html .= "\n\t$tab<li>";
                $html .= '<a href="' . base_url() . $v['url'] . '">' . strtoupper($v['name']) . '</a>';
                if ($child) {
                    $i--;
                    $html .= $child;
                    $html .= "\n\t$tab";
                }
                $html .= '</li>';
            }
            $html .= "\n$tab</ul>";

            return $html;
        } else {
            return false;
        }
    }

    function getMultiLevelMenu() {
        $this->CI->load->model('Menu');
        $menu = $this->CI->Menu->findActive();

        $data = array();
        foreach ($menu as $m) {
            $data[$m['parent_id']][] = $m;
        }


        return $this->__createMenu($data);
    }

    

    function isExistFile($filename) {
//        echo $filename;exit;
        if (file_exists($filename)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function isExistPageInMenu($permalink) {
        $this->CI->load->model('Menu');
        $url = 'pages/read/' . $permalink;

        $page = $this->CI->Menu->findByUrl($url);

        if (!empty($page)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function isExistNextSlide($position) {
        $this->CI->load->model('Slide');
        $slide = $this->CI->Slide->getNextSlide($position);
        if (!empty($slide)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function isExistPrevSlide($position) {
        $this->CI->load->model('Slide');
        $slide = $this->CI->Slide->getPrevSlide($position);
        if (!empty($slide)) {
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

    function getOtherPages($pageId) {
        $this->CI->load->model('Page');
        $pages = $this->CI->Page->findOtherPages($pageId);
        return $pages;
    }

    function getSettingByKey($key) {
        $this->CI->load->model('Setting');
        $setting = $this->CI->Setting->findByKey($key);
        return $setting;
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

   
}

?>
