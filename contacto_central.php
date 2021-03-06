<div class="container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
            <h1 class="heading-title pull-left">Pongase en Contacto</h1>
        </header> 
        <div class="page-content">
            <div class="row">
                <article class="contact-form col-md-8 col-sm-7  page-row">                            

                    <p>Para mayor información, llene el siguiente formulario y nos pondremos en contacto con usted a la mayor brevedad posible. </p>
                    <form action="form_process.php" method="POST">
                        <div class="form-group name">
                            <label for="name">Nombre y Apellido</label>
                            <input required="required" name="txt_nombre" id="txt_nombre" type="text" class="form-control" placeholder="Nombre y Apellido">
                        </div><!--//form-group-->
                        <div class="form-group name">
                            <label for="name">Empresa</label>
                            <input required="required" name="txt_empresa" id="txt_empresa" type="text" class="form-control" placeholder="Nombre de la Empresa">
                        </div><!--//form-group-->
                        <div class="form-group name">
                            <label for="name">Cargo</label>
                            <input required="required" name="txt_cargo" id="txt_cargo" type="text" class="form-control" placeholder="Cargo">
                        </div><!--//form-group-->
                        <div class="form-group email">
                            <label for="email">Email<span class="required">*</span></label>
                            <input required="required" name="txt_email" id="txt_email" type="email" class="form-control" placeholder="Email de contacto">
                        </div><!--//form-group-->
                        <div class="form-group phone">
                            <label for="phone">Telefono</label>
                            <input required="required" name="txt_telefono" id="txt_telefono" type="tel" class="form-control" placeholder="Ingrese su numero telefónico">
                        </div><!--//form-group-->
                        <div class="form-group message">
                            <label for="message">Mensaje<span class="required">*</span></label>
                            <textarea required="required" name="txt_mensaje" id="txt_mensaje" class="form-control" rows="6" placeholder="Ingrese su mensaje aqui..."></textarea>
                        </div><!--//form-group-->
                        <div id="campos_ocultos">
                            <input type="hidden" name="form" value="mail" />
                        </div>
                        <button type="submit" class="btn btn-theme">Enviar</button>
                    </form>                  
                </article><!--//contact-form-->
                <!--aside class="page-sidebar  col-md-3 col-md-offset-1 col-sm-4 col-sm-offset-1">
                    <section class="widget has-divider">
                        <h3 class="title">Descargar Folleto</h3>
                        <p>Donec pulvinar arcu lacus, vel aliquam libero scelerisque a. Cras mi tellus, vulputate eu eleifend at, consectetur fringilla lacus. Nulla ut purus.</p>
                        <a class="btn btn-theme" href="#"><i class="fa fa-download"></i>Download now</a>
                    </section><!--//widget-->   

                <!--section class="widget has-divider">
                    <h3 class="title">Dirección Postal</h3>
                    <p class="adr">
                        <span class="adr-group">       
                            <span class="street-address">College Green</span><br>
                            <span class="region">56 College Green Road</span><br>
                            <span class="postal-code">BS16 AP18</span><br>
                            <span class="country-name">UK</span>
                        </span>
                    </p>
                </section><!--//widget-->     

                <!--section class="widget">
                    <h3 class="title">Consultas</h3>
                    <p class="tel"><i class="fa fa-phone"></i>Tel: 0800 123 4567</p>
                    <p class="email"><i class="fa fa-envelope"></i>Email: <a href="#">info@washingtoncollege.com.ve</a></p>
                </section>   
            </aside--><!--//page-sidebar-->
            </div><!--//page-row-->
            <div class="page-row">
                <article class="map-section">
                    <h3 class="title">Como Llegar</h3>
                    <div id="map"></div><!--//map-->
                </article><!--//map-->
            </div><!--//page-row-->
        </div><!--//page-content-->
    </div>
</div>

<div style="clear: both;"></div>
<br><br>