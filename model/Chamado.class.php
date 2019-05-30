<?php

// Classe com as funções para os profissionais
class Chamado extends Conexao {
    // Função de buscar todos os registros de um profissional
    public function listarChamadosQuantidade($quant) {
        $pdo = parent::get_instance();
        $sql = "SELECT chamado.*, tecnico.nm_profissional AS Tecnico, abre.nm_profissional AS Abre,
  								   cliente.*, s.*, t.*
  							FROM tb_servico chamado
  							INNER JOIN tb_cliente cliente on chamado.id_cliente = cliente.id
  							INNER JOIN tb_profissionais AS tecnico on chamado.id_tecnico = tecnico.id
  							INNER JOIN tb_profissionais AS abre on chamado.id_atendente_abre = abre.id
  							INNER JOIN tb_servico_status s on chamado.id_status_servico = s.id_status_servico
  							INNER JOIN tb_servico_tipo t on chamado.id_tipo_servico = t.id_tipo_servico
                LIMIT $quant";
        $statement = $pdo->query($sql);
        $statement->execute();

        if($statement->rowCount() > 0) {
            return $statement->fetchAll();
        } else {
            echo "<p style='color:#333; font-size:26px;'><b>Não encontramos registros.</b></p>";
            return $statement->fetchAll();
        }
    }

    // Função de buscar todos os registros de um profissional
    public function listarTodosChamados() {
        $pdo = parent::get_instance();
        $sql = "SELECT chamado.*, tecnico.nm_profissional AS Tecnico, abre.nm_profissional AS Abre,
  								   cliente.id, cliente.nm_cliente,
  								   s.id_status_servico, s.nm_status_servico,
  								   t.id_tipo_servico, t.nm_tipo_servico
  							FROM tb_servico chamado
  							INNER JOIN tb_cliente cliente on chamado.id_cliente = cliente.id
  							INNER JOIN tb_profissionais AS tecnico on chamado.id_tecnico = tecnico.id
  							INNER JOIN tb_profissionais AS abre on chamado.id_atendente_abre = abre.id
  							INNER JOIN tb_servico_status s on chamado.id_status_servico = s.id_status_servico
  							INNER JOIN tb_servico_tipo t on chamado.id_tipo_servico = t.id_tipo_servico";
        $statement = $pdo->query($sql);
        $statement->execute();

        if($statement->rowCount() > 0) {
            return $statement->fetchAll();
        } else {
            echo "<p style='color:#333; font-size:26px;'><b>Não encontramos registros.</b></p>";
            return $statement->fetchAll();
        }
    }

    // Função de buscar todos os registros de um profissional
    public function exibirChamadoCompleto($idServico) {
        $pdo = parent::get_instance();
        $sql = "SELECT o.*,

    					   tecnico.nm_profissional AS Tecnico, abre.nm_profissional AS Abre, fecha.nm_profissional AS Fecha, instalador.nm_profissional AS Instalador,

    					   c.*, p.*, s.*, t.*

    				FROM tb_servico o
    				INNER JOIN tb_cliente c on o.id_cliente = c.id
    				INNER JOIN tb_profissionais AS tecnico on o.id_tecnico = tecnico.id
    				INNER JOIN tb_profissionais AS abre on o.id_atendente_abre = abre.id
    				LEFT JOIN tb_profissionais AS fecha on o.id_atendente_fecha = fecha.id
    				LEFT JOIN tb_profissionais AS instalador on c.instaladop_cliente = instalador.id
    				INNER JOIN tb_servico_status s on o.id_status_servico = s.id_status_servico
    				INNER JOIN tb_servico_tipo t on o.id_tipo_servico = t.id_tipo_servico
    				INNER JOIN tb_cliente_planos p on c.plano_cliente = p.id
    				WHERE id_servico=" . $idServico;
        $statement = $pdo->query($sql);
        $statement->execute();

        if($statement->rowCount() > 0) {
            return $statement->fetchAll();
        } else {
            echo "<p style='color:#333; font-size:26px;'><b>Não encontramos registros.</b></p>";
            return $statement->fetchAll();
        }
    }

    // Função de buscar todos os registros de um profissional
    public function exibirRegistroAtendimento($idServico) {
        $pdo = parent::get_instance();
        $sql = "SELECT f.*
  					FROM tb_servico_final f
  					INNER JOIN tb_servico s on f.id_servico = s.id_servico
  					WHERE f.id_servico=" . $idServico;
        $statement = $pdo->query($sql);
        $statement->execute();

        if($statement->rowCount() > 0) {
            return $statement->fetchAll();
        } else {
            echo "<p style='color:#333; font-size:26px;'><b>Não encontramos registros.</b></p>";
            return $statement->fetchAll();
        }
    }

}
