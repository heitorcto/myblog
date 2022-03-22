<?php
// Incluindo o topo padrão
include "header.html";
?>
    <script>
        $(document).ready(function() {
            // Ocultando resultado do envio 
            $(".resultado-call").hide();

            // Enviando AJAX do contato
            $( ".btn-send" ).click(function() {
                var nome = $("#nome").val();
                var email = $("#email").val();
                var mensagem = $("#mensagem").val();

                var formData = new FormData();
                formData.append('nome',nome);
                formData.append('email',email);
                formData.append('mensagem',mensagem);
                
                $.ajax({
                    url : "../testes.php",
                    type: "POST",
                    data : formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        $("#div").empty();
                    },
                    success:function(data){
                        var retorno = JSON.parse(data);
                        console.log(retorno);
                        $("#envioSucesso").show();
                        $("#envioErro").hide();
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        $("#envioErro").show();
                        $("#envioSucesso").hide();
                    }
                });
            });
        });       
    </script>

    <!-- Page Header-->
    <header class="masthead" style="background-image: url('assets/img/contact-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="page-heading">
                        <h1>Contato</h1>
                        <span class="subheading">Perguntas? Novidades? Conta ai!</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <p>Envie algo que você achou legal para postarmos, daremos o devido crédito por seu envio, deixe suas críticas ou elogios, agradecemos sua interação!</p>
                    <div class="my-5">
                        <form id="formContato" method="POST">
                            <div class="form-floating">
                                <input class="form-control" id="nome" type="text" placeholder="Seu nome..." value="">
                                <label for="nome">Nome</label>
                                <div id="invalid-nome" class="invalid-feedback">Nome obrigatório.</div>
                            </div>
                            <div class="form-floating">
                                <input class="form-control" id="email" type="email" placeholder="Seu email...">
                                <label for="email">Email</label>
                                <div id="invalid-email" class="invalid-feedback">Email obrigatório.</div>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" id="mensagem" placeholder="Sua mensagem..." style="height: 12rem"></textarea>
                                <label for="mensagem">Mensagem</label>
                                <div id="invalid-mensagem" class="invalid-feedback">Mensagem obrigatória.</div>
                            </div>
                            <br>
                            
                            <div class="resultado-call" id="envioSucesso">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Enviado com sucesso!</div>
                                </div>
                            </div>

                            <div class="resultado-call" id="envioErro">
                                <div class="text-center text-danger mb-3">Erro ao enviar, tente novamente!</div>
                            </div>
                            
                            <!-- Submit Button-->
                            <div class="btn-send">
                                <a class="btn text-uppercase" id="enviarContato">Enviar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php
// Incluindo o rodapé padrão
include "footer.html";
?>
