<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log; // Necesario importar Log desde Illuminate\Support\Facades

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ExternalRequestController extends Controller
{
    // Obtener todos los posts desde Laravel
    public function getPostsFromLaravel()
    {
        $client = new Client();
    
        try {
            $response = $client->get('http://localhost:8000/posts');
    
            // Verificar el contenido de la respuesta
            $contentType = $response->getHeader('Content-Type');
            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();
    
            // Lograr los detalles de la respuesta para depurar
            
    
            // Devolver la respuesta recibida
            return response($body, $statusCode)
                    ->header('Content-Type', $contentType);
    
        } catch (RequestException $e) {
            // Manejar errores de solicitud de manera más detallada
            return response("Error al hacer la solicitud: " . $e->getMessage(), 500);
        }
    }

    // Crear un nuevo post en Laravel
    public function createPostInLaravel(Request $request)
    {
        $client = new Client();

        try {
            $response = $client->post('http://localhost:8000/posts', [
                'json' => $request->all(),
            ]);
            return response($response->getBody()->getContents(), $response->getStatusCode())
                    ->header('Content-Type', $response->getHeader('Content-Type'));
        } catch (RequestException $e) {
            return response("Error al hacer la solicitud: " . $e->getMessage(), 500);
        }
    }
}