<?php

namespace App\Utils;

class Validations
{
    public static function validarNome($nome)
    {
        $nome = trim($nome);

        if (strlen($nome) < 2 || strlen($nome) > 50) {
            return 'O nome deve ter entre 2 e 50 caracteres.';
        }

        if (!preg_match('/^[a-zA-ZÀ-ú\s\'\-]+$/', $nome)) {
            return 'O nome contém caracteres inválidos.';
        }

        return null; // Retorna nulo se o nome for válido
    }
}
