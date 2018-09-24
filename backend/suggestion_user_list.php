<?php

if ( !isset($_REQUEST['term']) )
    exit;

$dblink = mysql_connect('localhost', 'root', '') or die( mysql_error() );
mysql_select_db('inventory_system');

$rs = mysql_query('select username, name, user_type from zipcode where username like "'. mysql_real_escape_string($_REQUEST['term']) .'%" order by username asc limit 0,10', $dblink);

$data = array();
if ( $rs && mysql_num_rows($rs) )
{
    while( $row = mysql_fetch_array($rs, MYSQL_ASSOC) )
    {
        $data[] = array(
            'label' => $row['username'] .', '. $row['name'] .' '. $row['user_type'] ,
            'value' => $row['admin_id']
        );
    }
}

echo json_encode($data);
flush();