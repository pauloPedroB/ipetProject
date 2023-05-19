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
    public static function validarCPF($cpf)
    {
            $cpf = preg_replace('/[^0-9]/', '', $request->CPF);

            if (strlen($cpf) !== 11) {
                return 'Erro';
            }
            if (preg_match('/(\d)\1{10}/', $cpf)) {
                return 'Erro';
            }
            $soma = 0;
            for ($i = 0; $i < 9; $i++) {
                $soma += intval($cpf[$i]) * (10 - $i);
            }
            $resto = $soma % 11;
            $digito1 = ($resto < 2) ? 0 : (11 - $resto);
            if (intval($cpf[9]) !== $digito1) {
                return 'Erro';
            }
            $soma = 0;
            for ($i = 0; $i < 10; $i++) {
                $soma += intval($cpf[$i]) * (11 - $i);
            }
            $resto = $soma % 11;
            $digito2 = ($resto < 2) ? 0 : (11 - $resto);
            if (intval($cpf[10]) !== $digito2) {
                return 'Erro';
            }
            return null;
    }
}
