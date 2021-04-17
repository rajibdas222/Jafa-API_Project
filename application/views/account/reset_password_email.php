<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title></title>
    <style type="text/css">
    	/*.btn {
    		text-decoration: none;
    	    display: inline-block;
    	    font-weight: 400;
    	    color: #fff;
    	    text-align: center;
    	    vertical-align: middle;
    	    cursor: pointer;
    	    -webkit-user-select: none;
    	    -moz-user-select: none;
    	    -ms-user-select: none;
    	    user-select: none;
    	    background-color: transparent;
    	    border: 1px solid transparent;
    	    padding: .375rem .75rem;
    	    font-size: 1rem;
    	    line-height: 1.5;
    	    border-radius: .25rem;
    	    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    	}
    	
    	.btn-primary {
		    background-color: #007bff;
		    border-color: #007bff;
		}
		.btn-lg{
    		padding: .5rem 1rem;
		    font-size: 2.25rem;
		    line-height: 1.5;
		    border-radius: .3rem;
    	}*/

    	.activation-link{
    		/*border: 4px solid #107FC9; border-radius: 5px; padding: 10px;*/
    	}
    </style>
</head>
<body>
<?php echo sprintf(lang('reset_password_email'), $fullname, $password_reset_url); ?>
<a target="_blank" href="<?= base_url() ?>">
	<img src="<?= base_url() ?>resource/img/jafa-logo2.png">
</a>
<p>E-mail: info_jafa@jacos.co.jp</p>
</body>
</html>
