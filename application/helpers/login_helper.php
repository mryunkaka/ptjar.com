<?php
function periksa_login()
{
    $ci = get_instance(); //pengganti this
    if (!$ci->session->userdata('username')) {

        redirect('auth');
    } else {
        $timenow = date("Y-m-d H:i:s");
        $id = $ci->session->userdata('id');
        $key = $ci->session->userdata('key');
        $expired = $ci->db->get_where('tmp_login', [
            'vc_user_id' => $id
        ])->row_array();

        $validToken = !empty($expired['vc_token']) && !empty($key) && hash_equals((string) $expired['vc_token'], (string) $key);
        $validExpiry = !empty($expired['dt_expired']) && strtotime($expired['dt_expired']) > time();
        if (!$validToken || !$validExpiry) {

            $ci->db->delete('tmp_login', array('vc_user_id' => $id));

            $array_items = array('id', 'username', 'name', 'role', 'key');
            $ci->session->unset_userdata($array_items);
            $ci->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User Anda Sedang Digunakan. Silahkan Login Kembali!</div>');
            redirect('auth');
        }
        // elseif ($timenow > $expired['dt_expired']) {
        //     $ci->db->delete('tmp_login', array('vc_user_id' => $id));
        //     $array_items = array('id', 'username', 'name', 'role', 'key');
        //     $ci->session->unset_userdata($array_items);
        //     $ci->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sesi Anda Telah Habis. Silahkan Login Kembali!</div>');
        //     redirect('auth');
        // }
    }
}


function periksa_logout()
{
    $ci = get_instance(); //pengganti this
    if ($ci->session->userdata('username')) {
        header("location: dashboard", true, 301);
        exit();
    }
}




function weekOfMonth($date)
{
    //Get the first day of the month.
    $firstOfMonth = strtotime(date("Y-m-01", $date));
    //Apply above formula.
    return weekOfYear($date) - weekOfYear($firstOfMonth) + 1;
}

function weekOfYear($date)
{
    $weekOfYear = intval(date("W", $date));
    if (date('n', $date) == "1" && $weekOfYear > 51) {
        // It's the last week of the previos year.
        return 0;
    } else if (date('n', $date) == "12" && $weekOfYear == 1) {
        // It's the first week of the next year.
        return 53;
    } else {
        // It's a "normal" week.
        return $weekOfYear;
    }
}
function cek_ip()
{
    $ci = get_instance(); //pengganti this
    if (!$ci->session->userdata('site_lang')) {
        $gg = substr($ci->input->ip_address(), 0, 3);
        if ($gg !== '101') {
            $ci->session->set_flashdata('site_lang', 'ID');
        } else {
            $ci->session->set_flashdata('site_lang', 'ENG');
        }
    } else {
        $ci->session->set_flashdata('site_lang', $ci->session->userdata('site_lang'));
    }
}
