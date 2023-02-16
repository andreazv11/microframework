<?php

// Clase del modelo para trabajar con objetos Item que se almacenan en BD en la tabla ITEMS
class ItemModel
{
    // Conexión a la BD
    protected $db;

    // Atributos del objeto item que coinciden con los campos de la tabla ITEMS
    private $codigo;
    private $item;

    // Constructor que utiliza el patrón Singleton para tener una única instancia de la conexión a BD
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::singleton();
    }

    // Getters y Setters
    public function getCodigo()
    {
        return $this->codigo;
    }
    public function setCodigo($codigo)
    {
        return $this->codigo = $codigo;
    }

    public function getItem()
    {
        return $this->item;
    }
    public function setItem($item)
    {
        return $this->item = $item;
    }

    // Método para obtener todos los registros de la tabla ITEMS
    // Devuelve un array de objetos de la clase ItemModel
    public function getAll()
    {
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare('SELECT * FROM items');
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "ItemModel");

        //devolvemos la colección para que la vista la presente.
        return $resultado;
    }


    // Método que devuelve (si existe en BD) un objeto ItemModel con un código determinado
    public function getById($codigo)
    {
        $gsent = $this->db->prepare('SELECT * FROM items where codigo = ?');
        $gsent->bindParam(1, $codigo);
        $gsent->execute();

        $gsent->setFetchMode(PDO::FETCH_CLASS, "ItemModel");
        $resultado = $gsent->fetch();

        return $resultado;
    }

    // Método que almacena en BD un objeto ItemModel
    // Si tiene ya código actualiza el registro y si no tiene lo inserta
    public function save()
    {
        if (!isset($this->codigo)) {
            $consulta = $this->db->prepare('INSERT INTO items ( item ) values ( ? )');
            $consulta->bindParam(1, $this->item);
            $consulta->execute();
        } else {
            $consulta = $this->db->prepare('UPDATE items SET item = ? WHERE codigo =  ? ');
            $consulta->bindParam(1, $this->item);
            $consulta->bindParam(2, $this->codigo);
            $consulta->execute();
        }
    }

    // Método que elimina el ItemModel de la BD
    public function delete()
    {
        $consulta = $this->db->prepare('DELETE FROM  items WHERE codigo =  ?');
        $consulta->bindParam(1, $this->codigo);
        $consulta->execute();
    }
}
?>