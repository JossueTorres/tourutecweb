<div class="main animar-entrada-up">
      <center>
        <div class="titulo-Listado">Listado de Secciones</div>
      <div class="menu ">
            <?php if (!empty($lstSecciones)) {
                foreach ($lstSecciones as $sc) { ?>                
                    <a href="<?php echo base_url('/Lugar/'.$sc->sec_codigo.'/1');  ?>"  class="boton"><img src="<?php echo base_url('/img/'.$sc->sec_nombre);  ?>"><label><?php echo $sc->sec_nombre; ?></label></a>     
                <?php }
        }    ?>
      </div>
      </center>
    </div>