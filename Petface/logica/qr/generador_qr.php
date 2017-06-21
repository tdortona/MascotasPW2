<?php

include("Conectarbd.php");
include("phpqrcode/qrlib.php");

QRcode::png('perfilMascota.php',false,QR_ECLEVEL_Q,3);


QRcode::png('perfilMascota.php','cacho.png');





?>
