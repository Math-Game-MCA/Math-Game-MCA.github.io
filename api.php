<?php

// Connect to Database
$link = mysql_connect('mcalearning.com', 'user', 'password');
if (!$link) {
    die('Not connected : ' . mysql_error());
}
$db_selected = mysql_select_db('sofiav_mathgame', $link);
if (!$db_selected) {
    die ('Can\'t access database : ' . mysql_error());
}

//API Functions
//All will create a data "array of arrays" to be turned into JSON and returned
//Note - account verification and multiplayer functionality will be handled by separate PHP scripts

//Get a seed (Returns as 'seed.seed')
if($_GET["id"] == "seed")
{
    $rand = rand(0, 33999);
    $seedval = mysql_query( "select seed from sofiav_mathgame.seed where seed_id = " . $rand ); 
    $return = array(
    array("seed"),
    array("seed", $seedval )
    );
}


//Return JSON
echo('{"' . $return[0][0] . '"{');
for ($x = 0; $x < sizeof($return)-1; $x++)
{
    if($x + 1 < sizeof($return)-1)
        echo('   "' . $return[$x][0] . '":"' . $return[$x][1] . '",');
    else
        echo('   "' . $return[$x][0] . '":"' . $return[$x][1] . '"');
}
echo('}');

?>