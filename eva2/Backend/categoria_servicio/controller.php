<?php

class Controlador{
    private $lista;

    public function __construct()
    {
        $this->lista = [];
    }

    public function getAll()
    {
        $con = new Conexion();
        $sql = "SELECT id, nombre, imagen, texto, activo FROM categoria_servicio;";
        $rs = mysqli_query($con->getConnection(), $sql);
        if ($rs) {
            while ($tupla = mysqli_fetch_assoc($rs)) {
                $tupla['activo'] = $tupla['activo'] == 1 ? true : false;
                array_push($this->lista, $tupla);
            }
            mysqli_free_result($rs);
        }
        $con->closeConnection();
        return $this->lista;
    }

    public function postNuevo($_nuevoObjeto)
    {
        $con = new Conexion();
        
        $id = count($this->getAll()) + 1;
        $sql = "INSERT INTO categoria_servicio (nombre, imagen, texto, activo) VALUES ('$_nuevoObjeto->nombre', '$_nuevoObjeto->imagen', '$_nuevoObjeto->texto', true)";
        
        $rs = [];
        try {
            $rs = mysqli_query($con->getConnection(), $sql);
        } catch (\Throwable $th) {
            $rs = null;
        }
        
        $con->closeConnection();
        
        if ($rs) {
            return true;
        }
        return null;
    }

    public function patchEncenderApagar($_id, $_accion)
    {
        $con = new Conexion();
        $activo = $_accion === 'encender' ? 1 : 0;
        $sql = "UPDATE categoria_servicio SET activo = $activo WHERE id = $_id";
        
        $rs = [];
        try {
            $rs = mysqli_query($con->getConnection(), $sql);
        } catch (\Throwable $th) {
            $rs = null;
        }
        
        $con->closeConnection();
        
        if ($rs) {
            return true;
        }
        return null;
    }

    public function putNombreById($_nombre, $_id)
    {
        $con = new Conexion();
        $sql = "UPDATE categoria_servicio SET nombre = '$_nombre->nombre', imagen = '$_nombre->imagen', texto = '$_nombre->texto' WHERE id = $_id";
        
        $rs = [];
        try {
            $rs = mysqli_query($con->getConnection(), $sql);
        } catch (\Throwable $th) {
            $rs = null;
        }
        
        
        $con->closeConnection();
        
        if ($rs) {
            return true;
        }
        return null;
    }

    public function deleteById($_id)
    {
        $con = new Conexion();
        $sql = "DELETE FROM categoria_servicio WHERE id = $_id";
        
        $rs = [];
        try {
            $rs = mysqli_query($con->getConnection(), $sql);
        } catch (\Throwable $th) {
            $rs = null;
        }
        
        $con->closeConnection();
       
        if ($rs) {
            return true;
        }
        return null;
    }
}
?>