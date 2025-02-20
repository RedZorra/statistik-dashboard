<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function (App $app) {
    //Dashboard overview
    $app->get('/api/dashboard', function (Request $request, Response $response){
        $data = [
            'totalUsers' => 1000,
            'activeUsers' => 750,
            'totalRevenue' => 500000,
            'conversionRate' => 2.5
        ];
        $response->getBody()->write(json_encode($data));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    });


//Spezifische Route
$app->get('/api/stats/{type}', function (Request $request, Response $response,$args) {
    $type = $args['type'];
    $data =  [];
    switch($type) {
        case 'users':
            $data = [
                'newUsers' => [100, 120, 80, 90, 110],
                'activeUsers' => [800, 820, 780, 790, 810],
                'labels' => ['Jan' , 'Feb', 'Mar', 'Apr', 'May']
            ];
            break;
        case 'revenue':
            $data = [
                'monthly' => [10000, 12000, 9000, 11000, 13000],
                'labels' => ['Jan' , 'Feb', 'Mar', 'Apr', 'May']
            ];
            break;
            //weitere cases       
    }
    $response->getBody()->write(json_encode($data));
    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

// Daten-Upload (Beispiel)
$app->post('/api/upload', function (Request $request, Response $response) {
    $uploadedData = $request->getParsedBody();
    // Hier würden Sie normalerweise die Daten verarbeiten und in einer Datenbank speichern
    $result = ['success' => true, 'message' => 'Daten erfolgreich hochgeladen'];
    $response->getBody()->write(json_encode($result));
    return $response->withHeader('Content-Type', 'application/json');
});


// Benutzerdefinierte Berichte
$app->get('/api/reports/{id}', function (Request $request, Response $response, $args) {
    $reportId = $args['id'];
    // Hier würden Sie normalerweise einen spezifischen Bericht aus einer Datenbank abrufen
    $report = [
        'id' => $reportId,
        'name' => 'Beispielbericht',
        'data' => [
            'labels' => ['Kategorie 1', 'Kategorie 2', 'Kategorie 3'],
            'values' => [300, 500, 200]
        ]
    ];
    $response->getBody()->write(json_encode($report));
    return $response->withHeader('Content-Type', 'application/json');
});
};