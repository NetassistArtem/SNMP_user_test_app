<!DOCTYPE html>
<!--[if lt IE 7]>
<html lang="ru" class="lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]>
<html lang="ru" class="lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]>
<html lang="ru" class="lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="ru">
<!--<![endif]-->
<head>

    <meta charset="UTF-8"/>
    <title>test</title>
    <meta name="description" content=""/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>


    <!--  <link rel="stylesheet" href="/Applicationroot/css/css_reset.css"/> -->
    <link rel="stylesheet" href="/Applicationroot/css/fonts.css"/>
    <link rel="stylesheet" href="/main.css"/>
    <script src="/SNMP_user_test/SNMP_user_test_app.js"></script>

</head>
<body>
<div>
    <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam bibendum sagittis purus, a ornare ex. Vestibulum vulputate neque ac diam bibendum porttitor vitae vitae ligula. Suspendisse non massa id nisi pretium dignissim. Aenean pretium ullamcorper elit ultrices lacinia. Aliquam et consequat nisl. Donec et urna eu purus pulvinar consequat. Nulla facilisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac dolor quis risus auctor commodo.

        Donec tellus felis, aliquet non nisi vel, euismod rutrum nibh. Nullam at justo non enim molestie laoreet nec ut erat. Aliquam erat volutpat. Phasellus tempor felis quam, at ullamcorper tellus porttitor at. Quisque euismod id mi ac malesuada. Nulla ultrices neque ut lacus posuere, id vehicula erat varius. Morbi et euismod risus. Donec feugiat condimentum magna, in sagittis enim vulputate in. Cras aliquet sapien sem. Curabitur vel placerat neque, quis pretium sapien. Proin vehicula ex eget ipsum vestibulum, ut vestibulum risus ultrices. Nam et quam magna. Phasellus auctor ipsum nec nibh varius blandit.


    </p>
</div>


<a href= "javascript: void (0);" onclick="document.getElementById('test_id').innerHTML = snmp_url_user_test(3717,12);">test-js</a>

<div id="test_id">

</div>



<?php include 'SNMP_user_test/SNMP_user_test_app.php';
$style = array(
    'warning' => 'war',
    'notice' => 'not',
    'information' => 'inf'
);
require snmp_url_user_test(142,10,0, $style,null,'on', 'http://test.naic.29632.as',1,1)['full_url'];

//require snmp_url_port_test(3562,19,$style,null,'on')['full_url'];

require snmp_url_user_history(0,0,623,$style,'http://test.naic.29632.as')['full_url'];

require snmp_error_history()['full_url'];

?>



</body>
</html>



