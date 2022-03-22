<?php
// Incluindo o topo padrão
include "header.html";
?>
    <!-- Topo da Página -->
    <header class="masthead" style="background-image: url('assets/img/code-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>Fique inCode</h1>
                        <span class="subheading">Desenvolvido por Heitor C.T.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main -->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                
                <!-- Post -->
                <div class="post-preview">
                    <a href="post.html">
                        <h2 class="post-title">Título da notícia</h2>
                        <h3 class="post-subtitle">Resumo Resumo</h3>
                    </a>
                    <p class="post-meta">
                        Escrito por
                        <a href="#!">Dono do Blog</a>
                        em Março 19, 2021
                    </p>
                </div>
                <!-- Divisor -->
                <hr class="my-4" />
                
                <!-- Mais -->
                <div class="btn-older d-flex justify-content-end mb-4">
                    <a class="btn text-uppercase" href="#!">Mais Notícias <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
<?php
// Incluindo o rodapé padrão
include "footer.html";
?>