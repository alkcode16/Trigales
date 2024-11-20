		</div>
	</div>
</body>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">

    window.onload = function Salida(){
      setTimeout('ejecutar()',hora());

    }

    function hora(){
        horaActual=new Date();
        horaProgramada=new Date();
        horaProgramada.setHours(4);
        horaProgramada.setMinutes(33);
        horaProgramada.setSeconds(40);
        return horaProgramada.getTime() - horaActual.getTime();

    }

    function ejecutar(){
      hora();
      if (hora()==0) {
        window.location=("../Salida/salidaReporte.php");
        //alert('que pedo prro');
      }else {

      }
    }
</script>

</html>
