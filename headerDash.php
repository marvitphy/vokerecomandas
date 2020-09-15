<!doctype html>
<html lang="en">

<head>
	<title>Painel de Controle - VComandas</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/framework7-icons@3/css/framework7-icons.css">
	<link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
	<script src="https://kit.fontawesome.com/2aebc9aa31.js" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/JavaScript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.js"></script>
    <!-- MAIN CSS -->
    <link href="assets/css/main.css?v=<?= filemtime('assets/css/main.css') ?>" rel="stylesheet">

	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<style>
	
	.panel-body{
	    overflow: auto;
	}
	.file-input__input {
  width: 0.1px;
  height: 0.1px;
  opacity: 0;
  overflow: hidden;
  position: absolute;
  z-index: -1;
}

.file-input__label {
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  border-radius: 4px;
  font-size: 14px;
  font-weight: 600;
  color: #fff;
  font-size: 14px;
  padding: 10px 12px;
  background-color: #4245a8;
  box-shadow: 0px 0px 2px rgba(0, 0, 0, 0.25);
}

.file-input__label svg {
  height: 16px;
  margin-right: 4px;
}
td{
    font-weight: 600;
}

		.btn-printer{
			font-size: 18px;
			margin-left: 12px;
		}
		.pedidos_ver{
		    overflow: auto;
		}
		.spinner {
		    background-image: url('assets/img/6.png');
		    background-size: 50%;
		    background-repeat: no-repeat;
		    background-position: center;
  width: 40px;
  height: 40px;
  background-color: #333;

  margin: 100px auto;
  -webkit-animation: sk-rotateplane 1.2s infinite ease-in-out;
  animation: sk-rotateplane 1.2s infinite ease-in-out;
}

@-webkit-keyframes sk-rotateplane {
  0% { -webkit-transform: perspective(120px) }
  50% { -webkit-transform: perspective(120px) rotateY(180deg) }
  100% { -webkit-transform: perspective(120px) rotateY(180deg)  rotateX(180deg) }
}

@keyframes sk-rotateplane {
  0% { 
    transform: perspective(120px) rotateX(0deg) rotateY(0deg);
    -webkit-transform: perspective(120px) rotateX(0deg) rotateY(0deg) 
  } 50% { 
    transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg);
    -webkit-transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg) 
  } 100% { 
    transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
    -webkit-transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
  }
}

@keyframes border-pulsate {
    0%   { border-color: rgba(0%, 100%, 93%, 19%); border: 4px solid}
    50% { border-color: rgba(247, 202, 24, 0); }
    100%   { border-color: rgba(247, 202, 24, 1); }
}




}

.custom-file-input::-webkit-file-upload-button {
  visibility: hidden;
}
.custom-file-input::before {
  content: 'Select some files';
  display: inline-block;
  background: linear-gradient(top, #f9f9f9, #e3e3e3);
  border: 1px solid #999;
  border-radius: 3px;
  padding: 5px 8px;
  outline: none;
  white-space: nowrap;
  -webkit-user-select: none;
  cursor: pointer;
  text-shadow: 1px 1px #fff;
  font-weight: 700;
  font-size: 10pt;
}
.custom-file-input:hover::before {
  border-color: black;
}
.custom-file-input:active::before {
  background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
}
	</style>
</head>
<body>
   