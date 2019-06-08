<center>
        <div class="Lector-contorno" >
    <video class="Lector" id="preview">
      
    </video>
    <div class="content-btn-cmb-camara ">
    <button class="btn btn-Utec">Cambiar de Camara</button>
    <br><br></div>
  </div>
</center>
<div class="MainCont hidden">
			<h1 class="Titulo">Tour Utec</h1>
			<div class="panel panel-primary">
				<form method="POST" action="<?php echo base_url('/Lugar'); ?>" name="formSeccion">
					<div class="panel-header">
						<h4 class="onH">Iniciar Sesion</h4>
					</div>
					<div class="panel-body">
						<input name='ddlsec' id='ddlsec' type="text" placeholder="Usuario" class="form-control" /><br>
						<input name='ddlidm' id='ddlidm' type="text" placeholder="Contraseña" class="form-control" />
					</div>
					<div class="panel-footer">
						<button role="button" id="btn-buscar-sec" type="submit" class="btn">Ingresar</button>
					</div>
				</form>
			</div>
		</div>
<script>
let scanner = new Instascan.Scanner(
             {
                 video: document.getElementById('preview')
             }
         );
         scanner.addListener('scan', function(content) {
           var url = "<?php echo base_url('/seccion/');  ?>"
              //alert('Conenido: ' + url + 1);
             $("#ddlsec").val(content);
             $("#ddlidm").val(1);
          // window.open(url + content + "/1"); 
          $("#btn-buscar-sec").click();
       });
         var ArrCamaras 
         var contCam = 0;
         Instascan.Camera.getCameras().then(cameras => 
         {
           ArrCamaras = cameras;
             if(cameras.length > 0){
                if(cameras.length == 1){$(".content-btn-cmb-camara").addClass("hidden")}
               scanner.start(cameras[0]);
            } else {
                 console.error("no existe camara en el dispositivo!");
             }
         });
         $(".content-btn-cmb-camara").click(function(){
        contCam ++;
           if(contCam <= ArrCamaras.length){
              
              scanner.start(cameras[contCam]);
            }else{
               contCam =0;
             scanner.start(cameras[contCam]);
            }
        });
</script>