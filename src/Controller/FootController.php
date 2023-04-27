<?php

namespace App\Controller;

use App\Service\FootApiConnector;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FootController extends AbstractController
{
    private $footApi;

    public function __construct(FootApiConnector $footApi)
    {
        $this->footApi = $footApi;
    }

    #[Route('/', name: 'app_foot')]
    public function index(string $country = 'France')
    {

        $matches = [];
        $leagues = [];

        // First get the leagues for the current season (2022 as example)
        $responseLeagues = $this->footApi->sendRequest('GET', '/leagues?season=2022&country=' . $country);
        $leagues = $responseLeagues['response'] ?? [];
        if ($leagues) {
            // for example purpose i'll use only the first league viewing that the API is limited
            $responseMatches = $this->footApi->sendRequest('GET', '/fixtures?league=' . $leagues[0]['league']['id'] . '&season=2020');
            $matches = $responseMatches['response'] ?? [];
        }


        // Render the template
        return $this->render('foot/index.html.twig', [
            'matches' => $matches,
        ]);
    }
}
