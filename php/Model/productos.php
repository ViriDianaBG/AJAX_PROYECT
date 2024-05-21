<?php

include_once '../BaseDatos/conexion.php';

class Producto
{
    private $id_Producto;
    private $nombre;
    private $precio;
    private $stock;
    private $descripcion;
    private $categoria;
    private $marca;
    private $proveedor;
    private $db;

    public function __construct($id_Producto = null, $nombre = null, $precio = null, $stock = null, $descripcion = null, $categoria = null, $marca = null, $proveedor = null, $db = null)
    {
        global $db;
        $this->id_Producto = $id_Producto;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->descripcion = $descripcion;
        $this->categoria = $categoria;
        $this->marca = $marca;
        $this->proveedor = $proveedor;
        $this->db = $db;
    }

    public function obtenerProductos()
    {
        $stmt = $this->db->prepare("
        SELECT p.id_Producto, p.nombre, p.precio, p.stock, p.descripcion, c.nombre AS nombre_categoria, m.nombre AS nombre_marca, pr.nombre AS nombre_proveedor
        FROM mydb.Productos p
        INNER JOIN mydb.Categoria c ON p.categoria = c.id_Categoria
        INNER JOIN mydb.Marca m ON p.marca = m.id_Marca
        INNER JOIN mydb.Proveedor pr ON p.proveedor = pr.id_Proveedor ORDER BY id_Producto ASC
    ");
        $stmt->execute();
        $productos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $producto = new Producto($row['id_Producto'], $row['nombre'], $row['precio'], $row['stock'], $row['descripcion'], $row['nombre_categoria'], $row['nombre_marca'], $row['nombre_proveedor']);
            $productos[] = $producto;
        }
        return $productos;
    }


    public function agregarProducto()
    {
        $stmt = $this->db->prepare("
        INSERT INTO mydb.Productos (nombre, precio, stock, descripcion, categoria, marca, proveedor) 
        VALUES (?, ?, ?, ?, (SELECT id_Categoria FROM mydb.Categoria WHERE nombre = ?), 
        (SELECT id_Marca FROM mydb.Marca WHERE nombre = ?), 
        (SELECT id_Proveedor FROM mydb.Proveedor WHERE nombre = ?)) ");
        $stmt->execute([$this->nombre, $this->precio, $this->stock, $this->descripcion, $this->categoria, $this->marca, $this->proveedor]);

        $this->id_Producto = $this->db->lastInsertId();

        return $stmt->rowCount();
    }


    public function eliminarProducto($id_Producto)
    {
        $stmt = $this->db->prepare("DELETE FROM productos WHERE id_Producto = ?");
        $stmt->execute([$id_Producto]);
        return $stmt->rowCount();
    }

    public function actualizarProducto()
    {
        $stmt = $this->db->prepare("
        UPDATE mydb.Productos
        SET nombre = ?, precio = ?, stock = ?, descripcion = ?, categoria = (SELECT id_Categoria FROM mydb.Categoria WHERE nombre = ?),
            marca = (SELECT id_Marca FROM mydb.Marca WHERE nombre = ?),
            proveedor = (SELECT id_Proveedor FROM mydb.Proveedor WHERE nombre = ?)
        WHERE id_Producto = ?
    ");
        $stmt->execute([$this->nombre, $this->precio, $this->stock, $this->descripcion, $this->categoria, $this->marca, $this->proveedor, $this->id_Producto]);
        return $stmt->rowCount();
    }


    public function obtenerProductoPorId($id)
    {
        $stmt = $this->db->prepare("
        SELECT p.id_Producto, p.nombre, p.precio, p.stock, p.descripcion, c.nombre AS nombre_categoria, m.nombre AS nombre_marca, pr.nombre AS nombre_proveedor
        FROM mydb.Productos p
        INNER JOIN mydb.Categoria c ON p.categoria = c.id_Categoria
        INNER JOIN mydb.Marca m ON p.marca = m.id_Marca
        INNER JOIN mydb.Proveedor pr ON p.proveedor = pr.id_Proveedor
        WHERE p.id_Producto = ?
    ");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $id_Producto = $row['id_Producto'];
        $nombre = $row['nombre'];
        $precio = $row['precio'];
        $stock = $row['stock'];
        $descripcion = $row['descripcion'];
        $categoria = $row['nombre_categoria'];
        $marca = $row['nombre_marca'];
        $proveedor = $row['nombre_proveedor'];

        return new Producto($id_Producto, $nombre, $precio, $stock, $descripcion, $categoria, $marca, $proveedor);
    }

    public function getCategorias()
    {
        $stmt = $this->db->prepare("SELECT nombre FROM mydb.Categoria");
        $stmt->execute();
        $categorias = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $categorias[] = $row['nombre'];
        }
        return $categorias;
    }

    public function getMarcas()
    {
        $stmt = $this->db->prepare("SELECT nombre FROM mydb.Marca");
        $stmt->execute();
        $marcas = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $marcas[] = $row['nombre'];
        }
        return $marcas;
    }

    public function getProveedores()
    {
        $stmt = $this->db->prepare("SELECT nombre FROM mydb.Proveedor");
        $stmt->execute();
        $proveedores = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $proveedores[] = $row['nombre'];
        }
        return $proveedores;
    }

    public function busqueda($nombre)
    {
        $sql = 'SELECT p.id_Producto, p.nombre, p.precio, p.stock, p.descripcion, c.nombre AS nombre_categoria, m.nombre AS nombre_marca, pr.nombre AS nombre_proveedor
        FROM mydb.Productos p
        INNER JOIN mydb.Categoria c ON p.categoria = c.id_Categoria
        INNER JOIN mydb.Marca m ON p.marca = m.id_Marca
        INNER JOIN mydb.Proveedor pr ON p.proveedor = pr.id_Proveedor
        WHERE p.nombre LIKE ?
    ';

        $stmt = $this->db->prepare($sql);
        $stmt->execute(["%$nombre%"]);
        $productos = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $producto = new Producto($row['id_Producto'], $row['nombre'], $row['precio'], $row['stock'], $row['descripcion'], $row['nombre_categoria'], $row['nombre_marca'], $row['nombre_proveedor']);
            array_push($productos, $producto);
        }
        return $productos;

    }
    


    public function getIdProducto()
    {
        return $this->id_Producto;
    }

    public function setIdProducto($id_Producto)
    {
        $this->id_Producto = $id_Producto;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    public function getMarca()
    {
        return $this->marca;
    }

    public function setMarca($marca)
    {
        $this->marca = $marca;
    }

    public function getProveedor()
    {
        return $this->proveedor;
    }

    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;
    }
}