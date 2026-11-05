<?php

namespace Database\Seeders;

use App\Models\Comentario;
use App\Models\Noticia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComentarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Comentarios temáticos y variados por cada noticia (identificadas por su etiqueta/slug)
        $comentariosPorSlug = [
            'despliegue-computacion-cuantica-farmacos-materiales' => [
                [
                    'autor' => 'Dra. Elena Garrido',
                    'cuerpo' => 'Un avance trascendental para la biotecnología. Reducir los tiempos de cribado molecular de meses a horas multiplicará los tratamientos disponibles para enfermedades raras.',
                    'valoracion' => 'positivo',
                    'minutos_despues' => 120,
                ],
                [
                    'autor' => 'Marcos Villanueva',
                    'cuerpo' => 'El ritmo al que avanza la computación cuántica supera todas las previsiones que teníamos hace un lustro. Qué gran noticia para la investigación científica.',
                    'valoracion' => 'positivo',
                    'minutos_despues' => 240,
                ],
                [
                    'autor' => 'Sergio Morales',
                    'cuerpo' => 'Aunque las aplicaciones médicas son positivas, me genera enorme inquietud la fragilidad de nuestros sistemas bancarios y de cifrado si no migramos a criptografía postcuántica de inmediato.',
                    'valoracion' => 'negativo',
                    'minutos_despues' => 380,
                ],
            ],

            'sonda-orion-confirma-hielo-subterraneo-marte' => [
                [
                    'autor' => 'Clara Domínguez',
                    'cuerpo' => '¡Un hallazgo histórico! Tener hielo a solo metro y medio simplifica de manera extraordinaria cualquier planteamiento de misión tripulada en la próxima década.',
                    'valoracion' => 'positivo',
                    'minutos_despues' => 90,
                ],
                [
                    'autor' => 'Javier Ortega',
                    'cuerpo' => 'Poder generar oxígeno y agua directamente in situ abarata las misiones en miles de millones de euros. Arcadia Planitia se consolida como el puerto base ideal.',
                    'valoracion' => 'positivo',
                    'minutos_despues' => 210,
                ],
                [
                    'autor' => 'Beatriz Lozano',
                    'cuerpo' => 'Con las urgencias ecológicas y humanitarias que afrontamos en nuestro propio planeta, me parece un despilfarro astronómico de recursos públicos.',
                    'valoracion' => 'negativo',
                    'minutos_despues' => 340,
                ],
                [
                    'autor' => 'Diego Santana',
                    'cuerpo' => 'El desarrollo de tecnología para el espacio siempre acaba revirtiendo en avances de purificación de agua y energías para la vida cotidiana en la Tierra.',
                    'valoracion' => 'positivo',
                    'minutos_despues' => 450,
                ],
            ],

            'banco-central-rebaja-tipos-interes-inversion-productiva' => [
                [
                    'autor' => 'Raúl Montero',
                    'cuerpo' => 'Un respiro muy necesario para miles de familias con hipotecas variables y para las pymes que requerían financiación urgente para proyectos de digitalización.',
                    'valoracion' => 'positivo',
                    'minutos_despues' => 60,
                ],
                [
                    'autor' => 'Patricia Fuentes',
                    'cuerpo' => 'Mucho cuidado con abaratar el dinero de golpe: podemos volver a alimentar burbujas especulativas en el sector inmobiliario en lugar de incentivar la economía real.',
                    'valoracion' => 'negativo',
                    'minutos_despues' => 180,
                ],
            ],

            'red-electrica-supera-noventa-por-ciento-renovable' => [
                [
                    'autor' => 'Lucía Herrera',
                    'cuerpo' => 'Un orgullo comprobar con datos reales que un sistema eléctrico moderno puede sostenerse de manera limpia y competitiva sin depender del carbón ni del gas importado.',
                    'valoracion' => 'positivo',
                    'minutos_despues' => 80,
                ],
                [
                    'autor' => 'Fernando Castro',
                    'cuerpo' => 'Las tecnologías de almacenamiento y bombeo hidroeléctrico eran el eslabón pendiente. Qué importante ha sido apostar por la estabilidad de red.',
                    'valoracion' => 'positivo',
                    'minutos_despues' => 190,
                ],
                [
                    'autor' => 'Guillermo Rivas',
                    'cuerpo' => 'Se nos olvida que muchas líneas de distribución comarcales no están dimensionadas para estas cargas y sufren cortes frecuentes cuando hay picos de viento.',
                    'valoracion' => 'negativo',
                    'minutos_despues' => 310,
                ],
            ],

            'digitalizacion-abre-al-publico-cien-mil-manuscritos-medievales' => [
                [
                    'autor' => 'Carmen Valdés',
                    'cuerpo' => 'Una absoluta maravilla para historiadores y curiosos. Poder examinar la caligrafía y las miniaturas de códices del siglo XI con esta nitidez desde casa no tiene precio.',
                    'valoracion' => 'positivo',
                    'minutos_despues' => 100,
                ],
                [
                    'autor' => 'Gonzalo Méndez',
                    'cuerpo' => 'La aplicación de IA para transcribir escrituras paleográficas visigóticas y carolinas es un ejemplo brillante de cómo la informática enriquece las humanidades.',
                    'valoracion' => 'positivo',
                    'minutos_despues' => 220,
                ],
            ],

            'record-mundial-epica-deportiva-tres-mil-metros-obstaculos' => [
                [
                    'autor' => 'Álvaro Navarro',
                    'cuerpo' => 'La carrera fue una lección magistral de inteligencia en carrera. Soportar el ritmo inicial y lanzar ese cambio devastador a falta de 700 metros está al alcance de muy pocos elegidos.',
                    'valoracion' => 'positivo',
                    'minutos_despues' => 45,
                ],
                [
                    'autor' => 'Nuria Soler',
                    'cuerpo' => 'La técnica en el paso por la ría fue impecable, sin titubeos ni pérdida de inercia. Un récord plenamente merecido.',
                    'valoracion' => 'positivo',
                    'minutos_despues' => 110,
                ],
                [
                    'autor' => 'Tomás Giménez',
                    'cuerpo' => 'Entre la nueva amortiguación de las zapatillas y las superficies de pista ultrarreactivas, cada año se baten récords que desvirtúan las marcas de décadas pasadas.',
                    'valoracion' => 'negativo',
                    'minutos_despues' => 200,
                ],
            ],

            // NOTA: La noticia con slug 'guia-buenas-practicas-teletrabajo-desconexion-digital'
            // queda intencionadamente con 0 comentarios por solicitud expresa del usuario.
        ];

        foreach ($comentariosPorSlug as $slug => $comentarios) {
            $noticia = Noticia::where('etiqueta', $slug)->first();

            if (!$noticia) {
                continue;
            }

            foreach ($comentarios as $datos) {
                $fechaComentario = $noticia->created_at->copy()->addMinutes($datos['minutos_despues'] ?? 30);

                Comentario::create([
                    'noticia_id' => $noticia->id,
                    'autor' => $datos['autor'],
                    'cuerpo' => $datos['cuerpo'],
                    'valoracion' => $datos['valoracion'],
                    'created_at' => $fechaComentario,
                    'updated_at' => $fechaComentario,
                ]);
            }
        }
    }
}

