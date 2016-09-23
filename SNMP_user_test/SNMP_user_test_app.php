<?php
/**
 * Необходимо вводить или $switch_id с $port_id или $user_id
 * $switch_id с $port_id как обязательные параметры, если надо вместо них использовать $user_id, то надо им присвоит значения null
 * если указать все три параметра $switch_id , $port_id, $user_id то в парсинге адреса будет использоваться $user_id а параметры
 * $switch_id , $port_id будут проигнорированны.
 *
 * $cable_test- запуск кабель теста, имеет три значения "on", "off", "onoff", последне устанолвенно по умолчанию,
 *в этом режиме тест авоматически запускается если порт в статусе "off". Функцию url_user_test  с $cable_test = "on" можно использо
 * вать для получения ссылки - "запустить кабель тест"
 *
 * $link - отвечает за включение и выключение всех ссылок.Два значения 0, 1. На момент написания этого APPI есть следующие ссылки
 * 1)запуск кабель теста
 * 2)запись длинны кабеля - для каждого нового обонента необходимо записать длинну кабеля при отключенном от компьютера
 * пользователя кабеле - по прозьбе сопорта пользователь отключает кабель, сопорт запускает тест кабеля после чего нажимает
 * ссылку "записать длину кабеля". В случае последующего обращения обонента с какойлибо проблемой, полученные данные после
 * тест кабеля сравниваются с данными записыными ранее, в случае разници в длинне +- 1 метр высвечивается предупреждение.
 * 3)история запросов пользователя
 *
 * $style_class_array нужны названия css классов которые бы соответствовали трем уровням предупреждений - warning,notice,information
 * по умолчанию стоят наименование моих классов
 *
 * $cable_length - запись длинны кабеля, два значения , по умолчанию "null" - запись не происходит, "write" - записывает длинну кабеля
 * Запись длинны кабеля будет происходить только если порт будет в статусе "off" если он включен, появится предупреждение
 * что длинна кабеля не может быть записанна.
 * этот параметр со значением "write" можно использовать для создания ссылки - "Записать длинну кабеля". Когда можно или нельзя
 * производить запись длинны кабеля определяется автоматически.
 *
 * $switch_data вывод полной таблици с данными включая данные о свиче или только полученные по snmp данные. 1 - по умолчанию
 * вывод всех данных, 0 - вывод данных только полученных по snmp
 *
 * return массив содержащий следующие данные
 * $url_array['full_url'] - полный адресс с хостом и параметрами,
 * $url_array['host'] - хостинг
 * $url_array['address'] - адрессная строка без хоста и параметров
 * $url_array['params'] -  параметры (get)
 *
 * $switch_list - параметр отвечает за отображение со страници пользователя или со страници свича. 0-для страници пользователя
 * 1- для страници свича. По умолчанию стоит 0 для отображеня для странци пользователя.
 *
 * $byte_velocity - получение данных с большой задержкой по времени для более точного определения скорости передачи в байтах
 * Необходимый параметр для ссылки в таблице напротив параметров счетчик(in), байт / скорость, байт/с и счетчик(out), байт / скорость, байт/с
 * По умолчанию = null, для активации присвоит 1.
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
    $switch_list = null,
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
 * Функуия для получения истории по запрашиваемому пользователю.
 * Все параметры аналогичны функции url_user_test
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
 * функция для получения информации о всех предупреждениях возникающих в процессе тестирования пользователей.
 * Желательно сделать в виде ссылки - "Все ошибки при заросе пользователей" и/или "Ошибки при заросе пользователей за сегодня"
 * Параметром "date" можно получить данные за определенную дату, если не указывать дату то будет отображаться вся информация
 * Дата в формате "y_m_d" например "2016_05_06"
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