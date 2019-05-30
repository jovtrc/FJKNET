<?php

// Classe com as funções referentes ao controle de estoque
class Estoque extends Conexao {
    // Função de contar os clientes de acordo com o status
    public function contarForaDeEstoque() {
        $pdo = parent::get_instance();
        $sql = "SELECT count(*) as total FROM tb_estoque_produto WHERE quant_prod = 0";
        $statement = $pdo->query($sql);
        $statement->execute();

        return $statement->fetchAll();
    }

}

?>
