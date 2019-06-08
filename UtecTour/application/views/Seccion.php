<div class="main animar-entrada-up ">
      <center>
      <div class="titulo-Listado">Nombre de Seccion</div>
      </center> 
    	<div class="card card-primary text-center">
          <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
              <li class="nav-item">
                <a class="nav-link on ddsd active" cosa="ccddo" >Descripcion</a>
              </li>
              <li class="nav-item">
                <a class="nav-link on ddsd" cosa="ccdde" >Mapa</a>
              </li>
              <li class="nav-item">
                <a class="nav-link ddsd on" cosa="ccddi">Fotos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link ddsd on" cosa="ccddv">Videos</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link ddsd on" cosa="ccddc">Comentarios</a>
                </li>
        
            </ul>
          </div>

          <div class="card-body cds ccddo ">
                <button style="float:right;" class="btn btn-xs btnOir"><i class="fas fa-volume-up"></i></button>
<?php
if (!empty($Textos)) {
            foreach ($Textos as $tx) {?>
            <h5 class="card-title"><?php echo $tx->tex_titulo ?></h5>
<p class="card-text" style="float:left;"><?php echo $tx->tex_contenido ?></p>
                <?php } }  ?> 
</div>
<div class="card-body mapa_content cds ccdde hidden">
</div>
<div class="card-body cds ccddi hidden  ">
        <div class="galeria">
            <?php 
              var_dump($lista);
            if (!empty($lista)) {
            foreach ($lista as $li) {
                if($li->rec_tipo == "img"){?>
                <div><img class="on" src="<?php echo base_url('/img/'.$li->rec_url)  ?>"></div>
                <?php } } } ?> 
        </div>
    

</div>
<div class="card-body cds ccddv hidden  ">
        <?php if (!empty($lista)) {
            foreach ($lista as $li) {
                if($li->rec_tipo == "vid"){?>
                  <iframe src="<?php echo $li->rec_url ?>" allowfullscreen></iframe>
                <?php } } } ?>    
        
    </div>
    <div class="card-body cds ccddc hidden  ">

        <div class="row ">
            <div class="col-md-12">
                <b style="float:left;">Kevin Melendez <small>(11/01/2019)</small> : </b>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Mollitia tempora numquam est vitae eum nisi, asperiores possimus, ducimus quae quas consequuntur adipisci vel, reiciendis quibusdam cum at expedita repellendus? Pariatur!</p>
            </div>
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label style="float:left;">Comentario:</label>
                                <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <button class="btn btn-primary" style="float:right;">Enviar Comentario</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<audio src="" hidden class=speech></audio>