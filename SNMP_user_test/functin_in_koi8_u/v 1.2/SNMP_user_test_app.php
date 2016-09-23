<?php
/**
 * ���������� ������� ��� $switch_id � $port_id ��� $user_id
 * $switch_id � $port_id ��� ������������ ���������, ���� ���� ������ ��� ������������ $user_id, �� ���� �� �������� �������� null
 * ���� ������� ��� ��� ��������� $switch_id , $port_id, $user_id �� � �������� ������ ����� �������������� $user_id � ���������
 * $switch_id , $port_id ����� ����������������.
 *
 * $cable_test- ������ ������ �����, ����� ��� �������� "on", "off", "onoff", �������� ������������ �� ���������,
 *� ���� ������ ���� ������������ ����������� ���� ���� � ������� "off". ������� url_user_test  � $cable_test = "on" ����� ��������
 * ���� ��� ��������� ������ - "��������� ������ ����"
 *
 * $link - �������� �� ��������� � ���������� ���� ������.��� �������� 0, 1. �� ������ ��������� ����� APPI ���� ��������� ������
 * 1)������ ������ �����
 * 2)������ ������ ������ - ��� ������� ������ �������� ���������� �������� ������ ������ ��� ����������� �� ����������
 * ������������ ������ - �� ������� ������� ������������ ��������� ������, ������ ��������� ���� ������ ����� ���� ��������
 * ������ "�������� ����� ������". � ������ ������������ ��������� �������� � ��������� ���������, ���������� ������ �����
 * ���� ������ ������������ � ������� ���������� �����, � ������ ������� � ������ +- 1 ���� ������������� ��������������.
 * 3)������� �������� ������������
 *
 * $style_class_array ����� �������� css ������� ������� �� ��������������� ���� ������� �������������� - warning,notice,information
 * �� ��������� ����� ������������ ���� �������
 *
 * $cable_length - ������ ������ ������, ��� �������� , �� ��������� "null" - ������ �� ����������, "write" - ���������� ������ ������
 * ������ ������ ������ ����� ����������� ������ ���� ���� ����� � ������� "off" ���� �� �������, �������� ��������������
 * ��� ������ ������ �� ����� ���� ���������.
 * ���� �������� �� ��������� "write" ����� ������������ ��� �������� ������ - "�������� ������ ������". ����� ����� ��� ������
 * ����������� ������ ������ ������ ������������ �������������.
 *
 * $switch_data ����� ������ ������� � ������� ������� ������ � ����� ��� ������ ���������� �� snmp ������. 1 - �� ���������
 * ����� ���� ������, 0 - ����� ������ ������ ���������� �� snmp
 *
 * return ������ ���������� ��������� ������
 * $url_array['full_url'] - ������ ������ � ������ � �����������,
 * $url_array['host'] - �������
 * $url_array['address'] - ��������� ������ ��� ����� � ����������
 * $url_array['params'] -  ��������� (get)
 *
 * $switch_list - �������� �������� �� ����������� �� �������� ������������ ��� �� �������� �����. 0-��� �������� ������������
 * 1- ��� �������� �����. �� ��������� ����� 0 ��� ���������� ��� ������� ������������.
 *
 * $byte_velocity - ��������� ������ � ������� ��������� �� ������� ��� ����� ������� ����������� �������� �������� � ������
 * ����������� �������� ��� ������ � ������� �������� ���������� �������(in), ���� / ��������, ����/� � �������(out), ���� / ��������, ����/�
 * �� ��������� = null, ��� ��������� �������� 1.
 */


/**
 * @param $switch_id
 * @param $port_id
 * @param null $user_id
 * @param array $style_class_array
 * @param null $cable_length
 * @param string $cable_test
 * @param string $host
 * @param int $link
 * @param int $switch_data
 * @param int $byte_velocity
 * @return array
 */


