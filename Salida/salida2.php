<?php

header("Content-disposition: attachment; filename=salidaReporte.pdf");
header("Content-type: application/pdf");
readfile("salidaReporte.pdf");



 ?>
