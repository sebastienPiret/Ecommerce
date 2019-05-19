<?php
/**
 * Copyright 2019 sebastien Piret
 */

function setFlashdata($class,$message,$url)
{
    $ci=get_instance();
    $ci->session->set_flashdata($class,$message);
    redirect($url);

}