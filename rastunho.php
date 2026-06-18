  <?php
$pagina = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limite = 4;
$offset = ($pagina - 1) * $limite;

  //Conta o total de registros
                $sqlTotal = "SELECT COUNT(*) as total
                             FROM usuario AS u
                             INNER JOIN detalhes AS d ON u.id_usuario = d.id_usuario
                             WHERE u.cargo_usuario = 'Instrutor'";

                $stmtTotal = $conexao->prepare($sqlTotal);
                $stmtTotal->execute();

                $totalRegistros = $stmtTotal->fetch(PDO::FETCH_ASSOC)['total'];
                $totalPaginas = ceil($totalRegistros / $limite);
 ?>
 <div class="paginacao">
                <!-- Monta a div de paginação -->
                <?php if ($pagina > 1): ?>
                    <a class="btn-pag proxima" href="?page=<?php echo $pagina - 1; ?>">◀️ Anterior</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <a class="btn-pag" href="?page=<?php echo $i; ?>"
                        style="margin: 0 5px; <?php echo ($i == $pagina) ? 'ativo' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($pagina < $totalPaginas): ?>
                    <a class="btn-pag proxima" href="?page=<?php echo $pagina + 1; ?>">Próxima ▶️</a>
                <?php endif; ?>
            </div>