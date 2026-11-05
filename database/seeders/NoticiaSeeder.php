<?php

namespace Database\Seeders;

use App\Models\Noticia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoticiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $noticias = [
            [
                'titulo' => 'El despliegue de la computación cuántica acelera el desarrollo de nuevos fármacos y materiales',
                'etiqueta' => 'despliegue-computacion-cuantica-farmacos-materiales',
                'cuerpo' => "La computación cuántica ha dejado de ser una promesa de laboratorio para convertirse en una herramienta práctica con aplicaciones industriales directas. Un consorcio internacional de centros de investigación y empresas biotecnológicas ha anunciado los primeros resultados tangibles obtenidos mediante simulaciones moleculares de alta precisión.\n\nGracias a procesadores cuánticos capaces de gestionar más de mil cúbits lógicos con corrección activa de errores en tiempo real, los investigadores han logrado mapear la estructura tridimensional de proteínas complejas en cuestión de horas, un hito que hasta ahora exigía meses ininterrumpidos de cálculo en los supercomputadores convencionales más avanzados del mundo.\n\nEntre los principales avances destaca la formulación preliminar de dos compuestos terapéuticos dirigidos contra enfermedades autoinmunes de difícil tratamiento. Estos fármacos candidatos pasarán a la fase de ensayos preclínicos mucho antes de los plazos inicialmente estimados por la comunidad científica.\n\nNo obstante, expertos en ética tecnológica y ciberseguridad recuerdan la necesidad urgente de consensuar marcos normativos globales para regular el acceso a esta capacidad de cálculo sin precedentes, especialmente en lo relativo al descifrado de algoritmos criptográficos y a la protección de datos sanitarios sensibles.",
                'created_at' => now()->subDays(6)->setTime(9, 30),
                'updated_at' => now()->subDays(6)->setTime(9, 30),
            ],
            [
                'titulo' => 'La sonda Orión confirma reservas masivas de hielo subterráneo en Marte',
                'etiqueta' => 'sonda-orion-confirma-hielo-subterraneo-marte',
                'cuerpo' => "La misión espacial internacional Orión ha transmitido a los centros de control terrestre su paquete de datos más revelador hasta la fecha. Los instrumentos de radar de penetración del subsuelo han cartografiado extensos depósitos de agua congelada situados a apenas metro y medio de profundidad en la región de Arcadia Planitia.\n\nEl hallazgo, corroborado de manera independiente por radiotelescopios terrestres y sondas orbitales complementarias, sitúa estas reservas en una zona geográfica llana, de temperaturas relativamente moderadas y con condiciones orográficas idóneas para futuros aterrizajes de misiones tripuladas.\n\nLa presencia de agua accesible en latitudes medias reduce de forma radical la masa logística y los costes asociados a la exploración humana a largo plazo, al habilitar la producción local tanto de agua potable para las tripulaciones como de oxígeno respirable y combustible metano mediante electrólisis.\n\nEl equipo científico multidisciplinar ha confirmado que durante el próximo trimestre iniciará una segunda fase de escaneo espectrográfico para analizar la salinidad y pureza de las capas de hielo, así como para determinar si pudieron albergar microambientes favorables para la vida bacteriana pasada.",
                'created_at' => now()->subDays(4)->setTime(14, 15),
                'updated_at' => now()->subDays(4)->setTime(14, 15),
            ],
            [
                'titulo' => 'El Banco Central rebaja los tipos de interés para estimular la inversión productiva',
                'etiqueta' => 'banco-central-rebaja-tipos-interes-inversion-productiva',
                'cuerpo' => "El Consejo de Gobierno de la autoridad monetaria ha acordado por amplia mayoría reducir los tipos de interés oficiales en 25 puntos básicos, situando el precio del dinero en su nivel más competitivo de los últimos tres ejercicios económicos.\n\nLa decisión responde a la consolidación de la inflación subyacente en torno al objetivo estatutario del dos por ciento, así como a los signos de ralentización observados en el acceso al crédito comercial para pequeñas y medianas empresas durante la segunda mitad del año.\n\nCon este movimiento estratégico, el organismo busca reactivar la inversión privada en proyectos de transición digital, abaratar de forma progresiva la carga financiera de los préstamos hipotecarios a tipo variable y fomentar la creación neta de puestos de trabajo de calidad en sectores estratégicos.\n\nSin embargo, varios analistas financieros y observatorios económicos independientes han alertado del riesgo de presiones alcistas sobre los precios de los inmuebles residenciales en las principales áreas metropolitanas si la liquidez inyectada se canaliza hacia la compra especulativa en lugar de hacia la inversión productiva.",
                'created_at' => now()->subDays(3)->setTime(11, 45),
                'updated_at' => now()->subDays(3)->setTime(11, 45),
            ],
            [
                'titulo' => 'La red eléctrica nacional supera el noventa por ciento de generación con energías renovables',
                'etiqueta' => 'red-electrica-supera-noventa-por-ciento-renovable',
                'cuerpo' => "Un registro histórico sin precedentes en la transición hacia un modelo energético descarbonizado. Durante siete días consecutivos, el sistema eléctrico peninsular cubrió más del noventa y dos por ciento de su demanda interna mediante la aportación combinada de parques eólicos terrestres y marinos, instalaciones solares fotovoltaicas y plantas hidroeléctricas de bombeo reversible.\n\nLa entrada en servicio de nuevos complejos de baterías químicas de ion de litio y de sistemas térmicos de almacenamiento ha resultado determinante para estabilizar la frecuencia del sistema y gestionar de forma óptima los excedentes de producción en las horas diurnas de mayor radiación solar.\n\nEste rendimiento excepcional ha empujado a la baja los precios mayoristas en el mercado de la electricidad, aliviando la factura energética de industrias electrointensivas y de los hogares acogidos a tarifas reguladas, a la vez que ha evitado la emisión de más de medio millón de toneladas de gases de efecto invernadero.\n\nLas principales asociaciones ecologistas han calificado el logro como una muestra fehaciente de la viabilidad técnica de las energías limpias, si bien instan a reforzar las interconexiones eléctricas transfronterizas y a completar la electrificación del transporte de mercancías por carretera.",
                'created_at' => now()->subDays(2)->setTime(18, 20),
                'updated_at' => now()->subDays(2)->setTime(18, 20),
            ],
            [
                'titulo' => 'Un ambicioso proyecto de digitalización abre al público más de cien mil manuscritos medievales',
                'etiqueta' => 'digitalizacion-abre-al-publico-cien-mil-manuscritos-medievales',
                'cuerpo' => "La red pública de bibliotecas nacionales y archivos históricos ha puesto en marcha un repositorio digital de acceso libre que alberga más de cien mil códices iluminados, fueros medievales, incunables y tratados científicos escritos entre los siglos IX y XV.\n\nLa iniciativa ha combinado técnicas avanzadas de fotografía multiespectral de ultra alta resolución con modelos de visión artificial especializados en paleografía latina y romances medievales. Gracias a ello, ha sido posible recuperar textos ocultos en pergaminos reutilizados (palimpsestos) que resultaban completamente ilegibles al ojo humano.\n\nInvestigadores, docentes y ciudadanos particulares pueden navegar con suma fluidez por reproducciones digitales de una fidelidad milimétrica, consultar transcripciones semánticas sincronizadas y descargar material pedagógico adaptado a la enseñanza de historia y humanidades.\n\nEl proyecto, galardonado con el sello de patrimonio cultural internacional, continuará incorporando fondos documentales a lo largo de los próximos años para consolidar un archivo digital abierto que democratice el acceso a la memoria histórica compartida.",
                'created_at' => now()->subDay()->setTime(10, 10),
                'updated_at' => now()->subDay()->setTime(10, 10),
            ],
            [
                'titulo' => 'Récord mundial y épica deportiva en la final internacional de los tres mil metros obstáculos',
                'etiqueta' => 'record-mundial-epica-deportiva-tres-mil-metros-obstaculos',
                'cuerpo' => "En una velada memorable para el atletismo de élite, el estadio olímpico abarrotado vivió una de las carreras más electrizantes y complejas desde el punto de vista táctico que se recuerdan en la disciplina de los tres mil metros obstáculos.\n\nTras dos primeros kilómetros dominados por una vigilancia extrema entre los principales favoritos y un ritmo relativamente pausado, el fondista keniano desencadenó un ataque demoledor al paso por la penúltima vuelta, sorteando los pasos de valla y la fosa de agua con una elasticidad y coordinación intachables.\n\nEl cronómetro oficial se detuvo en una plusmarca estratosférica de 7 minutos y 51 segundos, rebajando en casi dos segundos el récord mundial vigente y desatando una ovación atronadora en las gradas.\n\nLa emoción se prolongó durante la vuelta de honor, donde los tres atletas que coparon el podio se fundieron en un abrazo deportivo portando juntos las enseñas de sus respectivos países como símbolo de respeto y deportividad.",
                'created_at' => now()->subHours(8),
                'updated_at' => now()->subHours(8),
            ],
            [
                'titulo' => 'Presentan una nueva guía de buenas prácticas para el teletrabajo y la desconexión digital',
                'etiqueta' => 'guia-buenas-practicas-teletrabajo-desconexion-digital',
                'cuerpo' => "El Ministerio de Trabajo y los principales agentes sociales han firmado esta misma mañana un protocolo de recomendaciones para optimizar la organización del empleo en modalidades híbridas y de teletrabajo íntegro.\n\nEl texto hace un hincapié prioritario en salvaguardar de forma efectiva el derecho a la desconexión digital de los trabajadores, estableciendo directrices nítidas que impiden el envío de comunicaciones corporativas fuera de la jornada convenida, salvo en situaciones de emergencia estricta debidamente justificadas.\n\nAsimismo, el acuerdo contempla pautas para la prevención de riesgos ergonómicos y psicosociales asociados al aislamiento laboral, fomentando descansos periódicos y evaluaciones objetivas de las cargas de trabajo.\n\nEl protocolo entra en vigor de forma inmediata para el sector público y servirá como criterio de referencia en la negociación de los convenios colectivos del tejido empresarial privado.",
                'created_at' => now()->subMinutes(5), // Muy reciente (para probar edición/eliminación dentro del margen de 20 min)
                'updated_at' => now()->subMinutes(5),
            ],
        ];

        foreach ($noticias as $data) {
            Noticia::create($data);
        }
    }
}
