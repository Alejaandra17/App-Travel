<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;
use App\Models\Trip;
use App\Models\Memory;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $japon  = Destination::create(['name' => 'Japón']);
        $italia = Destination::create(['name' => 'Italia']);
        $peru   = Destination::create(['name' => 'Perú']);

        $recuerdos = [
            [
                'destination_id' => $japon->id,
                'title' => 'Santuario Fushimi Inari-taisha',
                'description' => 'Visita al principal santuario sintoísta dedicado al espíritu de Inari.',
                'date' => '2024-04-10',
                'image' => 'santuario.jpg', 
                'note' => 'Recorrido completo por los senderos de torii.'
            ],
            [
                'destination_id' => $japon->id,
                'title' => 'Distrito de Shibuya',
                'description' => 'Recorrido urbano por el centro comercial y de entretenimiento.',
                'date' => '2024-04-15',
                'image' => 'shibuya.jpg', 
                'note' => 'Visita a la estatua de Hachiko.'
            ],
            [
                'destination_id' => $japon->id,
                'title' => 'Parque de Nara',
                'description' => 'Excursión al parque público a los pies del monte Wakakusa.',
                'date' => '2024-04-20',
                'image' => 'nara.jpg', 
                'note' => 'Visita al templo Tōdai-ji.'
            ],
            [
                'destination_id' => $italia->id,
                'title' => 'Coliseo de Roma',
                'description' => 'Visita guiada al anfiteatro de la época del Imperio romano.',
                'date' => '2023-06-05',
                'image' => 'coliseo.jpg',
                'note' => 'Acceso a la zona subterránea y arena.'
            ],
            [
                'destination_id' => $italia->id,
                'title' => 'Gran Canal de Venecia',
                'description' => 'Trayecto en transporte fluvial a través del canal principal.',
                'date' => '2023-06-10',
                'image' => 'canal.jpg',
                'note' => 'Parada en el Puente de Rialto.'
            ],
            [
                'destination_id' => $italia->id,
                'title' => 'Catedral de Florencia',
                'description' => 'Visita a la basílica de Santa María del Fiore y su cúpula.',
                'date' => '2023-06-15',
                'image' => 'catedral.jpg',
                'note' => 'Subida al campanario de Giotto.'
            ],
            [
                'destination_id' => $peru->id,
                'title' => 'Machu Picchu',
                'description' => 'Exploración de la antigua ciudad incaica en los Andes.',
                'date' => '2022-11-01',
                'image' => 'machu.jpg',
                'note' => 'Llegada a través del Camino Inca.'
            ],
            [
                'destination_id' => $peru->id,
                'title' => 'Centro Histórico de Lima',
                'description' => 'Ruta cultural por la Plaza Mayor y la Catedral.',
                'date' => '2022-11-05',
                'image' => 'lima.jpg',
                'note' => 'Degustación en restaurante local.'
            ],
            [
                'destination_id' => $peru->id,
                'title' => 'Lago Titicaca',
                'description' => 'Navegación por el lago navegable más alto del mundo.',
                'date' => '2022-11-10',
                'image' => 'lago.jpg',
                'note' => 'Intercambio cultural con la comunidad local.'
            ],
        ];

        foreach ($recuerdos as $datos) {
            $trip = Trip::create([
                'destination_id' => $datos['destination_id'],
                'title'          => $datos['title'],
                'description'    => $datos['description'],
                'travel_date'    => $datos['date'],
                'status'         => 'done',
                'price'          => null,
                'image_url'      => $datos['image']
            ]);

            Memory::create(['trip_id' => $trip->id, 'note' => $datos['note']]);
        }

        $ofertas = [
            [
                'destination_id' => $japon->id,
                'title' => 'Circuito Japón Clásico',
                'description' => 'Itinerario de 12 días visitando Tokio, Kioto y Osaka.',
                'date' => '2026-09-15',
                'price' => 2450.00,
                'image' => 'circuito.jpg'
            ],
            [
                'destination_id' => $japon->id,
                'title' => 'Sakura',
                'description' => 'Viaje especial para la floración de los cerezos.',
                'date' => '2026-03-20',
                'price' => 1890.50,
                'image' => 'sakura.jpg'
            ],
            [
                'destination_id' => $italia->id,
                'title' => 'Costa Amalfitana',
                'description' => 'Recorrido de 7 días por el sur de Italia.',
                'date' => '2026-07-01',
                'price' => 850.00,
                'image' => 'costa.jpg'
            ],
            [
                'destination_id' => $italia->id,
                'title' => 'Milán y los Lagos',
                'description' => 'Estancia en Milán con excursiones a los lagos.',
                'date' => '2026-09-20',
                'price' => 1200.00,
                'image' => 'milan.jpg'
            ],
            [
                'destination_id' => $peru->id,
                'title' => 'Ruta Inca',
                'description' => 'Expedición completa de 10 días a Cusco.',
                'date' => '2026-11-10',
                'price' => 1750.99,
                'image' => 'inca.jpg'
            ],
        ];

        foreach ($ofertas as $datos) {
            Trip::create([
                'destination_id' => $datos['destination_id'],
                'title'          => $datos['title'],
                'description'    => $datos['description'],
                'travel_date'    => $datos['date'],
                'status'         => 'offer',
                'price'          => $datos['price'],
                'image_url'      => $datos['image']
            ]);
        }
    }
}