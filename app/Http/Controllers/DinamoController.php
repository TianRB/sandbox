<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class DinamoController extends Controller
{

  // Entrada recibe clave de Estado y clave de Agencia, como default se ponen los de ejemplo edo = 20 y age = 01
  // Salida regresa el mismo arreglo que te da 'motos semi-nuevas', pero agrega el campo FOTOS con un arreglo de sus imagenes
  public function getMoto($edo = '20', $age = '01')
  {
    $client = new Client(); // new GUZZLE object
    $response = $client->get('http://www.dinamotos.com/SRV/w_srv.php?accion=49&edo='.$edo.'&age='.$age.'&tipo=1'); // accion 49 listado de motos seminuevas
    $body = $response->getBody(); // get body
    $motos = json_decode($body->getContents(), true); // get content as PHP object

  foreach ($motos as $k => $m) {  // $motos = arreglo original; $k indice del loop; $m cada elemento de $motos
    $imagenes = $client->get('http://www.dinamotos.com/SRV/w_srv.php?accion=54&inventario='.$m['MOT_NUMEROINVENTARIO']); // accion 54 obtener nombres de imagenes de moto
    $imagenes = trim(preg_replace('/\s\s+/', '', $imagenes->getBody()->getContents())); // Quitar \r\n
    $imagenes = explode('/', $imagenes); // Divide string en arreglo, separando por '/'
    array_shift($imagenes); // Elimina el primer elemento, que siempre viene vacío ya que empieza con '/'
    $motos[$k]['FOTOS'] = $imagenes; // Agrega fotos al final del arreglo
  }
    //return view('dinamoMoto',['data' => $motos]); // Regresa Vista
    return $motos; // Regresa $motos
  }

  // Ejemplo de uso, por si acaso
  public function ejemplo()
  {
    $motos = $this->getMoto('20','01'); // Todas las motos con imágenes

    foreach ($motos as $k => $m) { // Por cada moto
      $fotos = $m['FOTOS']; //guardar fotos
      foreach ($fotos as $f) { // Por cada foto
        dd($f);  // Imagen
      }
    }
    dd($motos);
    dd('End of Script');
  }
}
