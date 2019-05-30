<?php

// Classe com as funções referentes ao agendamento de consultas e consultas em geral
class Financeiro extends Conexao {
    // Função de contar os lancamentos, por entrada ou saida
    public function contarPorTipo($tipoLancamento) {
        $pdo = parent::get_instance();
        $sql = "SELECT count(*) as total FROM tb_financeiro_lancamentos WHERE tp_lancamento = '" . $tipoLancamento . "'";;
        $statement = $pdo->query($sql);
        $statement->execute();

        return $statement->fetchAll();
    }


    // Função de buscar todos os lançamentos
    public function listarTodosLancamentos() {
        $pdo = parent::get_instance();
        $sql = "SELECT l.*, p.nm_profissional FROM tb_financeiro_lancamentos l
                INNER JOIN tb_profissionais p ON l.cadastrado_por = p.id";
        $statement = $pdo->query($sql);
        $statement->execute();

        if($statement->rowCount() > 0) {
            return $statement->fetchAll();
        } else {
            echo "<p style='color:#333; font-size:26px;'><b>Não encontramos registros.</b></p>";
            return $statement->fetchAll();
        }
    }


    // Função de agendar nova consulta
    public function incluir($paciente, $profissional, $descricao, $data) {
        $pdo = parent::get_instance();
        $sql = "
                INSERT INTO tb_agendamento(id_agendamento_status, id_paciente, id_profissional, ds_agendamento, dt_agendamento)
                SELECT x.id_agendamento_status, x.id_paciente, x.id_profissional, x.ds_agendamento, x.dt_agendamento
                FROM (SELECT '1' id_agendamento_status, '$paciente' id_paciente, '$profissional' id_profissional, '$descricao' ds_agendamento, '$data' dt_agendamento) x
                WHERE NOT EXISTS(SELECT 1 FROM tb_agendamento y
                                 WHERE y.id_profissional = x.id_profissional
                                   AND y.dt_agendamento = x.dt_agendamento);
        ";
        $statement = $pdo->prepare($sql);

        $statement->execute();
    }

    // Função de listar todos os profissionais com especialidades
    public function listarProfissionais() {
        $pdo = parent::get_instance();
        $sql = "SELECT p.*, e.ds_profissional_especialidade, t.ds_profissional_tipo FROM tb_profissionais p
                LEFT JOIN tb_profissionais_especialidade e ON p.id_profissional_especialidade = e.id
                INNER JOIN tb_profissionais_tipo t ON p.id_profissional_tipo = t.id
                WHERE p.id_profissional_especialidade IS NOT NULL
                OR p.id_profissional_tipo = 3;";
        $statement = $pdo->query($sql);
        $statement->execute();

        return $statement->fetchAll();
    }


    // Função de listar todos os agendamentos de todos os profissionais
    public function listarAgendamentoGeral() {
        $pdo = parent::get_instance();
        $sql = "SELECT a.*, s.ds_agendamento_status, p.nm_paciente, pr.nm_profissional, pr.id_profissional_especialidade, e.ds_profissional_especialidade, t.ds_profissional_tipo FROM tb_agendamento a
                INNER JOIN tb_agendamento_status s ON a.id_agendamento_status = s.id
                INNER JOIN tb_paciente p ON a.id_paciente = p.id
                INNER JOIN tb_profissionais pr ON a.id_profissional = pr.id
                LEFT JOIN tb_profissionais_especialidade e ON pr.id_profissional_especialidade = e.id
                INNER JOIN tb_profissionais_tipo t ON pr.id_profissional_tipo = t.id
                ORDER BY a.id DESC;";
        $statement = $pdo->query($sql);
        $statement->execute();

        if($statement->rowCount() > 0) {
            return $statement->fetchAll();
        } else {
            echo "<tr style='color:#333; font-size:26px;'><td colspan='6'><b>Não encontramos registros.</b></td></tr>";
            return $statement->fetchAll();
        }
    }


    // Função de listar todos os agendamentos de um profissional específico
    public function listarAgendamentoProf($id) {
        $pdo = parent::get_instance();
        $sql = "SELECT a.*, s.ds_agendamento_status, p.id AS 'idPaci', p.nm_paciente, pr.nm_profissional, pr.id_profissional_especialidade, e.ds_profissional_especialidade FROM tb_agendamento a
                INNER JOIN tb_agendamento_status s ON a.id_agendamento_status = s.id
                INNER JOIN tb_paciente p ON a.id_paciente = p.id
                INNER JOIN tb_profissionais pr ON a.id_profissional = pr.id
                LEFT JOIN tb_profissionais_especialidade e ON pr.id_profissional_especialidade = e.id
                WHERE pr.id = $id
                ORDER BY a.id DESC;";
        $statement = $pdo->query($sql);
        $statement->execute();

        if($statement->rowCount() > 0) {
            return $statement->fetchAll();
        } else {
            echo "<tr style='color:#333; font-size:26px;'><td colspan='6'><b>Não encontramos registros.</b></td></tr>";
            return $statement->fetchAll();
        }
    }


    // Função de contar os agendamentos aguardando
    public function contarAguardando() {
        $pdo = parent::get_instance();
        $sql = "SELECT count(*) as total FROM tb_agendamento WHERE id_agendamento_status = 1";
        $statement = $pdo->query($sql);
        $statement->execute();

        return $statement->fetchAll();
    }


    // Função de contar os agendamentos finalizados
    public function contarFinalizados() {
        $pdo = parent::get_instance();
        $sql = "SELECT count(*) as total FROM tb_agendamento WHERE id_agendamento_status = 3";
        $statement = $pdo->query($sql);
        $statement->execute();

        return $statement->fetchAll();
    }
}

?>