function snmp_url_user_test(
    $switch_id,
    $port_id,
    $user_id = null,
    $style_class_array = array(
        'warning' => 'warning',
        'notice' => 'notice',
        'information' => 'information'
    ),
    $cable_length = null,
    $cable_test = 'onoff',
    $host = 'http://test.naic.29632.as',
    $link = 1,
    $switch_data = 1,
    $switch_list = 1,
    $byte_velocity = null
)
{
    $warning = $style_class_array['warning'];
    $notice = $style_class_array['notice'];
    $information = $style_class_array['information'];
    $cable_l = $cable_test == 'off' ? '' : '&cable_length=' . $cable_length;
    $url = $host . "/bl/account_test?bl=1&switch={$switch_id}&port={$port_id}&user_id={$user_id}&cabletest={$cable_test}&link={$link}&warning={$warning}&notice={$notice}&information={$information}{$cable_l}&switch_data={$switch_data}&sw={$switch_list}&byte_velocity={$byte_velocity}";
    //   echo $url;
    $url_array = array(
        'full_url' => $url,
        'host' => $host,
        'address' => "/bl/account_test",
        'params' => "bl=1&switch={$switch_id}&port={$port_id}&user_id={$user_id}&cabletest={$cable_test}&link={$link}&warning={$warning}&notice={$notice}&information={$information}{$cable_l}&switch_data={$switch_data}&sw={$switch_list}&byte_velocity={$byte_velocity}"
    );
    return $url_array;

}

/**
 * ������� ��� ��������� ������� �� �������������� ������������.
 * ��� ��������� ���������� ������� url_user_test
 */
/**
 * @param $switch_id
 * @param $port_id
 * @param null $user_id
 * @param array $style_class_array
 * @param string $host
 * @return array
 */

function snmp_url_user_history(
    $switch_id,
    $port_id,
    $user_id = null,
    $style_class_array = array(
        'warning' => 'warning',
        'notice' => 'notice',
        'information' => 'information'
    ),
    $host = 'http://test.naic.29632.as',
    $switch_list = 0
)
{
    $warning = $style_class_array['warning'];
    $notice = $style_class_array['notice'];
    $information = $style_class_array['information'];
    $history = 'history';
    if($switch_list ==1){
        $history = 'history_by_switch';
    }
    $url = $host . "/bl/account_test/{$history}?bl=1&switch=$switch_id&port=$port_id&user_id={$user_id}&warning={$warning}&notice={$notice}&information={$information}&sw={$switch_list}";
    //   echo $url;
    $url_array = array(
        'full_url' => $url,
        'host' => $host,
        'address' => "/bl/account_test/{$history}",
        'params' => "bl=1&switch=$switch_id&port=$port_id&user_id={$user_id}&warning={$warning}&notice={$notice}&information={$information}&sw={$switch_list}"
    );
    return $url_array;

}

/**
 * ������� ��� ��������� ���������� � ���� ��������������� ����������� � �������� ������������ �������������.
 * ���������� ������� � ���� ������ - "��� ������ ��� ������ �������������" �/��� "������ ��� ������ ������������� �� �������"
 * ���������� "date" ����� �������� ������ �� ������������ ����, ���� �� ��������� ���� �� ����� ������������ ��� ����������
 * ���� � ������� "y_m_d" �������� "2016_05_06"
 */
/**
 * @param null $date
 * @param string $host
 * @return string
 */

function snmp_error_history(
    $date = null,
    $host = 'http://test.naic.29632.as'
)
{
    $date_errors = $date ? '&errors_date=' . $date : '';
    $url = $host . "/bl/account_test/user_error?bl=1{$date_errors}";
    $url_array = array(
        'full_url' => $url,
        'host' => $host,
        'address' => "/bl/account_test/user_error",
        'params' => "bl=1{$date_errors}"
    );
    return $url_array;
}



/*
function snmp_url_port_test(
    $switch_id,
    $port_id,
    $style_class_array = array(
        'warning' => 'warning',
        'notice' => 'notice',
        'information' => 'information'
    ),
    $cable_length = null,
    $cable_test = 'onoff',
    $host = 'http://test.naic.29632.as',
    $link = 1,
    $switch_data = 1
)
{
    $warning = $style_class_array['warning'];
    $notice = $style_class_array['notice'];
    $information = $style_class_array['information'];
    $cable_l = $cable_test == 'off' ? '' : '&cable_length=' . $cable_length;
    $url = $host . "/bl/account_test?sw=1&bl=1&switch={$switch_id}&port={$port_id}&cabletest={$cable_test}&link={$link}&warning={$warning}&notice={$notice}&information={$information}{$cable_l}&switch_data={$switch_data}";
    //   echo $url;
    $url_array = array(
        'full_url' => $url,
        'host' => $host,
        'address' => "/bl/account_test",
        'params' => "sw=1&bl=1&switch={$switch_id}&port={$port_id}&cabletest={$cable_test}&link={$link}&warning={$warning}&notice={$notice}&information={$information}{$cable_l}&switch_data={$switch_data}"
    );
    return $url_array;

}

*/