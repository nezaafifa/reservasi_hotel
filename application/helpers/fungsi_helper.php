<?php

function check_already_login()
{
  $ci = &get_instance();
  $user_session = $ci->session->userdata('userid');
  if ($user_session) {
    redirect('home');
  }
}
function check_not_login()
{
  $ci = &get_instance();
  $user_session = $ci->session->userdata('userid');
  if (!$user_session) {
    redirect('auth/login');
  }
}

if (!function_exists('to_date')) {
  function to_date($date = null, $sp = null, $tp = null, $sp2 = null)
  {
    if ($date != '') {
      if ($tp == 'date') {
        $arr_date = explode(' ', $date);
        $date = $arr_date[0];
      } elseif ($tp == 'full_date') {
        $arr_date = explode(' ', $date);
        $date = $arr_date[0];
        $time = $arr_date[1];
      } elseif ($tp == 'time') {
        $arr_date = explode(' ', $date);
        $time = $arr_date[1];
      } elseif ($tp == 'hour_minute') {
        $arr_date = explode(' ', $date);
        $time = $arr_date[1];
        $arr_time = explode(':', $time);
        $hour = @$arr_time[0];
        $minute = @$arr_time[1];
      } elseif ($tp == 'only_day_month_name') {
        $arr_date = explode(' ', $date);
        $date = $arr_date[0];
      } elseif ($tp == 'only_year') {
        $arr_date = explode(' ', $date);
        $date = $arr_date[0];
      } elseif ($tp == 'only_day') {
        $arr_date = explode(' ', $date);
        $date = $arr_date[0];
      }
      $arr = explode('-', $date);
      if ($sp != '') {
        $result = $arr[2] . $sp . $arr[1] . $sp . $arr[0];
      } else {
        $result = $arr[2] . '-' . $arr[1] . '-' . $arr[0];
      }
      if ($tp == 'full_date') {
        if ($sp2 != '') {
          $result .= $sp2 . $time;
        } else {
          $result .= ' ' . $time;
        }
      }
      if ($tp == 'time') {
        $result = $time;
      }
      if ($tp == 'hour_minute') {
        $result = $hour . ':' . $minute;
      }
      if ($tp == 'only_year') {
        $result = $arr[0];
      }
      if ($tp == 'only_month') {
        $result = $arr[1];
      }
      if ($tp == 'only_day') {
        $result = $arr[2];
      }
      if ($tp == 'only_day_month_name') {
        if ($sp != null) {
          $result = $arr[2] . $sp . get_bulan($arr[1]);
        } else {
          $result = $arr[2] . '-' . $arr[1];
        }
      }
    } else {
      $result = '';
    }
    return $result;
  }
}

if (!function_exists('float_id')) {
  function float_id($v, $s = null, $limit = 2)
  {
    $raw = explode('.', $v);
    $fraction = "";
    $fraction = (count($raw) == 2) ? "," . str_pad($raw[1], 2, '0', STR_PAD_RIGHT) : ",00";
    $fraction = substr($fraction, 0, ($limit + 1));
    if ($v != '') {
      if (is_numeric($v)) {
        $res = number_format($raw[0], 0, ",", ".");
        if ($s != null && $raw[0] == 0)
          return $s;
        else
          return $res . $fraction;
      } else {
        return $s;
      }
    } else {
      return 0;
    }
  }
}

// function check_admin() 
// {
//     $ci =& get_instance();
//     $ci->load->library('fungsi');
//     if($ci->fungsi->user_login()->level != 1) {
//         redirect('dashboard');
//     }
// }
// function indo_currency($nominal) {
//     $result = "Rp " . number_format($nominal, 2, ',', '.');
//     return $result;
// }
// function indo_date($date)
// {
//     $d = substr($date,8,2);
//     $m = substr($date,5,2);
//     $y = substr($date,0,4);
//     return $d.'/'.$m.'/'.$y;
// }