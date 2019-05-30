<?php

// Classe com as funções mais simples e gerais
class Crud extends Conexao {

    // Função de cadastrar
    public function incluir($tabela, $dados) {
        $pdo = parent::get_instance();

        foreach($dados as $key => $value) {
            $value = trim($value);
            if (empty($value)) {
                $dados[$key] = NULL;
            }
        }

        $campos = implode(", ", array_keys($dados));
        $valores = ":".implode(", :", array_keys($dados));
        $sql = "INSERT INTO $tabela($campos) VALUES ($valores)";
        $statement = $pdo->prepare($sql);

        foreach($dados as $key => $valor) {
            $statement->bindValue(":$key", $valor, PDO::PARAM_STR);
        }

        $statement->execute();
    }


    // Função de buscar todos os registros
    public function listarTudo($tabela) {
        $pdo = parent::get_instance();
        $sql = "SELECT * FROM $tabela";
        $statement = $pdo->query($sql);
        $statement->execute();

        return $statement->fetchAll();
    }


    // Função de buscar todos os registros de um id especifico
    public function listarEspecifico($tabela, $id) {
        $pdo = parent::get_instance();
        $sql = "SELECT * FROM $tabela WHERE id = $id";
        $statement = $pdo->query($sql);
        $statement->execute();

        return $statement->fetchAll();
    }


     // Função de contar os registros
    public function contarTudo($tabela) {
        $pdo = parent::get_instance();
        $sql = "SELECT count(*) as total FROM $tabela";
        $statement = $pdo->query($sql);
        $statement->execute();

        return $statement->fetchAll();
    }


     // Função de deletar
    public function deletar($tabela, $campo) {
        $pdo = parent::get_instance();

        foreach ($campo as $nome => $id) {
          $sql = "DELETE FROM $tabela WHERE $nome = :id";
          $statement = $pdo->prepare($sql);
          $statement->bindValue(":id", $id);
          $statement->execute();
      }
    }


     // Função de buscar todos os registros de um id específico
    public function pegarInfos($tabela, $id) {
        $pdo = parent::get_instance();
        $sql = "SELECT * FROM $tabela WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(":id", $id);
        $statement->execute();

        if($statement->rowCount() > 0) {
            return $statement->fetchAll();
        } else {
            echo "<p style='color:#333; font-size:26px;'><b>Não encontramos registros.</b></p>";
            return $statement->fetchAll();
        }
    }


    // Função de editar
    public function editar($tabela, $dados, $id) {
        $pdo = parent::get_instance();
        $novos_valores = "";

        $filtro = array_filter($dados);

        foreach ($filtro as $key => $valor) {
            $novos_valores .= "$key = :$key, ";
        }

        $novos_valores = substr($novos_valores, 0, -2);

        $sql = "UPDATE $tabela SET $novos_valores WHERE id = :id";
        $statement = $pdo->prepare($sql);

        foreach ($filtro as $key => $valor) {
            $statement->bindValue(":$key",  $valor);
        }

        $statement->execute();
    }
}
