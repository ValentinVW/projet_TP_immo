<?php

namespace App\Controller\Back;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

// use App\Model\WeatherModel;
/*$data = WeatherModel::getWeatherData() = appele static d'une fonction(méthode) dans la class*/

/*AbstractController accède au méthode d'assistance: https://symfony.com/doc/current/controller.html#the-base-controller-class-services
Pour avoir accès à  des méthodes commme $this->render(): https://symfony.com/doc/current/controller.html#controller-rendering-templates */

class MainController extends AbstractController
{
  /**
  * @Route("/", name="home", methods={"GET"})
  */
  public function home(): Response
  {
    return $this->render('back/home.html.twig');
  }
}