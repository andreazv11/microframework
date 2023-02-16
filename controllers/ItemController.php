<?php
// Controlador para el modelo ItemModel (puede haber más controladores en la aplicación)
// Un controlador no tiene porque estar asociado a un objeto del modelo
class ItemController
{
    // Atributo con el motor de plantillas del microframework
    protected $view;

    // Constructor. Únicamente instancia un objeto View y lo asigna al atributo
    function __construct()
    {
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
    }

    // Método del controlador para listar los items almacenados
    public function listar()
    {
        //Incluye el modelo que corresponde
        require 'models/ItemModel.php';

        //Creamos una instancia de nuestro "modelo"
        $items = new ItemModel();

        //Le pedimos al modelo todos los items
        $listado = $items->getAll();

        //Pasamos a la vista toda la información que se desea representar
        $data['items'] = $listado;

        // Finalmente presentamos nuestra plantilla 
        // Llamamos al método "show" de la clase View, que es el motor de plantillas
        // Genera la vista de respuesta a partir de la plantilla y de los datos
        $this->view->show("listarView.php", $data);
    }


    public function index()
    {
        //Incluye el modelo que corresponde
        require_once 'models/ItemModel.php';

        //Creamos una instancia de nuestro "modelo"
        $items = new ItemModel();

        //Le pedimos al modelo todos los items
        $listado = $items->getAll();

        //Pasamos a la vista toda la información que se desea representar
        $data['items'] = $listado;

        //Finalmente presentamos nuestra plantilla
        $this->view->show("listarView.php", $data);
    }

    // Método del controlador para crear un nuevo item
    public function nuevo()
    {
        require 'models/ItemModel.php';
        $item = new ItemModel();

        $errores = array();

        // Si recibe por GET o POST el objeto y lo guarda en la BG
        if (isset($_REQUEST['submit'])) {
            if (!isset($_REQUEST['item']) || empty($_REQUEST['item']))
                $errores['item'] = "* Item: Error";
            if (empty($errores)) {
                $item->setItem($_REQUEST['item']);
                $item->save();

                // Finalmente llama al método listar para que devuelva vista con listado
                header("Location: index.php?controlador=item&accion=listar");
            }
        }

        // Si no recibe el item para añadir, devuelve la vista para añadir un nuevo item
        $this->view->show("nuevoView.php", array('errores' => $errores));



    }

    // Método que procesa la petición para editar un item
    public function editar()
    {

        require 'models/ItemModel.php';
        $items = new ItemModel();

        // Recuperar el item con el código recibido
        $item = $items->getById($_REQUEST['codigo']);

        if ($item == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo'));
        }

        $errores = array();

        // Si se ha pulsado el botón de actualizar
        if (isset($_REQUEST['submit'])) {

            if (!isset($_REQUEST['item']) || empty($_REQUEST['item']))
                $errores['item'] = "* Item: Error";

            if (empty($errores)) {
                // Cambia el valor del item y lo guarda en BD
                $item->setItem($_REQUEST['item']);
                $item->save();

                // Reenvía a la aplicación a la lista de items
                header("Location: index.php?controlador=item&accion=listar");
            }
        }

        // Si no se ha pulsado el botón de actualizar se carga la vista para editar el item
        $this->view->show("editarView.php", array('item' => $item, 'errores' => $errores));



    }

    // Método para borrar un item 
    public function borrar()
    {
        //Incluye el modelo que corresponde
        require_once 'models/ItemModel.php';

        //Creamos una instancia de nuestro "modelo"
        $items = new ItemModel();

        // Recupera el item con el código recibido por GET o por POST
        $item = $items->getById($_REQUEST['codigo']);

        if ($item == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo'));
        } else {
            // Si existe lo elimina de la base de datos y vuelve al inicio de la aplicación
            $item->delete();
            header("Location: index.php");
        }
    }

}
?>