/**cable_test- запуск кабель теста, имеет три значения "on", "off", "onoff", последне устанолвенно по умолчанию,
 *в этом режиме тест авоматически запускается если порт в статусе "off". Функцию url_user_test  с cable_test = "on" можно использо
 * вать для получения ссылки - "запустить кабель тест"
 *
 * link - отвечает за включение и выключение всех ссылок.Два значения 0, 1. На момент написания этого APPI есть следующие ссылки
 * 1)запуск кабель теста
 * 2)запись длинны кабеля - для каждого нового обонента необходимо записать длинну кабеля при отключенном от компьютера
 * пользователя кабеле - по прозьбе сопорта пользователь отключает кабель, сопорт запускает тест кабеля после чего нажимает
 * ссылку "записать длину кабеля". В случае последующего обращения обонента с какойлибо проблемой, полученные данные после
 * тест кабеля сравниваются с данными записыными ранее, в случае разници в длинне +- 1 метр высвечивается предупреждение.
 * 3)история запросов пользователя
 *
 * style_class_array нужны названия css классов которые бы соответствовали трем уровням предупреждений - warning,notice,information
 * по умолчанию стоят наименование моих классов
 *
 * cable_length - запись длинны кабеля, два значения , по умолчанию "null" - запись не происходит, "write" - записывает длинну кабеля
 * Запись длинны кабеля будет происходить только если порт будет в статусе "off" если он включен, появится предупреждение
 * что длинна кабеля не может быть записанна.
 * этот параметр со значением "write" можно использовать для создания ссылки - "Записать длинну кабеля". Когда можно или нельзя
 * производить запись длинны кабеля определяется автоматически.
 *
 * switch_data вывод полной таблици с данными включая данные о свиче или только полученные по snmp данные. 1 - по умолчанию
 * вывод всех данных, 0 - вывод данных только полученных по snmp
 */


function snmp_url_user_test(switch_id, port_id, style_class_array, cable_length, cable_test, host, link, switch_data) {
    cable_length = cable_length || null;
    cable_test = cable_test || 'onoff';
    host = host || 'http://test.naic.29632.as';
    link = link || 1;
    switch_data = switch_data || 1;

     style_class_array = style_class_array || {
        'warning': 'warning',
        'notice': 'notice',
        'information': 'information'
    };

   var warning = style_class_array['warning'];
    var notice = style_class_array['notice'];
    var information = style_class_array['information'];
    if (cable_test === 'off'){
        var cable_l = '';
    }else {
         cable_l = '&cable_length=' + cable_length;
    }

    var url =  host + "/bl/account_test?bl=1&switch=" + switch_id + "&port=" + port_id + "&cabletest=" +cable_test+ "&link=" + link + "&warning=" + warning + "&notice=" + notice + "&information=" + information + cable_l + "&switch_data=" + switch_data;

//alert(url);
   // window.location.assign(url);
    return url;
}

/**
 * Функуия для получения истории по запрашиваемому пользователю.
 * Все параметры аналогичны функции url_user_test
 */
/**
 * @param switch_id
 * @param port_id
 * @param style_class_array
 * @param host
 * @return string
 */

function snmp_url_user_history(switch_id, port_id, style_class_array, host)
{

    style_class_array = style_class_array || {
            'warning': 'warning',
            'notice': 'notice',
            'information': 'information'
        };
    host = host || 'http://test.naic.29632.as';

    var warning = style_class_array['warning'];
    var notice = style_class_array['notice'];
    var information = style_class_array['information'];


  var  url = host + "/bl/account_test/history?bl=1&switch=" + switch_id + "&port=" + port_id + "&warning=" + warning + "&notice=" + notice + "&information=" + information;
    //   echo $url;
    return url;

}

/**
 * функция для получения информации о всех предупреждениях возникающих в процессе тестирования пользователей.
 * Желательно сделать в виде ссылки - "Все ошибки при заросе пользователей" и/или "Ошибки при заросе пользователей за сегодня"
 * Параметром "date" можно получить данные за определенную дату, если не указывать дату то будет отображаться вся информация
 * Дата в формате "y_m_d" например "2016_05_06"
 */
/**
 * @param date
 * @param host
 * @return string
 */

function snmp_error_history(date, host)
{

    host = host || 'http://test.naic.29632.as';
    date = date || null;

    if(date){
        var date_errors = '&errors_date=' + date;
    }else {
        date_errors = '';
    }

     var url = host + "/bl/account_test/user_error?bl=1" + date_errors;
    return url;
}


