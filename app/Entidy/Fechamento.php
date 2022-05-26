<?php

namespace App\Entidy;

use \App\Db\Database;

use \PDO;

class Fechamento
{

    public $id;
    public $data;
    public $status;
    public $tipo;
    public $valor;
    public $caixa_id;
    public $usuarios_id;

    public function cadastar()
    {


        $obdataBase = new Database('fechamento');

        $this->id = $obdataBase->insert([

            'data'              => $this->data,
            'status'            => $this->status,
            'tipo'              => $this->tipo,
            'valor'             => $this->valor,
            'caixa_id'          => $this->caixa_id,
            'usuarios_id'       => $this->usuarios_id

        ]);

        return true;
    }



    public function atualizar()
    {
        return (new Database('fechamento'))->update('id = ' . $this->id, [

           
            'data'              => $this->data,
            'status'            => $this->status,
            'tipo'              => $this->tipo,
            'valor'             => $this->valor,
            'caixa_id'          => $this->caixa_id,
            'usuarios_id'       => $this->usuarios_id
            
        ]);
    }


    public static function getList($fields = null, $table = null, $where = null, $order = null, $limit = null)
    {

        return (new Database('fechamento'))->select($fields, $table, $where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function getQtd($fields = null, $table = null, $where = null, $order = null, $limit = null)
    {

        return (new Database('fechamento'))->select('COUNT(*) as qtd', 'fechamento', null, null)
            ->fetchObject()
            ->qtd;
    }


    public static function getID($fields, $table, $where, $order, $limit)
    {
        return (new Database('fechamento'))->select($fields, $table, 'id = ' . $where, $order, $limit)
            ->fetchObject(self::class);
    }

    public static function getCaixaID($fields, $table, $where, $order, $limit)
    {
        return (new Database('fechamento'))->select($fields, $table, 'caixa_id = ' . $where, $order, $limit)
        ->fetchAll(PDO::FETCH_CLASS, self::class);
    }
  
    public static function getFechamentoID($fields, $table, $where, $order, $limit)
    {
        return (new Database('fechamento'))->select($fields, $table, 'caixa_id = ' . $where, $order, $limit)
        ->fetchObject(self::class);
    }

    public static function getFecharID($fields, $table, $where, $order, $limit)
    {
        return (new Database('fechamento'))->select($fields, $table, 'fc.caixa_id = ' . $where, $order, $limit)
        ->fetchObject(self::class);
    }

    public function excluir()
    {
        return (new Database('fechamento'))->delete('id = ' . $this->id);
    }


    public static function getUsuarioPorEmail($email)
    {

        return (new Database('fechamento'))->select('email = "' . $email . '"')->fetchObject(self::class);
    }
}
